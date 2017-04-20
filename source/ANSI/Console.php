<?php

namespace Console\ANSI;

use InvalidArgumentException;

class Console implements \Console\Console
{
	private $colours, $textFormatting = null;

	public function __construct ( Colours $colours, TextFormatting $textFormatting )
	{
		$this->colours = $colours;
		$this->textFormatting = $textFormatting;
	}

	public function wrap ( string $text, array $definitions = [ ] ) : string
	{
		foreach ( $definitions as $definition )
			$codes [ ] = $this->getCodeFor ( $definition );
		$open = $this->makeOpeningCodeFrom ( $codes );
		return $open . $text . '\033[0m';
	}

	private function getCodeFor ( string $definition ) : string
	{
		if ( $this->textFormatting->has ( $definition ) )
			return $this->textFormatting->format ( $definition );
		return $this->colourFor ( $definition );
	}

	private function colourFor ( string $definition ) : string
	{
		if ( preg_match ( '/coloured (?<colour>(.+))/', $definition, $matches ) )
			return $this->colours->foreground ( $matches [ 'colour' ] );

		if ( preg_match ( '/highlighted (?<colour>(.+))/', $definition, $matches ) )
			return $this->colours->foreground ( $matches [ 'colour' ] );

		throw new InvalidArgumentException ( 'We cannot use the following ability on the ANSI console: ' . $definition );
	}

	private function makeOpeningCodeFrom ( array $codes ) : string
	{
		$openingCode = '\033[';

		foreach ( $codes as $code )
			$openingCode .= $code . ';';

		return rtrim ( $openingCode, ';' ) . 'm';
	}
}