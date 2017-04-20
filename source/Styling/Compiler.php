<?php

namespace Console\Styling;

use Console\Console;
use function Console\with;

class Compiler
{
	private $console, $styles = null;

	public function __construct ( Console $console, Styles $styles )
	{
		$this->console = $console;
		$this->styles = $styles;
	}

	public function compile ( Template $template )
	{
		foreach ( $template->blocks as $block => $parts )
			$mapping [ $block ] = $this->fill ( $parts );
		return str_replace ( array_keys ( $mapping ), array_values ( $mapping ), $template->string );
	}

	private function fill ( array $parts )
	{
		$style = $this->styles->find ( $parts [ 'style' ] );
		return $this->console->wrap ( $parts [ 'text' ], with ( $style->definitions ) ); // console checks definitions
	}
}