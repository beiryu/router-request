<?php

/**
 * Used to define the routes in the system.
 * 404.
 * multiple methods
 */
$routes = array(
	'GET' => [
		'/hello' => 'hello@index',
		'/hello/{id}' => 'hello@show',
		
		'/goodbye' => 'goodbye@index'
	],
	'POST' => [
		'/hello' => 'hello@store'

	],
	'PUT' => [
		'/hello/{id}' => 'hello@update'

	],
	'DELETE' => [
		'/hello/{id}' => 'hello@destroy'

	],
);

$code = array(
	'404' => 'Not Found',
	'200' => 'Success',
);