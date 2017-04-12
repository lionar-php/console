<?php

namespace Console\Styling;

use Accessibility\Readable;
use InvalidArgumentException;

class Styles
{
	use Readable;

	private $elements = [ ];

	public function add ( Style $style )
	{
		if ( $this->has ( $style ) )
			$this->reportMistakesFor ( $style );
		$this->elements [ ] = $style;
	}

	public function has ( Style $style ) : bool
	{
		foreach ( $this->getNamesFrom ( $style ) as $name )
			if ( $this->matches ( $name ) )
				return true;
		return false;
	}

	public function matches ( string $name ) : bool
	{	
		foreach ( $this->elements as $style )
			foreach ( array_merge ( [ $style->name ], $style->tags ) as $storedName )
				if ( $name === $storedName )
					return true;
		return false;
	}

	private function getNamesFrom ( Style $style ) : array
	{
		return array_merge ( [ $style->name ], $style->tags );
	}

	private function reportMistakesFor ( Style $style )
	{		
		foreach ( $this->getNamesFrom ( $style ) as $name )
			if ( $this->matches ( $name ) )
				$forbiddenNames [ ] = $name;
		$this->message ( $forbiddenNames );
	}

	private function message ( array $forbiddenNames )
	{
		$forbiddenNames = implode ( ', ', $forbiddenNames );

		throw new InvalidArgumentException ( 
			"The following names where already stored as either style names or style tags: {$forbiddenNames}. This means these names can no longer be used neither as style name or style tag." );
	}
}