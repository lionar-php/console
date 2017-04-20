<?php

use Console\Styling\Style;
use Console\Styling\Styles;

require __DIR__ . '/../vendor/autoload.php';

$style = new Style ( 'emphasis', 'bold, italics, underlined and coloured red' );

var_dump ( $style );


$styles = new Styles;
$styles->add ( $style );


var_dump ( $styles );

var_dump ( $styles->find ( 'emphasis' ) );