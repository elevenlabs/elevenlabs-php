# ElevenLabs PHP Library

![LOGO](https://github.com/elevenlabs/elevenlabs-python/assets/12028621/21267d89-5e82-4e7e-9c81-caf30b237683)

[![fern shield](https://img.shields.io/badge/%F0%9F%8C%BF-SDK%20generated%20by%20Fern-brightgreen)](https://buildwithfern.com/?utm_source=fern-elevenlabs/elevenlabs-php/readme)
[![Discord](https://badgen.net/badge/black/ElevenLabs/icon?icon=discord&label)](https://discord.gg/elevenlabs)
[![Twitter](https://badgen.net/badge/black/elevenlabsio/icon?icon=twitter&label)](https://twitter.com/elevenlabsio)
[![packagist shield](https://img.shields.io/packagist/v/elevenlabs/elevenlabs-php)](https://packagist.org/packages/elevenlabs/elevenlabs-php)

The official PHP SDK for [ElevenLabs](https://elevenlabs.io/). ElevenLabs brings the most compelling, rich and lifelike voices to creators and developers in just a few lines of code.

## 📖 API & Docs

Check out the [HTTP API documentation](https://elevenlabs.io/docs/api-reference).

## Requirements

This SDK requires PHP ^8.1.

## Install

```sh
composer require elevenlabs/elevenlabs-php
```

The SDK sends its requests through a [PSR-18](https://www.php-fig.org/psr/psr-18/) HTTP client, which Composer installs for you only if your project allows the `php-http/discovery` plugin — add `"allow-plugins": {"php-http/discovery": true}` under `config` in your `composer.json`, or require a client yourself with `composer require guzzlehttp/guzzle` (or `composer require symfony/http-client nyholm/psr7`). Without either, the install succeeds with no HTTP client and the first API call fails at runtime.

## Usage

### Main Models

1. **Eleven v4** (`eleven_v4`)
    - Highest quality and most expressive speech, with reliable voice cloning across long generations
    - 90+ languages with consistent voice quality across language switches
    - Up to 10,000 characters (~10 minutes of audio) per request
    - Used via the [Text to Dialogue API](https://elevenlabs.io/docs/api-reference/text-to-dialogue/convert)

2. **Eleven v4 Turbo** (`eleven_v4_turbo`)
    - State-of-the-art real-time speech, with a median latency of ~100ms
    - 90+ languages
    - Ideal for voice agents and other latency-sensitive use cases

3. **Eleven Multilingual v2** (`eleven_multilingual_v2`)
    - Excels in stability, language diversity, and accent accuracy
    - The most stable choice for long-form Text to Speech
    - Supports 29 languages

4. **Eleven Flash v2.5** (`eleven_flash_v2_5`)
    - Ultra-low latency and lowest cost
    - Supports 32 languages

For more detailed information about these models and others, visit the [ElevenLabs Models documentation](https://elevenlabs.io/docs/models).

Instantiate and use the client with the following:

```php
<?php

use ElevenLabs\ElevenLabs;
use ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFull;

// Reads the API key from the ELEVENLABS_API_KEY environment variable.
// Pass it explicitly with new ElevenLabs('YOUR_API_KEY') if you prefer.
$client = new ElevenLabs();

$audio = $client->textToSpeech->convert(
    'JBFqnCBsd6RMkjVDRZzb',
    new BodyTextToSpeechFull([
        'text' => 'The first move is what sets everything in motion.',
        'modelId' => 'eleven_multilingual_v2',
        'outputFormat' => 'mp3_44100_128',
    ]),
);

// The response is a stream; write it out in chunks.
$out = fopen('output.mp3', 'wb');
while (!$audio->eof()) {
    fwrite($out, $audio->read(8192));
}
fclose($out);
// $audio->getContents() returns the whole body in one call instead.
```

### Text to Dialogue (Eleven v4)

Eleven v4 and Eleven v4 Turbo are served through the Text to Dialogue API, which turns a list of speaker turns into a single expressive audio stream.

```php
use ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueMultiVoiceV1TextToDialoguePost;
use ElevenLabs\Types\DialogueInput;

$audio = $client->textToDialogue->convert(
    new BodyTextToDialogueMultiVoiceV1TextToDialoguePost([
        'modelId' => 'eleven_v4',
        'outputFormat' => 'mp3_44100_128',
        'inputs' => [
            new DialogueInput([
                'text' => '[giggling] Knock knock',
                'voiceId' => 'JBFqnCBsd6RMkjVDRZzb',
            ]),
            new DialogueInput([
                'text' => '[curious] Who is there?',
                'voiceId' => 'Aw4FAjKCGjjNkVhN1Xmq',
            ]),
        ],
    ]),
);

while (!$audio->eof()) {
    echo $audio->read(8192);
}
```

## Voices

List all your available voices with `search()`.

```php
use ElevenLabs\Voices\Requests\SearchVoicesRequest;

$response = $client->voices->search(new SearchVoicesRequest());
foreach ($response->voices as $voice) {
    echo $voice->name . "\n";
}
```

For information about the structure of the voices output, please refer to the [official ElevenLabs API documentation for Get Voices](https://elevenlabs.io/docs/api-reference/get-voices).

## Streaming

Stream audio in real-time, as it's being generated.

```php
use ElevenLabs\TextToSpeech\Requests\StreamTextToSpeechRequest;

$audio = $client->textToSpeech->stream(
    'JBFqnCBsd6RMkjVDRZzb',
    new StreamTextToSpeechRequest([
        'text' => 'This is a... streaming voice.',
        'modelId' => 'eleven_multilingual_v2',
        'outputFormat' => 'mp3_44100_128',
    ]),
);

while (!$audio->eof()) {
    // Process each chunk as it arrives.
    echo $audio->read(8192);
}
```

## Waiting for Flows generations

Image, video and text-to-speech generations and template runs under `$client->flows` run
asynchronously: `create` returns an ID and `get` reports the status. `createAndWait` does both,
polling until the generation is `completed` or `failed`.

```php
use ElevenLabs\Flows\Wait\FlowsWaiter;
use ElevenLabs\Flows\Wait\FlowsWaitTimeoutError;
use ElevenLabs\Types\GptImage1Request;
use ElevenLabs\Types\ImageGenerationRequest;

$flows = new FlowsWaiter($client);

try {
    $generation = $flows->image->createAndWait(
        ImageGenerationRequest::gptImage1(new GptImage1Request([
            'modelId' => 'gpt-image-1',
            'prompt' => 'A lighthouse at dusk',
        ])),
        waitTimeoutInSeconds: 600,
    );
} catch (FlowsWaitTimeoutError $e) {
    // Still running on the server: resume with $client->flows->image->get($e->id).
    exit(1);
}

if ($generation->isCompleted()) {
    echo $generation->asCompleted()->contentUrl . "\n";
} else {
    echo $generation->asFailed()->errorMessage . "\n";
}
```

`$flows->video` and `$flows->textToSpeech` work the same way, and
`$flows->templates->runs->createAndWait($templateId, $request)` waits for a template run.

- Between status checks it waits for the server's `Retry-After` header, never less than
  `minPollIntervalInSeconds` (default 3, minimum 0.5), plus up to 20% jitter.
- `waitTimeoutInSeconds` bounds the whole wait. It defaults to `null`, which waits indefinitely.
  When it runs out, `FlowsWaitTimeoutError` carries the `id` (and `templateId` for a run) and the
  last status.
- A `failed` generation or run is returned, not thrown.
- `options` apply to every request, except `bodyProperties`, which only the create call gets.

This is meant for scripts and quickstarts. In production, set a `webhook` on the request and
handle the webhook event instead of holding a process open.

## Composing music with metadata

`POST /v1/music/detailed` returns the song's metadata and its audio file in one `multipart/mixed`
response. `MusicDetailed::composeDetailed` sends that request and splits the response for you
(`$client->music->composeDetailed()` returns the raw multipart body).

```php
use ElevenLabs\Music\Detailed\MusicDetailed;
use ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost;

$music = new MusicDetailed($client);

$song = $music->composeDetailed(new BodyComposeMusicWithADetailedResponseV1MusicDetailedPost([
    'prompt' => 'Epic orchestral music with dramatic strings and powerful brass',
    'musicLengthMs' => 60000,
]));

echo $song->json['song_metadata']['title'] . "\n";
file_put_contents($song->filename, $song->audio);
```

- `json` is the metadata part as the API sends it: `composition_plan`, `song_metadata` and
  `words_timestamps`.
- `audio` is the audio file's bytes and `filename` the name the API suggests for it.
- `songId` is set when the request has `storeForInpainting` enabled.

## Agent tools as code

`ElevenLabs\AgentTools` defines agent tools in code: webhook tools the server calls, client tools
that send an event to the user's client, and system tools such as ending or transferring the call.
`build()` validates the tool and returns the `ToolRequestModel` that `$client->agents->tools->create()`
and `update()` accept. `toJsonString()` writes the same tool in the format the ElevenLabs CLI keeps
in `tool_configs/*.json`.

```php
use ElevenLabs\AgentTools\Header;
use ElevenLabs\AgentTools\Schema;
use ElevenLabs\AgentTools\SystemTool;
use ElevenLabs\AgentTools\Tool;
use ElevenLabs\AgentWorkflows\Destination;

$getOrder = Tool::webhook('get_order', 'Look up an order by the number the caller gives')
    ->get('https://api.example.com/orders/{order_id}')
    ->pathParam('order_id', Schema::string()->describe('The order number, e.g. A-1042'))
    ->queryParam('include', Schema::string()->constant('items'))
    ->header('Authorization', Header::secret('sec_orders_api'))
    ->assign('order_status', 'order.status')
    ->options(responseTimeoutSecs: 10, preToolSpeech: 'force');

$refund = Tool::webhook('issue_refund', 'Refund an order the caller asked to return')
    ->post('https://api.example.com/refunds')
    ->body(Schema::object()
        ->property('order_id', Schema::string()->fromVariable('order_id'))
        ->property('reason', Schema::string()->describe('Why the caller wants a refund')->choices(['damaged', 'late', 'other']))
        ->property('note', Schema::string()->describe('Anything else the caller said')->optional()));

$transfer = SystemTool::transferToNumber()
    ->transfer('Caller asks for billing', Destination::phone('+15551234567'))
    ->transfer('Caller asks for a manager', Destination::sipVariable('manager_sip'), transferType: 'sip_refer');

$created = $client->agents->tools->create($getOrder->build());
file_put_contents('tool_configs/issue_refund.json', $refund->toJsonString());
```

- Every literal param needs one value source: `describe()` (the LLM provides it), `fromVariable()`,
  `constant()`, `systemProvided()` or `omit()`. Properties are required unless marked `optional()`.
- `Schema` values are immutable, so one schema can be reused across tools and properties.
- `build()`, `buildConfig()` and `toJson()` throw `ToolValidationError` listing every problem; each
  `ToolIssue` has a `code` such as `missing_path_param`. Warnings go to `build($onWarning)`.
- `Tool::fromJson()` loads a CLI file or JSON string, and `Tool::fromResponse()` the result of
  `tools->get()`, for editing. Fields the builder doesn't model are written back unchanged, and a tool
  of a type it can't edit (such as `mcp`) loads with `kind()` `"other"` and round-trips.
- A system tool goes in the agent's `prompt.builtInTools` rather than `tools->create()`:
  `new BuiltInToolsInput(['endCall' => SystemTool::endCall()->buildConfig()])`.

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
    $response = $client->textToSpeech->convert(...);
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
$response = $client->textToSpeech->convert(
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
$response = $client->textToSpeech->convert(
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

## Languages Supported

Explore [all models & languages](https://elevenlabs.io/docs/models).

## Contributing

While we value open-source contributions to this SDK, this library is generated programmatically.
Additions made directly to this library would have to be moved over to our generation code,
otherwise they would be overwritten upon the next generated release. Feel free to open a PR as
a proof of concept, but know that we will not be able to merge it as-is. We suggest opening
an issue first to discuss with us!

On the other hand, contributions to the README are always very welcome!
