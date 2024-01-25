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
