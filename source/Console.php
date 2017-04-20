<?php

namespace Console;

interface Console
{
	/**
	 * Wrap the given text with console codes based
	 * on the provided array of definitions.
	 * 
	 * @param  string $text        	The text to wrap with console codes.
	 * @param  array  $definitions 	The definitions to create the code from
	 * 
	 * @example  $definitions = [ 'bold', 'italics' ]
	 * 
	 * @return string              	The text wrapped with console codes.
	 */
	public function wrap ( string $text, array $definitions = [ ] ) : string;
}