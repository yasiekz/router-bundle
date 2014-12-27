<?php


$dir = (__DIR__) . DIRECTORY_SEPARATOR . 'Functional' . DIRECTORY_SEPARATOR . 'app';

$_SERVER['KERNEL_DIR'] = $dir;

include_once($dir . '/AppKernel.php');

$loader = require __DIR__ . '/../vendor/autoload.php';

