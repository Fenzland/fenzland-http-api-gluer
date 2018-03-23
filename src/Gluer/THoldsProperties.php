<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

trait THoldsProperties
{

	/**
	 * Static method make_
	 *
	 * @access public
	 *
	 * @param  string      $url
	 * @param  string      $method
	 * @param  Transformer $request_transformer
	 * @param  Transformer $response_transformer
	 * @param  string      $request_content_type
	 * @param  string      $response_content_type
	 */
	public function __construct(
		string      $url
	,
		string      $method
	,
		Transformer $request_transformer
	,
		Transformer $response_transformer
	,
		string      $request_content_type
	,
		string      $response_content_type= null
	)
	{
		$this->url=                   $url;
		$this->method=                $method;
		$this->request_transformer=   $request_transformer;
		$this->response_transformer=  $response_transformer;
		$this->request_content_type=  $request_content_type;
		$this->response_content_type= $response_content_type??$request_content_type;
	}

	/**
	 * Var url
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected $url;

	/**
	 * Var method
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected $method;

	/**
	 * Var request_transformer
	 *
	 * @access protected
	 *
	 * @var    Transformer
	 */
	protected $request_transformer;

	/**
	 * Var response_transformer
	 *
	 * @access protected
	 *
	 * @var    Transformer
	 */
	protected $response_transformer;

	/**
	 * Var request_content_type
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected $request_content_type;

	/**
	 * Var response_content_type
	 *
	 * @access protected
	 *
	 * @var    string
	 */
	protected $response_content_type;

}
