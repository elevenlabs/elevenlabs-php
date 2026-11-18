<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Detailed;

use ElevenLabs\Exceptions\ElevenlabsException;

/**
 * Splits the `multipart/mixed` body of `POST /v1/music/detailed` into its JSON metadata part and
 * its audio part. The generator models this response but doesn't parse it, so the generated
 * `composeDetailed` returns the raw body.
 *
 * Works on bytes throughout, so the audio is returned exactly as sent: the line break before each
 * delimiter and the closing `--boundary--` are stripped, never left on the end of the audio.
 *
 * Hand-written (see `.fernignore`), mirroring `parseMultipart` in the TypeScript SDK.
 *
 * @internal
 */
final class MultipartParser
{
  public const DEFAULT_FILENAME = 'generated_music.mp3';

  /**
   * @return array{json: array<mixed>, audio: string, filename: string}
   * @throws ElevenlabsException When the body isn't a multipart body with a JSON part and an audio part.
   */
  public static function parse(string $body): array
  {
    $firstBreak = strpos($body, "\n");
    $delimiter = trim($firstBreak === false ? $body : substr($body, 0, $firstBreak));
    if (!str_starts_with($delimiter, '--') || strlen($delimiter) < 3) {
      throw new ElevenlabsException(message: 'Could not find the multipart boundary in the music response');
    }
    // The body uses one line ending throughout; read it from the delimiter line.
    $break = ($firstBreak !== false && $firstBreak > 0 && $body[$firstBreak - 1] === "\r") ? "\r\n" : "\n";

    $parts = [];
    $pos = strpos($body, $delimiter);
    while ($pos !== false) {
      $after = $pos + strlen($delimiter);
      if (substr($body, $after, 2) === '--') {
        break; // Closing delimiter.
      }
      $start = substr($body, $after, strlen($break)) === $break ? $after + strlen($break) : $after;
      $next = strpos($body, $break . $delimiter, $start);
      $end = $next === false ? strlen($body) : $next;
      $parts[] = self::splitPart(substr($body, $start, $end - $start), $break);
      $pos = $next === false ? false : $next + strlen($break);
    }

    $json = null;
    $audio = null;
    foreach ($parts as $part) {
      $type = strtolower($part['headers']['content-type'] ?? '');
      $isJson = str_starts_with($type, 'application/json');
      if ($json === null && $isJson) {
        $json = $part;
      } elseif ($audio === null && !$isJson) {
        $audio = $part;
      }
    }

    if ($json === null) {
      throw new ElevenlabsException(message: 'Could not find the JSON part in the music response');
    }
    try {
      $metadata = json_decode(trim($json['body']), true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException $e) {
      throw new ElevenlabsException(message: "Could not parse the JSON part of the music response: {$e->getMessage()}", previous: $e);
    }
    if (!is_array($metadata)) {
      throw new ElevenlabsException(message: 'The JSON part of the music response is not an object');
    }
    if ($audio === null || !$audio['separated']) {
      throw new ElevenlabsException(message: 'Could not find the audio part in the music response');
    }

    return [
      'json' => $metadata,
      'audio' => $audio['body'],
      'filename' => self::filename($audio['headers']['content-disposition'] ?? null),
    ];
  }

  /**
   * @return array{headers: array<string, string>, body: string, separated: bool}
   */
  private static function splitPart(string $part, string $break): array
  {
    // Prepend a line break so a part with no headers (the blank line straight after the delimiter)
    // is found at offset 0 too.
    $withBreak = $break . $part;
    $separator = strpos($withBreak, $break . $break);
    if ($separator === false) {
      return ['headers' => self::headers($part, $break), 'body' => '', 'separated' => false];
    }
    $headerBlock = substr($withBreak, strlen($break), max(0, $separator - strlen($break)));
    $body = substr($withBreak, $separator + 2 * strlen($break));
    return ['headers' => self::headers($headerBlock, $break), 'body' => $body, 'separated' => true];
  }

  /**
   * @return array<string, string>
   */
  private static function headers(string $block, string $break): array
  {
    $headers = [];
    foreach (explode($break, $block) as $line) {
      $colon = strpos($line, ':');
      if ($colon !== false) {
        $headers[strtolower(trim(substr($line, 0, $colon)))] = trim(substr($line, $colon + 1));
      }
    }
    return $headers;
  }

  private static function filename(?string $disposition): string
  {
    if (
      $disposition !== null
      && preg_match('/filename="([^"]+)"|filename=([^;\s]+)/i', $disposition, $match, PREG_UNMATCHED_AS_NULL) === 1
    ) {
      $name = $match[1] ?? $match[2] ?? '';
      if ($name !== '') {
        return $name;
      }
    }
    return self::DEFAULT_FILENAME;
  }
}
