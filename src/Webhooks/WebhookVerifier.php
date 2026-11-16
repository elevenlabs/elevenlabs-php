<?php

declare(strict_types=1);

namespace ElevenLabs\Webhooks;

use ElevenLabs\Exceptions\ElevenlabsApiException;

/**
 * Verifies ElevenLabs webhook signatures.
 *
 * ElevenLabs signs each webhook with an HMAC-SHA256 digest, sent in the
 * `ElevenLabs-Signature` header as a compound value of the form
 * `t=<unix_timestamp>,v0=<hex_digest>`. The signed message is the timestamp and
 * the raw request body joined with a period (`<timestamp>.<raw_body>`).
 *
 * This is a hand-written helper rather than generated code: the Fern generator's
 * built-in verifier cannot parse a compound header that carries both the
 * timestamp and the signature. It is listed in `.fernignore` so regeneration
 * leaves it in place.
 */
final class WebhookVerifier
{
  /**
   * How far in the past, in seconds, a webhook timestamp may be before it is
   * rejected as a possible replay.
   */
  private const TOLERANCE_SECONDS = 30 * 60;

  /**
   * Verify a webhook signature and return the decoded event payload.
   *
   * @param string $rawBody The raw request body, exactly as received. Must be the
   *                        unparsed string: re-encoding a decoded body changes the
   *                        bytes and breaks verification.
   * @param string $sigHeader The value of the `ElevenLabs-Signature` header.
   * @param string $secret Your webhook signing secret.
   *
   * @return array<string, mixed> The decoded webhook event.
   *
   * @throws ElevenlabsApiException If the header or secret is missing, the
   *                               timestamp is outside the tolerance window, or
   *                               the signature does not match.
   */
  public static function constructEvent(string $rawBody, string $sigHeader, string $secret): array
  {
    if ($sigHeader === '') {
      throw new ElevenlabsApiException('Missing signature header', 400, null);
    }

    if ($secret === '') {
      throw new ElevenlabsApiException('Webhook secret not configured', 400, null);
    }

    $timestamp = null;
    $signature = null;
    foreach (explode(',', $sigHeader) as $part) {
      if (str_starts_with($part, 't=')) {
        $timestamp = substr($part, 2);
      } elseif (str_starts_with($part, 'v0=')) {
        $signature = $part;
      }
    }

    if ($timestamp === null || $timestamp === '' || $signature === null) {
      throw new ElevenlabsApiException('No signature hash found with expected scheme v0', 400, null);
    }

    $requestTimestampMs = (int) $timestamp * 1000;
    $toleranceMs = (time() - self::TOLERANCE_SECONDS) * 1000;
    if ($requestTimestampMs < $toleranceMs) {
      throw new ElevenlabsApiException('Timestamp outside the tolerance zone', 400, null);
    }

    $digest = 'v0=' . hash_hmac('sha256', "{$timestamp}.{$rawBody}", $secret);
    if (!hash_equals($digest, $signature)) {
      throw new ElevenlabsApiException(
        'Signature hash does not match the expected signature hash for payload',
        400,
        null
      );
    }

    /** @var array<string, mixed> $event */
    $event = json_decode($rawBody, true, 512, JSON_THROW_ON_ERROR);
    return $event;
  }
}
