<?php

use PHPUnit\Framework\TestCase;

require 'functions.php';

class findJobTest extends TestCase
{
    public function testSuccess()
    {
        $requirements = [
            'A' => [
                'required' => ['property'],
                'conditional' => [
                    ['bike', 'driver\'s license'],
                ],
            ],
            'B' => [
                'conditional' => [
                    ['bike', 'driver\'s license'],
                ],
            ],
            'C' => [
                'required' => ['car insurance'],
                'conditional' => [
                    ['5 door car', '4 door car'],
                ],
            ],
            'D' => [],
        ];

        $qualifications = ['bike', 'driver\'s license'];

        $actual = findJob($requirements, $qualifications);
        $expected = ['B' => 100, 'D' => 100, 'A' => 50, 'C' => 0];

        $this->assertSame($expected, $actual);
    }
}