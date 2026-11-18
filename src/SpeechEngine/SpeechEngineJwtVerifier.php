<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechEngine;

use ElevenLabs\Exceptions\ElevenlabsApiException;

/**
 * Verifies the JWT that the ElevenLabs Speech Engine API presents when it opens
 * an inbound WebSocket connection to a developer-owned Speech Engine server.
 *
 * The token arrives in the `X-ElevenLabs-Speech-Engine-Authorization` header and
 * is an HS256 JWT whose HMAC secret is the SHA-256 hash of the account's API key.
 * Data-residency keys (`..._residency_<region>`) are signed with the base key, so
 * the suffix is stripped before hashing.
 *
 * This is a hand-written helper (listed in `.fernignore`): the generator has no
 * concept of the Speech Engine upstream handshake. It mirrors `verifySpeechEngineJwt`
 * in the TypeScript and Python SDKs so every SDK accepts the same tokens.
 */
final class SpeechEngineJwtVerifier
{
  private const ISSUER = 'https://api.elevenlabs.io/convai/speech-engine';
  private const SUBJECT = 'convai_speech_engine_upstream';

  /** Clock skew, in seconds, allowed on the `exp` and `iat` claims. */
  private const LEEWAY_SECONDS = 60;

  /**
   * Verify an inbound Speech Engine connection token and return its decoded
   * claims.
   *
   * @param string $token The `X-ElevenLabs-Speech-Engine-Authorization` header
   *                      value, with or without a `Bearer ` prefix.
   * @param string $apiKey The account API key the engine was created with.
   *
   * @return array<string, mixed> The decoded JWT payload (claims).
   *
   * @throws ElevenlabsApiException If the API key is missing, the token is
   *                               malformed, the signature does not match, or a
   *                               claim (issuer, subject, exp, iat) is invalid.
   */
  public static function verify(string $token, string $apiKey): array
  {
    if ($apiKey === '') {
      throw new ElevenlabsApiException('No API key configured for Speech Engine verification', 400, null);
    }

    $token = trim($token);
    if (stripos($token, 'bearer ') === 0) {
      $token = trim(substr($token, 7));
    }

    $parts = explode('.', $token);
    if (count($parts) !== 3) {
      throw new ElevenlabsApiException('Invalid JWT: expected 3 parts', 400, null);
    }
    [$headerB64, $payloadB64, $signatureB64] = $parts;

    $payloadJson = self::base64UrlDecode($payloadB64);
    if ($payloadJson === false) {
      throw new ElevenlabsApiException('Invalid JWT: failed to decode payload', 400, null);
    }
    try {
      /** @var array<string, mixed> $payload */
      $payload = json_decode($payloadJson, true, 512, JSON_THROW_ON_ERROR);
    } catch (\JsonException) {
      throw new ElevenlabsApiException('Invalid JWT: failed to decode payload', 400, null);
    }
    if (!is_array($payload)) {
      throw new ElevenlabsApiException('Invalid JWT: payload is not an object', 400, null);
    }

    // HMAC secret is the SHA-256 of the residency-suffix-stripped API key.
    $secret = hash('sha256', self::normalizeApiKeyForSigning($apiKey), true);
    $expected = hash_hmac('sha256', "{$headerB64}.{$payloadB64}", $secret, true);
    $actual = self::base64UrlDecode($signatureB64);
    if ($actual === false || !hash_equals($expected, $actual)) {
      throw new ElevenlabsApiException(
        'Invalid JWT: signature mismatch — make sure the API key used by your Speech Engine '
          . 'server matches the one used to create the engine.',
        400,
        null
      );
    }

    if (($payload['iss'] ?? null) !== self::ISSUER) {
      throw new ElevenlabsApiException('Invalid JWT: unexpected issuer', 400, null);
    }
    if (($payload['sub'] ?? null) !== self::SUBJECT) {
      throw new ElevenlabsApiException('Invalid JWT: unexpected subject', 400, null);
    }

    $now = time();
    $exp = $payload['exp'] ?? null;
    $iat = $payload['iat'] ?? null;
    if (!is_int($exp)) {
      throw new ElevenlabsApiException('Invalid JWT: missing exp claim', 400, null);
    }
    if (!is_int($iat)) {
      throw new ElevenlabsApiException('Invalid JWT: missing iat claim', 400, null);
    }
    if ($exp + self::LEEWAY_SECONDS < $now) {
      throw new ElevenlabsApiException('Invalid JWT: token has expired', 400, null);
    }
    if ($iat - self::LEEWAY_SECONDS > $now) {
      throw new ElevenlabsApiException('Invalid JWT: iat is in the future', 400, null);
    }

    return $payload;
  }

  private static function normalizeApiKeyForSigning(string $apiKey): string
  {
    return preg_replace('/_residency_[a-z0-9]+$/', '', trim($apiKey)) ?? trim($apiKey);
  }

  /**
   * Decode a base64url string (RFC 7515), tolerating missing padding.
   *
   * @return string|false The decoded bytes, or false if the input is not valid base64url.
   */
  private static function base64UrlDecode(string $input): string|false
  {
    $padded = strtr($input, '-_', '+/');
    $remainder = strlen($padded) % 4;
    if ($remainder !== 0) {
      $padded .= str_repeat('=', 4 - $remainder);
    }
    return base64_decode($padded, true);
  }
}
