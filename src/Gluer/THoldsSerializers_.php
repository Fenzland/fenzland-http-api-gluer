<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Gluer;

use Fenzland\HttpApiGluer\serializers as S;

////////////////////////////////////////////////////////////////

trait THoldsSerializers_
{

	/**
	 * Static method registerSerializer_
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param  string $mime
	 * @param  class|S\ASerializer $serializer
	 *
	 * @return class
	 */
	static public function registerSerializer_( string$mime, $serializer ):string
	{
		static::checkSerializerNotRegistered_( $mime );

		static::checkSerializer_( $serializer );

		static::$serializers[$mime]= $serializer;

		return self::class;
	}

	/**
	 * Static method getSerializer
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @param  string $mime
	 *
	 * @return mixed
	 */
	static public function getSerializer( string$mime )
	{
		return static::$serializers[$mime]??null;
	}

	/**
	 * Static method getSerializers
	 *
	 * @static
	 *
	 * @access public
	 *
	 * @return array
	 */
	static public function getSerializers():array
	{
		return static::$serializers;
	}

	/**
	 * Static var serializers
	 *
	 * @static
	 * @access protected
	 *
	 * @var    array
	 */
	static protected $serializers= [
		'application/octet-stream'=> S\Raw::class,
		'application/php-serialized'=> S\PHPSerialized::class,
		'application/json'=> S\JSON::class,
		'application/x-www-form-urlencoded'=> S\Form::class,
		'multipart/form-data'=> S\FormM::class,
	];

	/**
	 * Static method checkSerializer_
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  mixed $serializer
	 *
	 * @return void
	 */
	static protected function checkSerializer_( $serializer ):void
	{
		if(!(
			(
				is_object( $serializer )
			&&
				$serializer instanceof S\ASerializer
			)
		or
			(
				is_string( $serializer )
			&&
				class_exists( $serializer )
			&&
				isset( class_parents( $serializer )[S\ASerializer::class] )
			)
		)){
			$caller= debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 2 )[1];

			throw new \TypeError(
				"Argument 2 passed to {$caller['class']}{$caller['type']}{$caller['function']}() must be an class extends ".S\ASerializer::class.' or it\'s instance'
			);
		}
	}

	/**
	 * Static method checkSerializerNotRegistered_
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return void
	 */
	static protected function checkSerializerNotRegistered_( string$mime ):void
	{
		if( isset( static::$serializers[$mime] ) )
		{
			throw new \Exception(
				"Content type $mime is already registered."
			);
		}
	}

	/**
	 * Static method checkSerializerSupported_
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return void
	 */
	static protected function checkSerializerSupported_( string$mime ):void
	{
		if(!( isset( static::$serializers[$mime] ) ))
		{
			throw new \Exception(
				"Content type $mime is not supported. Please register serialize first."
			);
		}
	}

	/**
	 * Static method getSerializer_
	 *
	 * @static
	 *
	 * @access protected
	 *
	 * @param  string $mime
	 *
	 * @return S\ASerializer
	 */
	static protected function getSerializer_( string$mime ):S\ASerializer
	{
		static::checkSerializerSupported_( $mime );

		$serializer= static::$serializers[$mime];

		return is_object( $serializer )? $serializer : new $serializer;
	}

}
