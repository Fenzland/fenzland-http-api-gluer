<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\serializers;

////////////////////////////////////////////////////////////////

class Form extends ASerializer
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
		return http_build_query( $data );
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
		$data= [];

		foreach( explode( '&', $encoded ) as $value )
		{
			$key= urldecode( strtok( $value, '=' ) );
			$value= urldecode( strtok( '' ) );

			$keys= explode( '[', str_replace( ']', '', $key ) );

			$p= &$data;

			foreach( $keys as $key )
			{
				is_array( $p ) or $p= [];

				$p= &$p[$key];
			}

			$p= $value;

			unset( $p );
		}

		return $data;
	}

}
