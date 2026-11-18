<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\SpeechEngine;

use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\SpeechEngine\SpeechEngineJwtVerifier;
use PHPUnit\Framework\TestCase;

class SpeechEngineJwtVerifierTest extends TestCase
{
  /**
   * Shared cross-SDK golden vector. `exp` is far in the future so the token
   * stays valid forever; every ElevenLabs SDK must accept this exact (apiKey,
   * token) pair. Generated with secret = sha256(apiKey), HS256.
   */
  private const API_KEY = 'sk_0123456789abcdef0123456789abcdef';
  private const TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
    . '.eyJpc3MiOiJodHRwczovL2FwaS5lbGV2ZW5sYWJzLmlvL2NvbnZhaS9zcGVlY2gtZW5naW5lIiwic3ViIjoiY29udmFpX3NwZWVjaF9lbmdpbmVfdXBzdHJlYW0iLCJpYXQiOjEyMzQ1Njc4OTAsImV4cCI6NDEwMjQ0NDgwMH0'
    . '.UObM4hx1W8NvGViU3aqPv1-IEXhmXgWDgoS9RZZWILk';

  public function testGoldenVectorVerifiesAndDecodes(): void
  {
    $claims = SpeechEngineJwtVerifier::verify(self::TOKEN, self::API_KEY);

    $this->assertSame('https://api.elevenlabs.io/convai/speech-engine', $claims['iss']);
    $this->assertSame('convai_speech_engine_upstream', $claims['sub']);
    $this->assertSame(4102444800, $claims['exp']);
  }

  public function testBearerPrefixIsAccepted(): void
  {
    $claims = SpeechEngineJwtVerifier::verify('Bearer ' . self::TOKEN, self::API_KEY);
    $this->assertSame('convai_speech_engine_upstream', $claims['sub']);
  }

  public function testResidencyKeyNormalizesToBaseKey(): void
  {
    // A residency key must verify the same token: the suffix is stripped before hashing.
    $claims = SpeechEngineJwtVerifier::verify(self::TOKEN, self::API_KEY . '_residency_in');
    $this->assertSame('convai_speech_engine_upstream', $claims['sub']);
  }

  public function testWrongApiKeyIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('signature mismatch');
    SpeechEngineJwtVerifier::verify(self::TOKEN, 'sk_wrongwrongwrongwrongwrongwrongwrong');
  }

  public function testTamperedPayloadIsRejected(): void
  {
    [$h, , $s] = explode('.', self::TOKEN);
    // Swap in a payload with a different subject but keep the original signature.
    $forged = rtrim(strtr(base64_encode('{"iss":"https://api.elevenlabs.io/convai/speech-engine","sub":"evil","iat":1234567890,"exp":4102444800}'), '+/', '-_'), '=');
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('signature mismatch');
    SpeechEngineJwtVerifier::verify("{$h}.{$forged}.{$s}", self::API_KEY);
  }

  public function testExpiredTokenIsRejected(): void
  {
    $claims = ['iss' => 'https://api.elevenlabs.io/convai/speech-engine', 'sub' => 'convai_speech_engine_upstream', 'iat' => time() - 3600, 'exp' => time() - 120];
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('expired');
    SpeechEngineJwtVerifier::verify($this->sign($claims), self::API_KEY);
  }

  public function testFutureIssuedAtIsRejected(): void
  {
    $claims = ['iss' => 'https://api.elevenlabs.io/convai/speech-engine', 'sub' => 'convai_speech_engine_upstream', 'iat' => time() + 3600, 'exp' => time() + 7200];
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('iat is in the future');
    SpeechEngineJwtVerifier::verify($this->sign($claims), self::API_KEY);
  }

  public function testWrongIssuerIsRejected(): void
  {
    $claims = ['iss' => 'https://evil.example.com', 'sub' => 'convai_speech_engine_upstream', 'iat' => 1234567890, 'exp' => 4102444800];
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('unexpected issuer');
    SpeechEngineJwtVerifier::verify($this->sign($claims), self::API_KEY);
  }

  public function testMalformedTokenIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('expected 3 parts');
    SpeechEngineJwtVerifier::verify('not-a-jwt', self::API_KEY);
  }

  public function testMissingApiKeyIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('No API key configured');
    SpeechEngineJwtVerifier::verify(self::TOKEN, '');
  }

  /**
   * Sign a payload into an HS256 JWT with the test key, mirroring how the API signs.
   *
   * @param array<string, mixed> $claims
   */
  private function sign(array $claims): string
  {
    $b64 = static fn(string $b): string => rtrim(strtr(base64_encode($b), '+/', '-_'), '=');
    $h = $b64((string) json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $p = $b64((string) json_encode($claims));
    $secret = hash('sha256', self::API_KEY, true);
    $sig = $b64(hash_hmac('sha256', "{$h}.{$p}", $secret, true));
    return "{$h}.{$p}.{$sig}";
  }
}
