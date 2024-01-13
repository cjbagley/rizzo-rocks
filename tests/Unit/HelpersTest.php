<?php

namespace Tests\Unit;

use App\Helpers\Helpers;
use PHPUnit\Framework\TestCase;

class HelpersTest extends TestCase
{
    public function test_first_non_empty(): void
    {
        $helpers = new Helpers();

        $expected_1 = 'Hello';
        $result_1 = $helpers->firstNonEmpty(['Hello', 242]);
        $this->assertSame($expected_1, $result_1);

        $expected_2 = 55;
        $result_2 = $helpers->firstNonEmpty([0, 55]);
        $this->assertSame($expected_2, $result_2);

        $expected_3 = 'Default';
        $result_3 = $helpers->firstNonEmpty([], 'Default');
        $this->assertSame($expected_3, $result_3);

        $expected_4 = ['Key' => 'Value'];
        $result_4 = $helpers->firstNonEmpty([0, ['Key' => 'Value']], 'Default');
        $this->assertSame($expected_4, $result_4);
    }
}
