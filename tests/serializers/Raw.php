<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\serializers;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\serializers\Raw as Testee;

////////////////////////////////////////////////////////////////

class Raw extends TestCase
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

		$decoded= '[ \'foo\'=>[ \'c\'=>1, \'n\'=>0, ], \'bar\'=>\'bar\', \'baz\'=>[8,6,4,1,], ]';
		$encoded= '[ \'foo\'=>[ \'c\'=>1, \'n\'=>0, ], \'bar\'=>\'bar\', \'baz\'=>[8,6,4,1,], ]';

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

		$decoded= '[ \'foo\'=>[ \'c\'=>1, \'n\'=>0, ], \'bar\'=>\'bar\', \'baz\'=>[8,6,4,1,], ]';
		$encoded= '[ \'foo\'=>[ \'c\'=>1, \'n\'=>0, ], \'bar\'=>\'bar\', \'baz\'=>[8,6,4,1,], ]';

		$this->assertSame( $decoded, $testee->decode( $encoded ) );
	}

}
