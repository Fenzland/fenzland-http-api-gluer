<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\Gluer as Testee;
use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

class RawApi extends TestCase
{

	/**
	 * Method testGET
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testGET():void
	{
		$instance= Testee::make_(
			'http://127.0.0.1:12867/raw-api/{id}'
		,
			'GET'
		,
			[
				'path'=> [ 'type'=>'map', 'items'=>[ 'id'=>'id', ], ],
				'query'=> [ 'type'=>'map', 'items'=>[ 'id'=>'id', 'name'=>'name', ], ],
				'headers'=> [ 'type'=>'map', 'items'=>[ 'Gluer-Test'=>'header', ] ],
			]
		,
			[
				'header_test'=> [ 'type'=>'value', 'keys'=>[ 'headers', 'Gluer-Test', ], ],
				'body'=> 'body',
			]
		,
			'application/octet-stream'
		);

		$data= $instance->call( [ 'id'=>8, 'name'=>'Gluer', 'header'=>'god non dog', ] );

		$this->assertSame(
			[
				'header_test'=> 'god non dog',
				'body'=> serialize( [
					'call'=> 'successful',
					'path'=> '/raw-api/8',
					'query'=> [ 'id'=>'8', 'name'=>'Gluer', ],
				] ),
			]
		,
			$data
		);
	}

	/**
	 * Method testPOST
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testPOST():void
	{
		$instance= Testee::make_(
			'http://127.0.0.1:12867/raw-api/{id}'
		,
			'POST'
		,
			[
				'body'=> 'name',
			]
		,
			[
				'body'=> 'body',
			]
		,
			'application/octet-stream'
		);

		$data= $instance->call( [ 'id'=>8, 'name'=>'Gluer', 'header'=>'god non dog', ] );

		$this->assertSame(
			[
				'body'=> serialize( [
					'call'=> 'successful',
					'data'=> 'Gluer',
				] ),
			]
		,
			$data
		);
	}

}
