<?php

if(!( function_exists( 'v' ) ))
{
	function v( $data, ...$others )
	{
		var_dump( $data, ...$others );

		return $data;
	}
}

if(!( function_exists( 'd' ) ))
{
	function d( $data, ...$others )
	{
		var_dump( $data, ...$others );

		die;
	}
}
