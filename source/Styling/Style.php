<?php

namespace Console\Styling;

use Accessibility\Readable;

class Style
{
	use Readable;

	private $name = '';
	private $definitions = [ ];
	private $tags = [ ];

	public function __construct ( string $name, string $definitions )
	{
		$this->name = strtolower ( $name );
		
		foreach ( $this->interpret ( $definitions ) as $definition )
			$this->add ( $definition );
	}

	public function tag ( string $tag )
	{
		$tag = strtolower ( trim ( $tag ) );

		if ( ! in_array ( $tag, $this->tags ) )
			$this->tags [ ] = $tag;
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
}