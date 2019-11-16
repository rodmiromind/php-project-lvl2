<?php

namespace Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\genDiff;

class GenDiffTest extends TestCase
{
    protected $firstFile;
    protected $secondFile;
    protected $result;

    protected function setUp(): void
    {
        $this->firstJsonFile = __DIR__ . '/fixtures/before.json';
        $this->secondJsonFile = __DIR__ . '/fixtures/after.json';
        $this->firstYmlFile = __DIR__ . '/fixtures/before.yml';
        $this->secondYmlFile = __DIR__ . '/fixtures/after.yml';
        $this->result = file_get_contents("fixtures/result", true);
    }

    public function testGenDiff(): void
    {
        $this->assertEquals($this->result, genDiff($this->firstJsonFile, $this->secondJsonFile));
        $this->assertEquals($this->result, genDiff($this->firstYmlFile, $this->secondYmlFile));
    }
}
