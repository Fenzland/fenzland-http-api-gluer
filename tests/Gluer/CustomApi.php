<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\Gluer as Testee;
use Fenzland\HttpApiGluer\serializers\ASerializer;
use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

class CustomApi extends TestCase
{

	/**
	 * Static method registerSerializer_
	 *
	 * @beforeClass
	 *
	 * @static
	 * @access public
	 *
	 * @return viod
	 */
	static public function registerSerializer_()
	{
		$serializer= new class extends ASerializer {

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
				return base64_encode( json_encode( $data ) );
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
				return json_decode( base64_decode( $encoded ), true );
			}
		};

		Testee::registerSerializer_( 'application/json-base64', $serializer );
	}

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
			'http://127.0.0.1:12867/json-base64-api/{id}'
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
			'application/json-base64'
		);

		$data= $instance->call( [ 'id'=>8, 'name'=>'Gluer', 'header'=>'god non dog', ] );

		$this->assertSame(
			[
				'result'=> 'successful',
				'path'=> '/json-base64-api/8',
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
			'http://127.0.0.1:12867/json-base64-api/{id}'
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
			'application/json-base64'
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
