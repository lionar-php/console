<?php

namespace Console\ANSI;

use InvalidArgumentException;

class Colours
{
	private $codes = 
	[ 
		'foreground' => 
		[
			'black'			=> 30,
			'red' 			=> 31,
			'green'			=> 32,
			'yellow'		=> 33,
			'blue'			=> 34,
			'purple'		=> 35,
			'cyan'			=> 36,
			'white'			=> 37,
		],

		'background' => 
		[
			'black' 		=> 40,
			'red' 			=> 41,
			'green' 		=> 42,
			'yellow'		=> 43,
			'blue'			=> 44,
			'purple'		=> 45,
			'cyan'			=> 46,
			'white'			=> 47
		]
	];

	public function foreground ( string $colour )
	{
		if ( isset ( $this->codes [ 'foreground' ] [ $colour ] ) )
			return $this->codes [ 'foreground' ] [ $colour ];
		throw new InvalidArgumentException ( "The colour: $colour is not available on ANSI consoles." );
	}

	public function background ( string $colour )
	{
		if ( isset ( $this->codes [ 'background' ] [ $colour ] ) )
			return $this->codes [ 'background' ] [ $colour ];
		throw new InvalidArgumentException ( "The colour: $colour is not available on ANSI consoles." );
	}
}