<?php

namespace Console\Styling\Tests;

use Console\Console;
use Console\Styling\Compiler;
use Console\Styling\Style;
use Console\Styling\Styles;
use Console\Styling\Template;
use Console\Tests\TestCase;
use Mockery;

class CompilerTest extends TestCase
{
	/**
	 * @test
	 * @dataProvider setups
	 */
	public function compile_withTemplate_returnsTemplateStringWrappedWithConsoleCodes ( string $file )
	{
		require __DIR__ . "/../setups/compile use cases/{$file}.php";
		assertThat ( $formatted, is ( identicalTo ( $expected ) ) );
	}

	public function setups ( )
	{
		return
		[
			[ 'one block template' ],
			[ 'two block template' ],
		];
	}
}