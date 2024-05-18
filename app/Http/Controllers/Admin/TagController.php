<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helpers;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TagController extends AuthController
{
    private const INDEX_ROUTE = 'tags.index';

    public function index()
    {
        return view('admin.tags.index')->with('tags', Tag::all())->with(['header' => 'Tags']);
    }

    public function create()
    {
        return view('admin.tags.form', $this->getFormData());
    }

    private function getFormData(?Tag $tag = null): array
    {
        $helpers = new Helpers();
        $is_update = $tag instanceof Tag && $tag->exists;

        return [
            'id' => $helpers->firstNonEmpty([$tag?->id]),
            'tag' => $helpers->firstNonEmpty([$tag?->tag, old('tag', request()->tag)]),
            'colour' => $helpers->firstNonEmpty([$tag?->colour, old('colour', request()->colour)]),
            'is_sensitive' => $helpers->firstNonEmpty([$tag?->is_sensitive, old('is_sensitive', request()->is_sensitive)]),
            'header' => $is_update ? __('app.tag.edit') : __('app.tag.create'),
            'is_update' => $is_update,
            'form_route' => $is_update ? route('tags.update', $tag) : route('tags.store'),
        ];
    }

    public function store(TagRequest $request)
    {
        $tag = new Tag();
        $tag->fill($request->validated());
        $tag->save();

        Session::flash('success', sprintf('%s added', $tag->tag));

        return Redirect::to(route(self::INDEX_ROUTE));
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.form', $this->getFormData($tag));
    }

    public function update(TagRequest $request, Tag $tag)
    {
        $tag->fill($request->validated());
        $tag->save();

        Session::flash('success', sprintf('%s added', $tag->tag));

        return Redirect::to(route(self::INDEX_ROUTE));
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        Session::flash('success', sprintf('%s deleted', $tag->tag));

        return Redirect::to(route(self::INDEX_ROUTE));
    }
}
