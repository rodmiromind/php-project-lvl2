<?php

namespace Differ;

// $autoloadPath1 = __DIR__ . '/../../../autoload.php';
// $autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
// if (file_exists($autoloadPath1)) {
//     require_once $autoloadPath1;
// } else {
//     require_once $autoloadPath2;
// }
// require_once __DIR__ . "./../src/genDiff.php";
require_once __DIR__ . './../vendor/autoload.php';
use function Differ\genDiff\genDiff;
use PHPUnit\Framework\TestCase;

class genDiffTest extends TestCase
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