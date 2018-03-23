<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\serializers;

////////////////////////////////////////////////////////////////

class JSON extends ASerializer
{

	/**
	 * Method encode
	 *
	 * @access public
	 *
	 * @param  mixed $data
	 *
	 * @return string
	 */
	public function encode( $data ):string
	{
		return json_encode( $data );
	}

	/**
	 * Method decode
	 *
	 * @access public
	 *
	 * @param  string $encoded
	 *
	 * @return mixed
	 */
	public function decode( string$encoded )
	{
		return json_decode( $encoded, true );
	}

}
