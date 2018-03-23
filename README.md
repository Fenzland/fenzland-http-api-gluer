HTTP API Gluer
================================

A library for calling HTTP API, and avoid hard code about details of specific API.

## Usage

```bash
composer require fenzland/http-api-gluer
```

Create instance of Gluer.

```php
use Fenzland\HttpApiGluer\Gluer;
use Fenzland\DataParser\Transformer;

$gluer= new Gluer(
	'https://url'           // URL of API.
,
	'POST'                  // Method of API.
,
	$request_transformer    // instance of Transformer.
,
	$response_transformer   // instance of Transformer.
,
	'application/json'      // content type of request
,
	'application/json'      // content type of response (optional if same with content type of request)
);

// or

$gluer= Gluer::make_(
	'https://url/{path_param}'
,
	'POST'
,
	$request_transformer_meta    // meta array of Transformer.
,
	$response_transformer_meta   // meta array of Transformer.
,
	'application/json'
);

```

Call api.

```php
$result= $gluer->call( $data );
```


## Account Types

### Built-in supported

* application/octet-stream
* application/php-serialized
* application/json
* application/x-www-form-urlencoded

### Extending

```php
use Fenzland\HttpApiGluer\serializers\ASerializer

class CustomSerializer extends ASerializer
{
	public function encode( $data ):string
	{
		# ...
	}

	public function decode( string$encoded )
	{
		# ...
	}
}

Gluer::registerSerializer_( 'custom/mime', CustomSerializer::class );
// or
Gluer::registerSerializer_( 'custom/mime', new CustomSerializer );
```


## About Transformer

Preliminary: [fenzland/data-parser](https://github.com/Fenzland/data-parser)

### Request Transformer

```php
[
	'path'=> ...,     // parameters in path example: https://github.com/{name}/{repo}
	'query'=> ...,    // parameters in url query example: ?key0=value0&key1=value1
	'headers'=> ...,  // parameters in header
	'body'=> ...,     // parameters or data in body
];
```

### Response Transformer

```php
[
	"foo_in_header"=> [
		'type'=> 'value',
		'keys'=> [ 'headers', "foo", ],
	],
	"bar_in_body"=> [
		'type'=> 'value',
		'keys'=> [ 'body', "bar", "baz", ],
	],
];
```
