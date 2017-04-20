<?php

namespace Console\ANSI\tests;

use Console\ANSI\Colours;
use Console\Tests\TestCase;

class ColoursTest extends TestCase
{
	private $colours = null;

	public function setUp ( )
	{
		$this->colours = new Colours;
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function foreground_withColourThatDoesntExist_throwsException ( )
	{
		$this->colours->foreground ( 'inexistent colour' );
	}

	/**
	 * @test
	 */
	public function foreground_withColourThatDoesExist_returnsColourCode ( )
	{
		assertThat ( $this->colours->foreground ( 'red' ), 
			is ( identicalTo ( 31 ) ) );
	}

	/**
	 * @test
	 * @expectedException InvalidArgumentException
	 */
	public function background_withColourThatDoesntExist_throwsException ( )
	{
		$this->colours->background ( 'inexistent colour' );
	}

	/**
	 * @test
	 */
	public function background_withColourThatDoesExist_returnsColourCode ( )
	{
		assertThat ( $this->colours->background ( 'red' ), 
			is ( identicalTo ( 41 ) ) );
	}
}