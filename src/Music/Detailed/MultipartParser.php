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
   * The `boundary` parameter of a `Content-Type` header, unquoted, or null.
   */
  public static function boundaryFrom(?string $contentType): ?string
  {
    if ($contentType !== null && preg_match('/boundary=(?:"([^"]+)"|([^;\s]+))/i', $contentType, $match, PREG_UNMATCHED_AS_NULL) === 1) {
      return $match[1] ?? $match[2];
    }
    return null;
  }

  /**
   * @param ?string $boundary The `boundary` parameter of the response's `Content-Type`. Without it the
   *     delimiter is read from the body's first line.
   * @return array{json: array<mixed>, audio: string, filename: string}
   * @throws ElevenlabsException When the body isn't a complete multipart body with a JSON part and an
   *     audio part, including when it ends before the closing `--boundary--` (a truncated response).
   */
  public static function parse(string $body, ?string $boundary = null): array
  {
    if ($boundary !== null && $boundary !== '') {
      $delimiter = '--' . $boundary;
    } else {
      $firstBreak = strpos($body, "\n");
      $delimiter = trim($firstBreak === false ? $body : substr($body, 0, $firstBreak));
      if (!str_starts_with($delimiter, '--') || strlen($delimiter) < 3) {
        throw new ElevenlabsException(message: 'Could not find the multipart boundary in the music response');
      }
    }

    // The first delimiter starts the body or a line: anything before it is a preamble, which is ignored.
    if (str_starts_with($body, $delimiter)) {
      $pos = 0;
    } else {
      $found = strpos($body, "\n" . $delimiter);
      if ($found === false) {
        throw new ElevenlabsException(message: 'Could not find the multipart boundary in the music response');
      }
      $pos = $found + 1;
    }
    // The body uses one line ending throughout; read it from the end of the first delimiter line, past
    // any transport padding (spaces or tabs, which MIME allows after a delimiter).
    $lineEnd = $pos + strlen($delimiter);
    $lineEnd += strspn($body, " \t", $lineEnd);
    $break = substr($body, $lineEnd, 2) === "\r\n" ? "\r\n" : "\n";

    $parts = [];
    while (true) {
      $after = $pos + strlen($delimiter);
      if (substr($body, $after, 2) === '--') {
        break; // Closing delimiter.
      }
      $after += strspn($body, " \t", $after); // Transport padding.
      $start = substr($body, $after, strlen($break)) === $break ? $after + strlen($break) : $after;
      $next = strpos($body, $break . $delimiter, $start);
      if ($next === false) {
        // Every part ends at a delimiter, and the body at `--boundary--`; the API always sends it. A body
        // that stops first was cut off, so its last part (the audio, usually) is incomplete.
        throw new ElevenlabsException(message: 'The music response ended before its closing multipart boundary; it is incomplete');
      }
      $parts[] = self::splitPart(substr($body, $start, $next - $start), $break);
      $pos = $next + strlen($break);
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
    // A part with no headers starts with the blank line that ends them.
    if (str_starts_with($part, $break)) {
      return ['headers' => [], 'body' => substr($part, strlen($break)), 'separated' => true];
    }
    $separator = strpos($part, $break . $break);
    if ($separator === false) {
      return ['headers' => self::headers($part, $break), 'body' => '', 'separated' => false];
    }
    $body = substr($part, $separator + 2 * strlen($break));
    return ['headers' => self::headers(substr($part, 0, $separator), $break), 'body' => $body, 'separated' => true];
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
