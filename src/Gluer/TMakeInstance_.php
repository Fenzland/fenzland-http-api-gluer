<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

trait TMakeInstance_
{

	/**
	 * Static method make_
	 *
	 * @static
	 * @access public
	 *
	 * @param  string $url
	 * @param  string $method
	 * @param  array  $request_transformer_meta
	 * @param  array  $response_transformer_meta
	 * @param  string $request_content_type
	 * @param  string $response_content_type
	 *
	 * @return self
	 */
	static public function make_(
		string $url
	,
		string $method
	,
		array  $request_transformer_meta
	,
		array  $response_transformer_meta
	,
		string $request_content_type
	,
		string $response_content_type= null
	):self
	{
		return new static(
			$url
		,
			$method
		,
			Transformer::make_( $request_transformer_meta )
		,
			Transformer::make_( $response_transformer_meta )
		,
			$request_content_type
		,
			$response_content_type??$request_content_type
		);
	}

}
