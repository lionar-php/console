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
	| The style name is the main identifier of the style. The name is stored
	| lowercased. The name of a style may not empty.
	| 
	*/

	/**
	 * @test
	 * @dataProvider names
	 */
	public function __construct_withStringForName_setsNameOnStyle ( string $name )
	{
		$style = new Style ( $name, 'definitions' );
		assertThat ( $style->name, is ( identicalTo ( strtolower ( $name ) ) ) );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function __construct_withEmptyStringForName_throwsException ( )
	{
		$style = new Style ( '', 'definitions' );
	}

	/*
	|--------------------------------------------------------------------------
	| Style definitions
	|--------------------------------------------------------------------------
	| Definitions is a string which we separate by comma and the word 'and'. This
	| way we end up with an array of definitions stored on the style. The definitions
	| are stored lowercased.
	|
	| Example: 'Bold, italics and coloured red' -> [ 'bold', 'italics', 'coloured red' ]
	| 
	*/

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
	| Style tags
	|--------------------------------------------------------------------------
	| Tagging provides the ability to have multiple names refer to the same style.
	| This means that if i tag a style called 'emphasis' with 'intensified' i can
	| refer to the 'emphasis' style via the tag name 'intensified'. All tag names
	| are set in lowercase on the style.
	| 
	*/

	/**
	 * @test
	 * @dataProvider tags
	 */
	public function tag_withStringForTag_setsTagOnStyle ( string $tag, array $expectation )
	{
		$style = new Style ( 'emphasis', 'mock definitions' );
		$style->tag ( $tag );
		$style->tag ( $tag );
		assertThat ( $style->tags, is ( identicalTo ( $expectation ) ) );
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

	public function tags ( )
	{
		return
		[
			[ 'intensified', [ 'intensified' ] ],
			[ 'emphasised', [ 'emphasised' ] ],
			[ 'Emphasised', [ 'emphasised' ] ],
			[ 'InTenSIfIed', [ 'intensified' ] ],
			[ '   InTenSIfIed  ', [ 'intensified' ] ],
		];
	}
}