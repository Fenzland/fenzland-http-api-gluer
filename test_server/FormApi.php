<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\TestServer;

use Fenzland\HttpApiGluer\serializers\Form as Encryptor;

////////////////////////////////////////////////////////////////

class FormApi
{

	/**
	 * Static method _GET_
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function _GET_():void
	{
		header( 'HTTP/1.1 200 Not found' );
		header( 'Content-Type: application/json' );
		header( 'Gluer-Test: '.$_SERVER['HTTP_GLUER_TEST'] );
		echo http_build_query( [
			'call'=> 'successful',
			'path'=> $_SERVER['PATHINFO']??strtok( $_SERVER['REQUEST_URI'], '?' ),
			'query'=> $_GET,
		] );
	}

	/**
	 * Static method _POST_
	 *
	 * @static
	 * @access public
	 *
	 * @return void
	 */
	static public function _POST_():void
	{
		$data= (new Encryptor)->decode( file_get_contents( 'php://input' ) );

		header( 'HTTP/1.1 200 Not found' );
		header( 'Content-Type: application/json' );
		echo http_build_query( [
			'call'=> 'successful',
			'data'=> $data,
		] );
	}

}
