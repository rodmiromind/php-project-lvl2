<?php

namespace Differ\run;

use Docopt;
use function Differ\genDiff\genDiff;

$doc = <<<DOC
Generate diff

Usage:
  gendiff (-h|--help)
  gendiff (-v|--version)
  gendiff [--format <fmt>] <firstFile> <secondFile>

Options:
  -h --help                     Show this screen
  -v --version                  Show version
  --format <fmt>                Report format [default: pretty]

DOC;

$args = Docopt::handle($doc, array('version'=>'Generate Diff 1.0'));
if ($args['<firstFile>'] && $args['<secondFile>']) {
    $diff = genDiff($args['<firstFile>'], $args['<secondFile>']);
    echo $diff;
}