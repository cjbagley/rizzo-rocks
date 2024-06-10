<?php

use App\Helpers\Helpers;

it('gets first non empty', function () {
    $helpers = new Helpers();

    $expected_1 = 'Hello';
    $result_1 = $helpers->firstNonEmpty(['Hello', 242]);
    expect($result_1)->toBe($expected_1);

    $expected_2 = 55;
    $result_2 = $helpers->firstNonEmpty([0, 55]);
    expect($result_2)->toBe($expected_2);

    $expected_3 = 'Default';
    $result_3 = $helpers->firstNonEmpty([], 'Default');
    expect($result_3)->toBe($expected_3);

    $expected_4 = ['Key' => 'Value'];
    $result_4 = $helpers->firstNonEmpty([0, ['Key' => 'Value']], 'Default');
    expect($result_4)->toBe($expected_4);
});

it('sanitises string', function () {
    $helpers = new Helpers();

    $expected_1 = 'Hello';
    $result_1 = $helpers->sanitiseString('Hello#!<{}>');
    expect($result_1)->toBe($expected_1);

    $expected_2 = 55;
    $result_2 = $helpers->sanitiseString('55');
    expect((string) $result_2)->toBe((string) $expected_2);

    $expected_3 = 'Halo 2 thing';
    $result_3 = $helpers->sanitiseString('Halo 2; "thing \'');
    expect($result_3)->toBe($expected_3);

    $expected_4 = '';
    $result_4 = $helpers->sanitiseString('');
    expect($result_4)->toBe($expected_4);

    $expected_5 = 'name DELETE FROM items';
    $result_5 = $helpers->sanitiseString('name\'); DELETE FROM items; --');
    expect($result_5)->toBe($expected_5);
});
