<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\TestServer;

////////////////////////////////////////////////////////////////

class _404
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
		header( 'HTTP/1.1 404 Not found' );
		header( 'Content-Type: text/html; charset=utf-8' );
		echo '<!DOCTYPE html><title>404</title><body>404</body>';
	}

}
