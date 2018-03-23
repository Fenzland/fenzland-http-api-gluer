<?php

declare( strict_types= 1 );

namespace Fenzland\HttpApiGluer\Tests\Gluer;

use PHPUnit\Framework\TestCase;
use Fenzland\HttpApiGluer\Gluer as Testee;
use Fenzland\DataParser\Transformer;

////////////////////////////////////////////////////////////////

class MakeInstance extends TestCase
{

	/**
	 * Method testConsturctor
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testConsturctor():void
	{
		$instance= new Testee(
			$url= 'http://127.0.0.1:12867/resource/{id}'
		,
			$method= 'GET'
		,
			$request_transformer= Transformer::make_( [ 'path'=>[ 'id'=>'id', ], ] )
		,
			$response_transformer= Transformer::make_( [ 'name'=>[ 'body', 'name', ], ] )
		,
			$request_content_type= 'application/php-serialized'
		,
			$response_content_type= 'application/json'
		);

		$r_Testee= new \ReflectionClass( Testee::class );

		$r_url= $r_Testee->getProperty( 'url' );
		$r_url->setAccessible( true );

		$this->assertSame( $url, $r_url->getValue( $instance ) );

		$r_method= $r_Testee->getProperty( 'method' );
		$r_method->setAccessible( true );

		$this->assertSame( $method, $r_method->getValue( $instance ) );

		$r_request_transformer= $r_Testee->getProperty( 'request_transformer' );
		$r_request_transformer->setAccessible( true );

		$this->assertSame( $request_transformer, $r_request_transformer->getValue( $instance ) );

		$r_response_transformer= $r_Testee->getProperty( 'response_transformer' );
		$r_response_transformer->setAccessible( true );

		$this->assertSame( $response_transformer, $r_response_transformer->getValue( $instance ) );

		$r_request_content_type= $r_Testee->getProperty( 'request_content_type' );
		$r_request_content_type->setAccessible( true );

		$this->assertSame( $request_content_type, $r_request_content_type->getValue( $instance ) );

		$r_response_content_type= $r_Testee->getProperty( 'response_content_type' );
		$r_response_content_type->setAccessible( true );

		$this->assertSame( $response_content_type, $r_response_content_type->getValue( $instance ) );
	}

	/**
	 * Method testMake_
	 *
	 * @access public
	 *
	 * @return void
	 */
	public function testMake_():void
	{
		$instance= Testee::make_(
			$url= 'http://127.0.0.1:12867/resource/{id}'
		,
			$method= 'GET'
		,
			$request_transformer_meta= [ 'path'=>[ 'id'=>'id', ], ]
		,
			$response_transformer_meta= [ 'name'=>[ 'body', 'name', ], ]
		,
			$request_content_type= 'application/php-serialized'
		,
			$response_content_type= 'application/json'
		);

		$r_Testee= new \ReflectionClass( Testee::class );

		$r_url= $r_Testee->getProperty( 'url' );
		$r_url->setAccessible( true );

		$this->assertSame( $url, $r_url->getValue( $instance ) );

		$r_method= $r_Testee->getProperty( 'method' );
		$r_method->setAccessible( true );

		$this->assertSame( $method, $r_method->getValue( $instance ) );

		$r_request_transformer= $r_Testee->getProperty( 'request_transformer' );
		$r_request_transformer->setAccessible( true );

		$this->assertEquals( Transformer::make_( $request_transformer_meta ), $r_request_transformer->getValue( $instance ) );

		$r_response_transformer= $r_Testee->getProperty( 'response_transformer' );
		$r_response_transformer->setAccessible( true );

		$this->assertEquals( Transformer::make_( $response_transformer_meta ), $r_response_transformer->getValue( $instance ) );

		$r_request_content_type= $r_Testee->getProperty( 'request_content_type' );
		$r_request_content_type->setAccessible( true );

		$this->assertSame( $request_content_type, $r_request_content_type->getValue( $instance ) );

		$r_response_content_type= $r_Testee->getProperty( 'response_content_type' );
		$r_response_content_type->setAccessible( true );

		$this->assertSame( $response_content_type, $r_response_content_type->getValue( $instance ) );
	}

}
