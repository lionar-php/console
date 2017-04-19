<?php

namespace Console\Styling;

use Accessibility\Readable;
use InvalidArgumentException;

class Style
{
	use Readable;

	private $name = '';
	private $definitions = [ ];

	public function __construct ( string $name, string $definitions )
	{
		$this->validate ( $name, $definitions );		
		$this->name = strtolower ( $name );

		foreach ( $this->interpret ( $definitions ) as $definition )
			$this->add ( $definition );
	}

	private function add ( string $definition )
	{
		$definition = strtolower ( trim ( $definition ) );

		if ( ! in_array ( $definition, $this->definitions ) )
			$this->definitions [ ] = $definition;
	}

	private function interpret ( string $definitions )
	{
		return preg_split ( '/and|,/', $definitions );
	}

	private function validate ( $name, $definitions )
	{
		if ( empty ( $name ) )
			throw new InvalidArgumentException ( 'The name of a style may not be empty' );
		
		if ( empty ( $definitions ) )
			throw new InvalidArgumentException ( 'The definitions of a style may not be empty.' );
	}
}