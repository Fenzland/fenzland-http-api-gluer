<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use FenzHTTP\Response;

////////////////////////////////////////////////////////////////

trait TTransforming
{

	/**
	 * Method makeUrl
	 *
	 * @access protected
	 *
	 * @param  array $params
	 *
	 * @return string
	 */
	protected function makeUrl( array$params ):string
	{
		$url= $this->url;

		foreach( $params['path']??[] as $key=>$value )
		{
			$url= str_replace( "{{$key}}", $value, $url );
		}

		if( $params['query']??null )
		{
			$url.= '?'.http_build_query( $params['query'] );
		}

		return $url;
	}

	/**
	 * Method makeBody
	 *
	 * @access protected
	 *
	 * @param  mixed $params
	 *
	 * @return ?string
	 */
	protected function makeBody( $params ):?string
	{
		if( is_null( $params ) ) return null;

		return $this->achieveSerializer( $this->request_content_type )->encode( $params );
	}

	/**
	 * Method parseResponse
	 *
	 * @access protected
	 *
	 * @param  Response $response
	 *
	 * @return array
	 */
	protected function parseResponse( Response$response ):array
	{
		$headers= $response->headers;
		$body= $this->achieveSerializer( $this->response_content_type )->decode( $response->body );

		return $this->response_transformer->transform(
			[
				'headers'=> $headers,
				'body'=> $body,
			]
		);
	}

}
