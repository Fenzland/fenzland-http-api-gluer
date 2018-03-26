<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\ASerializer;
use Fenzland\HttpApiGluer\Gluer as Testee;

////////////////////////////////////////////////////////////////

class RegisterSerializer extends TestCase
{

	/**
	 * Method testAddClass
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testAddClass():void
	{
		$instance= new class extends ASerializer {

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
				return 'encoded string';
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
				return 'decoded data';
			}
		};

		$class= get_class( $instance );

		Testee::registerSerializer_( 'test/class', $class );

		$this->assertArrayHasKey( 'test/class', Testee::getSerializers_() );
		$this->assertSame( $class, Testee::getSerializer_( 'test/class' ) );
	}

	/**
	 * Method testAddInstance
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testAddInstance():void
	{
		$instance= new class extends ASerializer {

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
				return 'encoded string';
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
				return 'decoded data';
			}
		};

		Testee::registerSerializer_( 'test/instance', $instance );

		$this->assertArrayHasKey( 'test/instance', Testee::getSerializers_() );
		$this->assertSame( $instance, Testee::getSerializer_( 'test/instance' ) );
	}

	/**
	 * Method testFaildAddClass
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testFaildAddClass():void
	{
		$this->expectException( \TypeError::class );
		Testee::registerSerializer_( 'test/class-failed', \stdClass::class );

		$this->expectException( \TypeError::class );
		Testee::registerSerializer_( 'test/class-failed', NotExistClass::class );
	}

	/**
	 * Method testFaildAddInstance
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testFaildAddInstance():void
	{
		$this->expectException( \TypeError::class );
		Testee::registerSerializer_( 'test/instance-failed', new \stdClass );
	}

	/**
	 * Method testRepeatAddding
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testRepeatAddding():void
	{
		$instance= new class extends ASerializer {

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
				return 'encoded string';
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
				return 'decoded data';
			}
		};

		Testee::registerSerializer_( 'test/json', $instance );

		$this->expectException( \Exception::class );
		Testee::registerSerializer_( 'test/json', $instance );
	}

}
