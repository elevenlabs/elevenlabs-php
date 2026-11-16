<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Webhooks;

use ElevenLabs\Exceptions\ElevenlabsApiException;
use ElevenLabs\Webhooks\WebhookVerifier;
use PHPUnit\Framework\TestCase;

class WebhookVerifierTest extends TestCase
{
  /**
   * Shared cross-SDK golden vector. The timestamp is far in the future so it
   * stays inside the (past-only) tolerance window forever; every ElevenLabs SDK
   * must accept this exact (secret, header, body) triple.
   */
  private const SECRET = 'wsec_0123456789abcdef0123456789abcdef';
  private const TIMESTAMP = '4102444800';
  private const BODY = '{"type":"post_call_transcription","event_timestamp":1234567890,"data":{"agent_id":"abc123"}}';
  private const HEADER = 't=4102444800,v0=01fc9faf23a5c155fbab279c4e0acb2ae059a567b14c10a19bd9f99c88315e99';

  public function testGoldenVectorVerifiesAndDecodes(): void
  {
    $event = WebhookVerifier::constructEvent(self::BODY, self::HEADER, self::SECRET);

    $this->assertSame('post_call_transcription', $event['type']);
    $this->assertSame(1234567890, $event['event_timestamp']);
    $this->assertSame('abc123', $event['data']['agent_id']);
  }

  public function testCurrentTimestampVerifies(): void
  {
    $timestamp = (string) time();
    $body = '{"type":"ping"}';
    $header = 't=' . $timestamp . ',v0=' . hash_hmac('sha256', "{$timestamp}.{$body}", self::SECRET);

    $event = WebhookVerifier::constructEvent($body, $header, self::SECRET);
    $this->assertSame('ping', $event['type']);
  }

  public function testTamperedSignatureIsRejected(): void
  {
    $header = 't=4102444800,v0=' . str_repeat('0', 64);

    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('Signature hash does not match');
    WebhookVerifier::constructEvent(self::BODY, $header, self::SECRET);
  }

  public function testTamperedBodyIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    WebhookVerifier::constructEvent(self::BODY . ' ', self::HEADER, self::SECRET);
  }

  public function testOldTimestampIsRejected(): void
  {
    $timestamp = (string) (time() - 31 * 60);
    $body = '{"type":"ping"}';
    $header = 't=' . $timestamp . ',v0=' . hash_hmac('sha256', "{$timestamp}.{$body}", self::SECRET);

    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('Timestamp outside the tolerance zone');
    WebhookVerifier::constructEvent($body, $header, self::SECRET);
  }

  public function testMissingHeaderIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('Missing signature header');
    WebhookVerifier::constructEvent(self::BODY, '', self::SECRET);
  }

  public function testMissingSecretIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('Webhook secret not configured');
    WebhookVerifier::constructEvent(self::BODY, self::HEADER, '');
  }

  public function testHeaderWithoutV0SchemeIsRejected(): void
  {
    $this->expectException(ElevenlabsApiException::class);
    $this->expectExceptionMessage('No signature hash found with expected scheme v0');
    WebhookVerifier::constructEvent(self::BODY, 't=4102444800', self::SECRET);
  }
}
