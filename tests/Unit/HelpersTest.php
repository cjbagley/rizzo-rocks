<?php

use App\Helpers\Helpers;

beforeEach(function () {
    $this->helper = new Helpers();
});

it('gets first non empty', function (array $arr = [], mixed $default = null, $want = null) {
    expect($this->helper->firstNonEmpty($arr, $default))->toBe($want);
})->with([
    'string' => [['Hello', 242], null, 'Hello'],
    'integer' => [[0, 55], null, 55],
    'default' => [[], 'Default', 'Default'],
    'key and value pair' => [[0, null, '', ['Key' => 'Value']], 'Default', ['Key' => 'Value']],
]);

it('sanitises string', function (mixed $input, string $want) {
    expect($this->helper->sanitiseString($input))->toBe($want);
})->with([
    'string' => ['Hello#!<{}>', 'Hello'],
    'integer' => [55, '55'],
    'string with special characters' => ['Halo 2; "thing \'', 'Halo 2 thing'],
    'empty' => ['', ''],
    'injection attempt' => ['name\'); DELETE FROM items; --', 'name DELETE FROM items'],
]);

it('it prepares tag params', function (string $input, array $want) {
    expect($this->helper->prepareParamTags($input))->toBe($want);
})->with([
    'correct format' => ['H+G+P', ['H', 'G', 'P']],
    'empty' => ['', []],
    'off tag' => ['oFf', ['OFF']],
    'random gibberish' => ['Test+#<[G+B3333', ['TES', 'G', 'B']],
    'injection attempt' => ['name\'); DELETE FROM items; --; + HI', ['NAM', 'HI']],
]);
