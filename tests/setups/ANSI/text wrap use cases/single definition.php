<?php

use Console\ANSI\Colours;
use Console\ANSI\Console;
use Console\ANSI\TextFormatting;

$colours = Mockery::mock ( Colours::class );
$textFormatting = Mockery::mock ( TextFormatting::class );
$textFormatting->shouldReceive ( 'has' )->andReturn ( true );
$textFormatting->shouldReceive ( 'format' )->with ( 'bold' )->andReturn ( 1 );

$definitions = [ 'bold' ];
$text = 'Hello Aron';


$console = new Console ( $colours, $textFormatting );

$wrapped = $console->wrap ( $text, $definitions );
$expectation = '\033[1mHello Aron\033[0m';