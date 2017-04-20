<?php

use Console\Console;
use Console\Styling\Compiler;
use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Styling\Template;
use Console\Tests\TestCase;

$expected = '\033[1mHello Aron\033[0m \033[1;36myou have some messages\033[0m';

$template = Mockery::mock ( Template::class );
$template->string = '[ { emphasise } Hello Aron ] [ { notice } you have some messages ]';
$template->blocks = 
[ 
	'[ { emphasise } Hello Aron ]' => 
		[ 'style' => 'emphasise', 'text' => 'Hello Aron' ],
	'[ { notice } you have some messages ]' =>
		[ 'style' => 'notice', 'text' => 'you have some messages' ]
];


/*
|--------------------------------------------------------------------------
| Emphasis style
|--------------------------------------------------------------------------
|
| 
*/

$style = Mockery::mock ( Style::class );
$style->definitions = $definitions = [ 'bold' ];

$styles = Mockery::mock ( Styles::class );
$styles->shouldReceive ( 'find' )->once ( )->andReturn ( $style );

$console = Mockery::mock ( Console::class );
$console->shouldReceive ( 'wrap' )->with ( 'Hello Aron', $definitions )->andReturn ( '\033[1mHello Aron\033[0m' );


/*
|--------------------------------------------------------------------------
| Notice style
|--------------------------------------------------------------------------
|
| 
*/
$style = Mockery::mock ( Style::class );
$style->definitions = $definitions = [ 'bold', 'coloured blue' ];

$styles->shouldReceive ( 'find' )->once ( )->andReturn ( $style );

$console->shouldReceive ( 'wrap' )->with ( 'you have some messages', $definitions )->andReturn ( '\033[1;36myou have some messages\033[0m' );


$compiler = new Compiler ( $console, $styles );
$formatted = $compiler->compile ( $template );