<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\serializers;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\PHPSerialized as Testee;

////////////////////////////////////////////////////////////////

class PHPSerialized extends TestCase
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

		$decoded= [ 'foo'=>[ 'c'=>1, 'n'=>0, ], 'bar'=>'bar', 'baz'=>[8,6,4,1,], ];
		$encoded= 'a:3:{s:3:"foo";a:2:{s:1:"c";i:1;s:1:"n";i:0;}s:3:"bar";s:3:"bar";s:3:"baz";a:4:{i:0;i:8;i:1;i:6;i:2;i:4;i:3;i:1;}}';

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

		$decoded= [ 'foo'=>[ 'c'=>1, 'n'=>0, ], 'bar'=>'bar', 'baz'=>[8,6,4,1,], ];
		$encoded= 'a:3:{s:3:"foo";a:2:{s:1:"c";i:1;s:1:"n";i:0;}s:3:"bar";s:3:"bar";s:3:"baz";a:4:{i:0;i:8;i:1;i:6;i:2;i:4;i:3;i:1;}}';

		$this->assertSame( $decoded, $testee->decode( $encoded ) );
	}

}
