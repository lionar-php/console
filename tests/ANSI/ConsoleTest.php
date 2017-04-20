<?php

namespace Console\ANSI\Tests;

use Console\Tests\TestCase;

class ConsoleTest extends TestCase
{
	/**
	 * @test
	 */
	public function wrap_withTextAndDefinitions_wrapsTextWithCorrectConsoleCodes ( )
	{
		require __DIR__ . '/../setups/ANSI/text wrap use cases/single definition.php';
		assertThat ( $wrapped, is ( identicalTo ( $expectation ) ) );
	}
}