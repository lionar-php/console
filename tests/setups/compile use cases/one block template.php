<?php

use Console\Console;
use Console\Styling\Compiler;
use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Styling\Template;
use Console\Tests\TestCase;

$expected = '\033[1mHello world\033[0m';

$template = Mockery::mock ( Template::class );
$template->string = '[ { emphasise } hello world ]';
$template->blocks = [ '[ { emphasise } hello world ]' => [ 'style' => 'emphasise', 'text' => 'hello world' ] ];

$style = Mockery::mock ( Style::class );
$style->definitions = $definitions = [ 'bold' ];

$styles = Mockery::mock ( Styles::class );
$styles->shouldReceive ( 'find' )->once ( )->andReturn ( $style );

$console = Mockery::mock ( Console::class );
$console->shouldReceive ( 'wrap' )->with ( 'hello world', $definitions )->andReturn ( '\033[1mHello world\033[0m' );

$compiler = new Compiler ( $console, $styles );
$formatted = $compiler->compile ( $template );