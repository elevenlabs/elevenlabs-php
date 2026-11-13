# Elevenlabs PHP Library

[![fern shield](https://img.shields.io/badge/%F0%9F%8C%BF-Built%20with%20Fern-brightgreen)](https://buildwithfern.com?utm_source=github&utm_medium=github&utm_campaign=readme&utm_source=Elevenlabs%2FPHP)
[![php shield](https://img.shields.io/badge/php-packagist-pink)](https://packagist.org/packages/elevenlabs/elevenlabs-php)

The Elevenlabs PHP library provides convenient access to the Elevenlabs APIs from PHP.

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Environments](#environments)
- [Exception Handling](#exception-handling)
- [Advanced](#advanced)
  - [Custom Client](#custom-client)
  - [Retries](#retries)
  - [Timeouts](#timeouts)
  - [WebSockets](#websockets)
- [Contributing](#contributing)

## Requirements

This SDK requires PHP ^8.1.

## Installation

```sh
composer require elevenlabs/elevenlabs-php
```

The SDK sends its requests through a [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client, which Composer installs for you only if your project allows the `php-http/discovery` plugin — add `"allow-plugins": {"php-http/discovery": true}` under `config` in your `composer.json`, or require a client yourself with `composer require guzzlehttp/guzzle` (or `composer require symfony/http-client nyholm/psr7`). Without either, the install succeeds with no HTTP client and the first API call fails at runtime.

## Usage

Instantiate and use the client with the following:

```php
<?php

namespace Example;

use ElevenLabs\ElevenLabs;
use ElevenLabs\History\Requests\DownloadHistoryRequest;

$client = new ElevenLabs();
$response = $client->history->download(
    new DownloadHistoryRequest([
        'historyItemIds' => [
            'history_item_ids',
        ],
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.

```

## Environments

This SDK allows you to configure different environments for API requests. It defaults to the `Production` environment.

```php
use ElevenLabs\ElevenLabs;
use ElevenLabs\Environments;

$client = new ElevenLabs(
    options: [
        'baseUrl' => Environments::ProductionUs->value,
    ],
);
```

Available environments:
- `Environments::Production`
- `Environments::ProductionUs`
- `Environments::ProductionEu`
- `Environments::ProductionIndia`
- `Environments::ProductionSingapore`

## Exception Handling

When the API returns a non-success status code (4xx or 5xx response), an exception will be thrown.
A successful response whose body does not match the expected type raises `ElevenlabsException`, with the underlying error as its previous exception.

```php
use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\Exceptions\ElevenlabsException;

try {
    $response = $client->history->download(...);
} catch (ElevenlabsApiException $e) {
    echo 'API Exception occurred: ' . $e->getMessage() . "\n";
    echo 'Status Code: ' . $e->getCode() . "\n";
    echo 'Response Body: ' . $e->getBody() . "\n";
    // Optionally, rethrow the exception or handle accordingly.
}
```

## Advanced

### Custom Client

This SDK is built to work with any HTTP client that implements the [PSR-18](https://www.php-fig.org/psr/psr-18/) `ClientInterface`.
By default, if no client is provided, the SDK will use `php-http/discovery` to find an installed HTTP client.
However, you can pass your own client that adheres to `ClientInterface`:

```php
use ElevenLabs\ElevenLabs;

// Pass any PSR-18 compatible HTTP client implementation.
// For example, using Guzzle:
$customClient = new \GuzzleHttp\Client([
    'timeout' => 5.0,
]);

$client = new ElevenLabs(options: [
    'client' => $customClient
]);
```

### Retries

The SDK is instrumented with automatic retries with exponential backoff. A request will be retried as long
as the request is deemed retryable and the number of retry attempts has not grown larger than the configured
retry limit (default: 2).

A request is deemed retryable when any of the following HTTP status codes is returned:

- [408](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/408) (Timeout)
- [429](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/429) (Too Many Requests)
- [5XX](https://developer.mozilla.org/en-US/docs/Web/HTTP/Status#server_error_responses) (Internal Server Error)

Use the `maxRetries` request option to configure this behavior.

```php
$response = $client->history->download(
    ...,
    options: [
        'maxRetries' => 0 // Override maxRetries at the request level
    ]
);
```

### Timeouts

The SDK defaults to a 240 second timeout. Use the `timeout` option, in
seconds, to configure this behavior for every request:

```php
use ElevenLabs\ElevenLabs;

$client = new ElevenLabs(options: [
    'timeout' => 10.0 // Applied to every request
]);
```

or for a single call:

```php
$response = $client->history->download(
    ...,
    options: [
        'timeout' => 3.0 // Override timeout at the request level
    ]
);
```

The SDK forwards `timeout` to Guzzle and Symfony HttpClient, the clients it configures directly;
other PSR-18 clients may ignore it, so set the timeout on that client instead.

### WebSockets

`$client->dubbing->live()` opens the connection and returns a `V1DubbingLiveSocket`. Send with its typed
methods (or `send()`), then iterate the socket to read messages until the server closes it; call `close()` when done.

```php
$socket = $client->dubbing->live(...);
try {
    $socket->sendPublish(...);
    foreach ($socket as $message) {
        // Handle each message.
    }
} finally {
    $socket->close();
}
```

The SDK has one socket per channel:

- `$client->dubbing->live()` returns a `V1DubbingLiveSocket`
- `$client->textToSpeech->realtime()` returns a `V1TextToSpeechVoiceIdStreamInputSocket`
- `$client->textToDialogue->realtime()` returns a `V1TextToDialogueStreamInputSocket`
- `$client->speechToText->realtime()` returns a `V1SpeechToTextRealtimeSocket`
- `$client->speechEngine->upstream()` returns a `SpeechEngineUpstreamSocket`
- `$client->textToDialogueMultiContext->realtime()` returns a `V1TextToDialogueMultiStreamInputSocket`
- `$client->textToSpeechMultiContext->realtime()` returns a `V1TextToSpeechVoiceIdMultiStreamInputSocket`
- `$client->translation->realtime()` returns a `V1TranslationRealtimeSocket`

Reading blocks the process, so run sockets in a CLI worker or a queue job, not a web request.

#### Bounding a blocking read

With no `timeout` the socket waits for the next message indefinitely, so `receive()` and `foreach` can hang on a server
that goes quiet. Pass `timeout` (seconds) in the options to give every read a deadline; a read that exceeds it throws
`ElevenLabs\Exceptions\TimeoutException`, and the connection stays usable:

```php
use ElevenLabs\Exceptions\TimeoutException;

$socket = $client->dubbing->live(..., options: ['timeout' => 5.0]);
try {
    while (($message = $socket->receive()) !== null) {
        // Handle each message.
    }
} catch (TimeoutException) {
    // Nothing arrived within 5 seconds.
}
```

## Contributing

While we value open-source contributions to this SDK, this library is generated programmatically.
Additions made directly to this library would have to be moved over to our generation code,
otherwise they would be overwritten upon the next generated release. Feel free to open a PR as
a proof of concept, but know that we will not be able to merge it as-is. We suggest opening
an issue first to discuss with us!

On the other hand, contributions to the README are always very welcome!
