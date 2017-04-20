<?php

namespace Console\Styling\Tests;

use Console\Styling\Template;
use Console\Tests\TestCase;

class TemplateTest extends TestCase
{
	/**
	 * @test
	 * @dataProvider strings
	 */
	public function __construct_withTemplateString_setStringOntoTemplate ( string $string )
	{
		$template = new Template ( $string );
		assertThat ( $template->string, is ( identicalTo ( $string ) ) );
	}

	/**
	 * @test
	 * @dataProvider strings
	 */
	public function __construct_withTemplateString_explodesBlocksOntoTemplate ( string $string, array $blocks )
	{
		$template = new Template ( $string );
		assertThat ( $template->blocks, is ( identicalTo ( $blocks ) ) );
	}

	/**
	 * @test
	 * @expectedException InvalidargumentException
	 * @dataProvider incorrectFormattedStrings
	 */
	public function __construct_withIncorrectlyFormedTemplatedBlock_throwsException ( string $string )
	{
		$template = new Template ( $string );
	}
	

	/*
	|--------------------------------------------------------------------------
	| Data providers
	|--------------------------------------------------------------------------
	|
	| 
	*/

	public function strings ( )
	{
		return 
		[
			[ '[ { emphasis } Hello Aron ], [ { notice } you are logged in ].', 
				[ 
					'[ { emphasis } Hello Aron ]' => 
						[ 'style' => 'emphasis', 'text' => 'Hello Aron' ],
					'[ { notice } you are logged in ]' =>
						[ 'style' => 'notice', 'text' => 'you are logged in' ] 
				] 
			],
			[ 'Hello world', [ ] ],
			[ '[ { alert } Watch out, the system might break ].', 
				[ '[ { alert } Watch out, the system might break ]' => 
					[ 'style' => 'alert', 'text' => 'Watch out, the system might break' ] 
				] 
			],
		];
	}

	public function incorrectFormattedStrings ( )
	{
		return
		[
			[ '[ notice Hello world ]' ],
			[ '[{notice} Hello world]' ],
		];
	}
}