<?php

namespace App\Exceptions;

use App\Enums\Disk;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if (\App::environment('development')) {
            return parent::render($request, $e);
        }

        $code = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 404;

        if ($code === 404) {
            $image = Storage::disk(Disk::Image->value)->url('829733c8-7571-45a1-85ec-992bf53fdd8b.webp');

            return Inertia::render('404', ['code' => $code, 'image' => $image]);
        }

        $image = Storage::disk(Disk::Image->value)->url('0c606f65-f035-42ab-81a1-388a9811b99f.webp');

        return Inertia::render('Error', ['code' => $code, 'image' => $image]);
    }
}
