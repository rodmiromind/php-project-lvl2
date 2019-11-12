<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff\genDiff;

class GenDiffTest extends TestCase
{
    protected $firstFile;
    protected $secondFile;
    protected $result;

    protected function setUp(): void
    {
        $this->firstFile = __DIR__ . '/fixtures/before.json';
        $this->secondFile = __DIR__ . '/fixtures/after.json';
        $this->result = file_get_contents("fixtures/result", true);
    }

    public function testGenDiff(): void
    {
        $this->assertEquals($this->result, genDiff($this->firstFile, $this->secondFile));
    }
}
