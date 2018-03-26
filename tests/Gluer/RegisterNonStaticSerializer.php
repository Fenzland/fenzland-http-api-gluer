<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\ASerializer;
use Fenzland\HttpApiGluer\Gluer as Testee;

////////////////////////////////////////////////////////////////

class RegisterNonStaticSerializer extends TestCase
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

		$testee= Testee::make_( 'https://foo', 'GET', [], [], 'test/class' );

		$testee->registerSerializer( 'test/class', $class );

		$this->assertArrayHasKey( 'test/class', $testee->getSerializers() );
		$this->assertSame( $class, $testee->getSerializer( 'test/class' ) );
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

		$testee= Testee::make_( 'https://foo', 'GET', [], [], 'test/instance' );

		$testee->registerSerializer( 'test/instance', $instance );

		$this->assertArrayHasKey( 'test/instance', $testee->getSerializers() );
		$this->assertSame( $instance, $testee->getSerializer( 'test/instance' ) );
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
		$testee= Testee::make_( 'https://foo', 'GET', [], [], 'test/class-failed' );

		$this->expectException( \TypeError::class );
		$testee->registerSerializer( 'test/class-failed', \stdClass::class );

		$this->expectException( \TypeError::class );
		$testee->registerSerializer( 'test/class-failed', NotExistClass::class );
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
		$testee= Testee::make_( 'https://foo', 'GET', [], [], 'test/instance-failed' );

		$this->expectException( \TypeError::class );
		$testee->registerSerializer( 'test/instance-failed', new \stdClass );
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

		$testee= Testee::make_( 'https://foo', 'GET', [], [], 'text/json' );

		$testee->registerSerializer( 'test/json', $instance );

		$this->expectException( \Exception::class );
		$testee->registerSerializer( 'test/json', $instance );
	}

}
