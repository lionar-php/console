<?php

use Console\ANSI\Colours;
use Console\ANSI\Console;
use Console\ANSI\TextFormatting;

use Console\Styling\Compiler;
use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Styling\Template;

require __DIR__ . '/../vendor/autoload.php';


/*
|--------------------------------------------------------------------------
| Setting up the ANSI console.
|--------------------------------------------------------------------------
|
| 
*/

$colours = new Colours;
$textFormatting = new TextFormatting;

$console = new Console ( $colours, $textFormatting );


/*
|--------------------------------------------------------------------------
| Setting up the available console styles.
|--------------------------------------------------------------------------
|
| 
*/

$available = 
[
	new Style ( 'emphasis', 'bold' ),
	new Style ( 'error', 'Bold, italics and coloured red' ),
	new Style ( 'weirdo', 'Bold, italics, underlined, crossed out and coloured blue' ),
];

$styles = new Styles;

foreach ( $available as $style )
	$styles->add ( $style );

/*
|--------------------------------------------------------------------------
| Setting up the compiler.
|--------------------------------------------------------------------------
|
| 
*/

$compiler = new Compiler ( $console, $styles );


/*
|--------------------------------------------------------------------------
| Compiling a template.
|--------------------------------------------------------------------------
|
| 
*/

$template = new Template ( '[ { emphasis } Hello Irsan ], [ { weirdo } i am Aron ].' );

var_dump ( $compiler->compile ( $template ) );