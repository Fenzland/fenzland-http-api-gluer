<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\serializers;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\ASerializer as Testee;

////////////////////////////////////////////////////////////////

class ExtendsASerializer extends TestCase
{

	/**
	 * Method testEncode
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testMain():void
	{
		$instance= new class extends Testee {

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

		$this->assertInstanceOf( Testee::class, $instance );
		$this->assertSame( 'encoded string', $instance->encode( [] ) );
		$this->assertSame( 'decoded data', $instance->decode( '' ) );
	}

}
