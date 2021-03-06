<?php

namespace Lambdish\Phunctional\Tests;

use PHPUnit_Framework_TestCase;
use function Lambdish\Phunctional\map;

class MapTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_should_return_the_values_of_a_collection_after_apply_a_function()
    {
        $actual   = [1, 2, 3, 4, 5];
        $function = $this->multiplier(2);

        $this->assertSame([2, 4, 6, 8, 10], map($function, $actual));
    }

    /** @test */
    public function it_should_keep_the_keys()
    {
        $actual   = ['one' => 1, 'two' => 2, 'three' => 3, 'four' => 4, 'five' => 5];
        $function = $this->multiplier(2);

        $this->assertSame(['one' => 2, 'two' => 4, 'three' => 6, 'four' => 8, 'five' => 10], map($function, $actual));
    }

    /** @test */
    public function it_should_allow_receive_the_key_in_the_function_to_apply_keeping_the_original_index()
    {
        $actual   = [1 => 1, 2 => 2, 3 => 3, 5 => 4, 7 => 5];
        $function = $this->keyPerValueMultiplier();

        $this->assertSame([1 => 1, 2 => 4, 3 => 9, 5 => 20, 7 => 35], map($function, $actual));
    }

    private function multiplier($times)
    {
        return function ($value) use ($times) {
            return $value * $times;
        };
    }

    private function keyPerValueMultiplier()
    {
        return function ($value, $key) {
            return $value * $key;
        };
    }
}
