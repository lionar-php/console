<?php

namespace Console;

abstract class Command
{
	protected $arguments = [ ];
	protected $options = [ ];

	abstract public function task ( );

	protected function execute ( Input $input, Output $output )
	{
		$parameters = $this->getParameters ( $input );
		call_user_func_array ( $this->task, $parameters );
	}

	protected function getParameters ( Input $input )
	{
		foreach ( array_keys ( $this->arguments ) as $name )
			$parameters [ ] = $input->getArgument ( $name );
	}

	protected function options ( Input $input )
	{
		foreach ( array_keys ( $this->options ) as $option )
			if ( $input->getOption ( $option ) )
				$options [ ] = $option;
	}
}

$parameters = 
[
	'name' => 'Aron',

	'options' =>
	[
		'capitalize'
	],
];

array ( 'name' => 'Aron' ); // 
array ( 'capitalize' ); // options

class GreetCommand extends Command
{
	protected $name = 'greet';
	protected $description = 'Greet a person.';
	protected $arguments =
	[
		'name' =>
		[
			'description' => 'The name of the person who you want to greet.',
			'required' => false
		]
	];
	protected $options =
	[
		'capitalize' =>
		[
			'description' => 'When provided we capitalize the output.'
		],
	];

	public function task ( string $name = '', array $options = [ ] )
	{
		$greeting = 'Hello, ' . $name;
		if ( $options [ 'capitalize' ] )
			$greeting = strtoupper ( $greeting );
		return "[ { emphasis } $greeting ]";
	}
}




