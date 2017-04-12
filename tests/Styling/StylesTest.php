<?php

namespace Console\Styling\Tests;

use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Tests\TestCase;
use Mockery;

class StylesTest extends TestCase
{
	private $styles, $style = null;

	public function setUp ( )
	{
		$this->styles = new Styles;
		$this->style = Mockery::mock ( Style::class );
		$this->style->name = 'emphasis';
		$this->style->tags = [ 'intensified' ];
	}

	/*
	|--------------------------------------------------------------------------
	| Adding styles
	|--------------------------------------------------------------------------
	| Add gives the ability to add a style to the styles collection.
	| 
	*/

	/**
	 * @test
	 */
	public function add_withStyle_addsStyleToStyles ( )
	{
		$this->styles->add ( $this->style );
		assertThat ( $this->styles->elements, hasItemInArray ( $this->style ) );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function add_withStyleWithNameThatAlreadyExistsOnStyles_throwsException ( )
	{
		$this->styles->add ( $this->style );
		$this->styles->add ( $this->style );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage The following names where already stored as either style names or style tags: intensified. This means these names can no longer be used neither as style name or style tag.
	 */
	public function add_withStyleWithTagNameThatAlreadyExistsOnStyles_throwsException ( )
	{
		$style = Mockery::mock ( Style::class );
		$style->name = 'intensified';

		$this->styles->add ( $this->style );
		$this->styles->add ( $style );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 * @expectedExceptionMessage The following names where already stored as either style names or style tags: emphasis. This means these names can no longer be used neither as style name or style tag.
	 */
	public function add_withStyleWithTagsThatAlreadyExistsOnStyles_throwsException ( )
	{
		$style = Mockery::mock ( Style::class );
		$style->tags = [ 'emphasis' ];

		$this->styles->add ( $this->style );
		$this->styles->add ( $style );
	}
}