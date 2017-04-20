<?php

namespace Console\ANSI;

use InvalidArgumentException;

class TextFormatting
{
	private $codes = 
	[
		'bold'				=> 1,
		'italic'			=> 3,
		'italics'			=> 3,
		'underline'			=> 4,
		'underlined'		=> 4,
		'strikethrough'		=> 9,
		'crossed out'		=> 9,
	];

	public function has ( string $format )
	{
		return isset ( $this->codes [ $format ] );
	}

	public function format ( string $format ) : string
	{
		if ( $this->has ( $format ) )
			return $this->codes [ $format ];
		throw new InvalidArgumentException ( "We cannot format the text: $format on ANSI consoles." );
	}
}