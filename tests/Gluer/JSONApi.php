<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\Gluer as Testee;
use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

class JSONApi extends TestCase
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
			'http://127.0.0.1:12867/json-api/{id}'
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
				'result'=> [ 'type'=>'value', 'keys'=>[ 'body', 'call', ], ],
				'path'=> [ 'type'=>'value', 'keys'=>[ 'body', 'path', ], ],
				'query'=> [ 'type'=>'value', 'keys'=>[ 'body', 'query', ], ],
				'header_test'=> [ 'type'=>'value', 'keys'=>[ 'headers', 'Gluer-Test', ], ],
			]
		,
			'application/json'
		);

		$data= $instance->call( [ 'id'=>8, 'name'=>'Gluer', 'header'=>'god non dog', ] );

		$this->assertSame(
			[
				'result'=> 'successful',
				'path'=> '/json-api/8',
				'query'=> [
					'id'=> '8',
					'name'=> 'Gluer',
				],
				'header_test'=> 'god non dog',
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
			'http://127.0.0.1:12867/json-api/{id}'
		,
			'POST'
		,
			[
				'body'=> [ 'type'=>'map', 'items'=>[ 'id'=>'id', 'name'=>'name', ], ],
			]
		,
			[
				'result'=> [ 'type'=>'value', 'keys'=>[ 'body', 'call', ], ],
				'id'=> [ 'type'=>'value', 'keys'=>[ 'body', 'data', 'id', ], 'meta'=>0, ],
				'name'=> [ 'type'=>'value', 'keys'=>[ 'body', 'data', 'name', ], 'meta'=>'', ],
			]
		,
			'application/json'
		);

		$data= $instance->call( [ 'id'=>8, 'name'=>'Gluer', 'header'=>'god non dog', ] );

		$this->assertSame(
			[
				'result'=> 'successful',
				'id'=> 8,
				'name'=> 'Gluer',
			]
		,
			$data
		);
	}

}
