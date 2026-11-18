<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Detailed;

use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\ElevenLabs;
use ElevenLabs\Music\MusicClient;
use ElevenLabs\Music\Requests\BodyComposeMusicWithADetailedResponseV1MusicDetailedPost;
use Psr\Http\Message\ResponseInterface;

/**
 * Adds a parsed `composeDetailed` to the music client: compose a song and get its metadata and
 * audio file as separate fields.
 *
 * ```php
 * $music = new MusicDetailed($client);
 * $song = $music->composeDetailed(new BodyComposeMusicWithADetailedResponseV1MusicDetailedPost([
 *     'prompt' => 'Epic orchestral music with dramatic strings',
 *     'musicLengthMs' => 60000,
 * ]));
 * echo $song->json['song_metadata']['title'];
 * file_put_contents($song->filename, $song->audio);
 * ```
 *
 * The API answers `POST /v1/music/detailed` with a `multipart/mixed` body (a JSON part, then the
 * audio). The generated `$client->music->composeDetailed()` returns that body unparsed and drops
 * the `song-id` header, so this sends the same request through the generated music client (same
 * base URL, credentials, retries, per-method config and error handling) and parses the result.
 *
 * Hand-written rather than generated (see `.fernignore`). The generated root client is regenerated
 * on every release, so this is a separate entry point rather than a property on it. Mirrors
 * `music.compose_detailed` in the Python SDK.
 */
final class MusicDetailed
{
  private readonly MusicClient $music;

  /**
   * @param ElevenLabs|MusicClient $client The root client, or its `music` client.
   */
  public function __construct(ElevenLabs|MusicClient $client)
  {
    $this->music = $client instanceof ElevenLabs ? $client->music : $client;
  }

  /**
   * Compose a song from a prompt or a composition plan, and return its metadata and audio.
   *
   * @param BodyComposeMusicWithADetailedResponseV1MusicDetailedPost $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @throws \ElevenLabs\Exceptions\ElevenlabsException When the response can't be parsed.
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function composeDetailed(
    BodyComposeMusicWithADetailedResponseV1MusicDetailedPost $request = new BodyComposeMusicWithADetailedResponseV1MusicDetailedPost(),
    ?array $options = null,
  ): ComposeDetailedResponse {
    $response = self::send($this->music, $request, $options);
    $parsed = MultipartParser::parse((string) $response->getBody());
    $songId = $response->getHeaderLine('song-id');

    return new ComposeDetailedResponse(
      json: $parsed['json'],
      audio: $parsed['audio'],
      filename: $parsed['filename'],
      songId: $songId === '' ? null : $songId,
    );
  }

  /**
   * Sends the request exactly as the generated `MusicClient::composeDetailed` does, but returns the
   * whole HTTP response instead of only its body.
   *
   * @param ?array<string, mixed> $options
   */
  private static function send(
    MusicClient $music,
    BodyComposeMusicWithADetailedResponseV1MusicDetailedPost $request,
    ?array $options,
  ): ResponseInterface {
    $send = \Closure::bind(
      function () use ($request, $options): ResponseInterface {
        /** @var MusicClient $this */
        $outputFormat = $request->outputFormat;
        $enableLogging = $request->enableLogging;

        $request->validate();

        $resolvedConfig = $this->getResolvedConfig($this->composeDetailedConfig, $options);
        return $this->sendBinaryStreamJsonRequest(
          new JsonApiRequest(
            baseUrl: $this->getBaseUrl($resolvedConfig),
            path: '/v1/music/detailed',
            method: HttpMethod::POST,
            query: [
              'output_format' => $outputFormat,
              'enable_logging' => $enableLogging,
            ],
            body: $request
          ),
          $resolvedConfig
        );
      },
      $music,
      $music::class
    );
    return $send();
  }
}
