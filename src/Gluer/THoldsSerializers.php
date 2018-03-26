<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use Fenzland\HttpApiGluer\serializers as S;

////////////////////////////////////////////////////////////////

trait THoldsSerializers
{

	/**
	 * Method registerSerializer
	 *
	 * @access public
	 *
	 * @param  string $mime
	 * @param  class|S\ASerializer $serializer
	 *
	 * @return self
	 */
	public function registerSerializer( string$mime, $serializer ):self
	{
		$this->checkSerializerNotRegistered( $mime );

		static::checkSerializer_( $serializer );

		$this->serializers[$mime]= $serializer;

		return $this;
	}

	/**
	 * Method getSerializer
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param  string $mime
	 *
	 * @return mixed
	 */
	public function getSerializer( string$mime )
	{
		return $this->serializers[$mime]??static::$serializers_[$mime]??null;
	}

	/**
	 * Method getSerializers
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @return array
	 */
	public function getSerializers():array
	{
		return $this->serializers+static::$serializers_;
	}

	/**
	 * Static var serializers
	 *
	 * @static
	 * @access protected
	 *
	 * @var    array
	 */
	protected $serializers= [];

	/**
	 * Method checkSerializerNotRegistered
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return void
	 */
	protected function checkSerializerNotRegistered( string$mime ):void
	{
		if( isset( $this->serializers[$mime] ) )
		{
			throw new \Exception(
				"Content type $mime is already registered."
			);
		}
	}

	/**
	 * Method checkSerializerSupported
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return void
	 */
	protected function checkSerializerSupported( string$mime ):void
	{
		if(!( isset( $this->serializers[$mime] ) || isset( static::$serializers_[$mime] ) ))
		{
			throw new \Exception(
				"Content type $mime is not supported. Please register serialize first."
			);
		}
	}

	/**
	 * Static method achieveSerializer
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return S\ASerializer
	 */
	protected function achieveSerializer( string$mime ):S\ASerializer
	{
		$this->checkSerializerSupported( $mime );

		$serializer= $this->getSerializer( $mime );

		return static::instantiateSerializer_( $serializer );
	}

}
