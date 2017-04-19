<?php

namespace Console\Styling\Tests;

use Console\Styling\Style;
use Console\Tests\TestCase;

class StyleTest extends TestCase
{
	/*
	|--------------------------------------------------------------------------
	| Style Name
	|--------------------------------------------------------------------------
	| The style name is the identifier of the style. The name is stored
	| lowercased. The name of a style may not empty.
	| 
	*/

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function __construct_withEmptyStringForName_throwsException ( )
	{
		$style = new Style ( '', 'Mock definitions' );
	}

	/**
	 * @test
	 * @dataProvider names
	 */
	public function __construct_withStringForName_setsNameAsLowerCaseOnStyle ( string $name )
	{
		$style = new Style ( $name, 'Mock definitions' );
		assertThat ( $style->name, is ( identicalTo ( strtolower ( $name ) ) ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Style definitions
	|--------------------------------------------------------------------------
	| Definitions is a string which we separate by comma and the word 'and'. This
	| way we end up with an array of definitions stored on the style. The definitions
	| are stored lowercased. The definitions string may not be empty.
	|
	| Example: 'Bold, italics and coloured red' -> [ 'bold', 'italics', 'coloured red' ]
	| 
	*/

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function __construct_withEmptyStringForDefinitions_throwsException ( )
	{
		$style = new Style ( 'mock name', '' );
	}

	/**
	 * @test
	 * @dataProvider definitions
	 */
	public function __construct_withStringForDefinitions_ExplodesDefinitionsAndSetsThemAsArrayOnStyle ( string $definitions, array $expectation )
	{
		$style = new Style ( 'mock name', $definitions );
		assertThat ( $style->definitions, is ( identicalTo ( $expectation ) ) );
	}


	/*
	|--------------------------------------------------------------------------
	| Data providers
	|--------------------------------------------------------------------------
	|
	| 
	*/

	public function names ( )
	{
		return
		[
			[ 'emphasis' ],
			[ 'Emphasised' ],
			[ 'ItAlIcS' ]
		];
	}

	public function definitions ( )
	{
		return
		[
			[ 'bold', [ 'bold' ] ],
			[ 'bold and italics', [ 'bold', 'italics' ] ],
			[ 'bold, italics and coloured red', [ 'bold', 'italics', 'coloured red' ] ],
			[ 'bold and bold', [ 'bold' ] ],
			[ 'bold and BoLd', [ 'bold' ] ],
			[ 'bold, BOLD and BOld', [ 'bold' ] ],
			[ 'Bold, ItAlIcS and ColoUred rEd', [ 'bold', 'italics', 'coloured red' ] ],
			[ 'bold,  italics  and      coloured red', [ 'bold', 'italics', 'coloured red' ] ]
		];
	}
}