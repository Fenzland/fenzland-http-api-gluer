<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\serializers;

////////////////////////////////////////////////////////////////

class Raw extends ASerializer
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
		return (string)$data;
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
		return $encoded;
	}

}
