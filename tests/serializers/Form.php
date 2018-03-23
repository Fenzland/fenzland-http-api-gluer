<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\serializers;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\Form as Testee;

////////////////////////////////////////////////////////////////

class Form extends TestCase
{

	/**
	 * Method testEncode
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testEncode():void
	{
		$testee= new Testee;

		$decoded= [ 'foo'=>[ 'c'=>'1', 'n'=>'0', ], 'bar'=>'bar', 'baz'=>['8','6','4','1',], ];
		$encoded= 'foo%5Bc%5D=1&foo%5Bn%5D=0&bar=bar&baz%5B0%5D=8&baz%5B1%5D=6&baz%5B2%5D=4&baz%5B3%5D=1';

		$this->assertSame( $encoded, $testee->encode( $decoded ) );
	}

	/**
	 * Method testDecode
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testDecode():void
	{
		$testee= new Testee;

		$decoded= [ 'foo'=>[ 'c'=>'1', 'n'=>'0', ], 'bar'=>'bar', 'baz'=>['8','6','4','1',], ];
		$encoded= 'foo%5Bc%5D=1&foo%5Bn%5D=0&bar=bar&baz%5B0%5D=8&baz%5B1%5D=6&baz%5B2%5D=4&baz%5B3%5D=1';

		$this->assertSame( $decoded, $testee->decode( $encoded ) );
	}

}
