<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use FenzHTTP\HTTP;
use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

trait __object
{
	use THoldsProperties;

	use THoldsSerializers;

	use TTransforming;

	/**
	 * Method call
	 *
	 * @access public
	 *
	 * @param  array $origin_params
	 *
	 * @return array
	 */
	public function call( array$origin_params ):array
	{
		$params= $this->request_transformer->transform( $origin_params );

		$response= HTTP::url( $this->makeUrl( $params ) )
			->method( $this->method )
			->headers( $params['headers']??[] )
			->header( 'Accept', $this->response_content_type )
			->header( 'Content-Type', $this->request_content_type )
			->send( $this->makeBody( $params['body']??null ) )
		;

		return $this->parseResponse( $response );
	}

}
