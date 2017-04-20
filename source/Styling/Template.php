<?php

namespace Console\Styling;

use Accessibility\Readable;
use InvalidArgumentException;
use function Console\from;

class Template
{
	use Readable;

	private $string = '';
	private $blocks = [ ];

	public function __construct ( string $string )
	{
		$this->string = $string;
		preg_match_all ( '/\[[^\]]*\]/', $string, $matches );

		foreach ( $matches [ 0 ] as $block )
			$this->add ( $block );
	}

	private function add ( string $block )
	{
		if ( preg_match ( '/\[ { (.+) } (.+) \]/', $block ) !== 1 )
			throw new InvalidArgumentException ( 'Your template has one or more incorrectly formatted block\'s. 
				a block must follow exactly this pattern: [ { style } text ]. This is the block in question: ' . $block );
		$this->blocks [ $block ] = $this->split ( $block );
	}

	private function split ( string $block )
	{
		preg_match ( '/\{(.*)\}/', $block, $matches );

		$text = $this->strip ( $matches [ 0 ], from ( $block ) );

		return [ 'style' => trim ( $matches [ 1 ] ), 'text' => $text ];
	}

	private function strip ( string $remove, string $from )
	{
		$text = str_replace ( '[ ', '', $from );
		$text = str_replace ( ' ]', '', $text );

		return trim ( str_replace ( $remove, '', $text ) );
	}
}