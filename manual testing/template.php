<?php

use Console\Styling\Template;

require __DIR__ . '/../vendor/autoload.php';

$template = new Template ( '[ { notice } Hello world ]' );

var_dump ( $template );