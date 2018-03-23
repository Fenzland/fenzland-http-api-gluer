<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\TestServer;

////////////////////////////////////////////////////////////////

class Index
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
		header( 'Content-Type: text/html; charset=utf-8' );
		echo '<!DOCTYPE html><title>200</title><body>200</body>';
	}

}
