<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\serializers;

////////////////////////////////////////////////////////////////

abstract class ASerializer
{

	/**
	 * Method encode
	 *
	 * @abstract
	 * @access public
	 *
	 * @param  mixed $data
	 *
	 * @return string
	 */
	abstract public function encode( $data ):string;

	/**
	 * Method decode
	 *
	 * @abstract
	 * @access public
	 *
	 * @param  string $encoded
	 *
	 * @return mixed
	 */
	abstract public function decode( string$encoded );

}
