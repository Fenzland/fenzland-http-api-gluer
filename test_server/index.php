<?php

declare( strict_types= 1 );

require '../vendor/autoload.php';

$path_info= array_filter( explode( '/', $_SERVER['PATHINFO']??strtok( $_SERVER['REQUEST_URI'], '?' ) ) );

$method= "_{$_SERVER['REQUEST_METHOD']}_";

$controller= (
	'Fenzland\\HttpApiGluer\\TestServer\\'
.
	str_replace( '-', '', ucwords( array_shift( $path_info )??'index', '-' ) )
);

if(!(
	class_exists( $controller )
and
	method_exists( $controller, $method )
)){
	Fenzland\HttpApiGluer\TestServer\_404::_GET_();
}

$controller::$method();
