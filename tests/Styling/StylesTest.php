<?php

namespace Console\Styling\Tests;

use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Tests\TestCase;
use Mockery;

class StylesTest extends TestCase
{
	private $styles = null;

	public function setUp ( )
	{
		$this->styles = new Styles;
		$this->style = Mockery::mock ( Style::class );
		$this->style->name = 'emphasis';
	}

	/*
	|--------------------------------------------------------------------------
	| Adding styles to the styles collection.
	|--------------------------------------------------------------------------
	| Add provides the ability to add a style to the styles collection. Add checks
	| wether the given style already exists. It does this by the style name. If the
	| name is found within the styles collection an exception is thrown.
	| 
	*/

	/**
	 * @test
	 */
	public function add_withStyle_addsStyleToStyles ( )
	{
		$this->styles->add ( $this->style );
		assertThat ( $this->styles->has ( $this->style ), is ( identicalTo ( true ) ) );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function add_withStyleThatAlreadyExists_throwsException ( )
	{
		$this->styles->add ( $this->style );
		$this->styles->add ( $this->style );
	}

	/*
	|--------------------------------------------------------------------------
	| Checking wether a style exists in the styles collection.
	|--------------------------------------------------------------------------
	| Has provides the ability to check wether a style with the same name as the
	| given style exists in the styles collection.
	| 
	*/

	/**
	 * @test
	 */
	public function has_withStyleNameThatDoesNotExistInStyles_returnsFalse ( )
	{
		$style = Mockery::mock ( Style::class );
		$style->name = 'inexistent style';

		assertThat ( $this->styles->has ( $style ), is ( identicalTo ( false ) ) );
	}

	/*
	|--------------------------------------------------------------------------
	| Finding styles from the style collection.
	|--------------------------------------------------------------------------
	| Find provides a way to find a style by name. It converts the name provided
	| to lowercase before searching. If a style is not found an exception is thrown.
	| 
	*/

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function find_withNameThatCanNotBeFoundWithinStyles_throwsException ( )
	{
		$this->styles->find ( 'non existent' );
	}

	/**
	 * @test
	 */
	public function find_withNameThatCanBeFound_returnsStyle ( )
	{
		$this->styles->add ( $this->style );
		$style = $this->styles->find ( $this->style->name );
		assertThat ( $style, is ( identicalTo ( $this->style ) ) );
	}
}