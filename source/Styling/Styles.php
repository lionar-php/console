<?php

namespace Console\Styling;

use InvalidArgumentException;

class Styles
{
	private $elements = [ ];

	public function add ( Style $style )
	{
		if ( $this->has ( $style ) )
			throw new InvalidArgumentException ( "A style with the name: $style->name already exists within this styles collection." );
		$this->elements [ ] = $style;
	}

	public function has ( Style $style ) : bool
	{
		foreach ( $this->elements as $stored )
			if ( $stored->name === $style->name )
				return true;
		return false;
	}

	public function find ( string $name ) : Style
	{
		if ( ! $style = $this->named ( $name ) )
			throw new InvalidArgumentException ( "A style by the name $name can not be found within this collection." );
		return $style;
	}

	private function named ( string $name )
	{
		foreach ( $this->elements as $stored )
			if ( $stored->name === strtolower ( $name ) )
				return $stored;
		return false;
	}
}