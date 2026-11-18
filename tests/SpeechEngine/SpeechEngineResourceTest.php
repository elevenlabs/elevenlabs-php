<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\SpeechEngine;

use ElevenLabs\SpeechEngine\SpeechEngineResource;
use PHPUnit\Framework\TestCase;

class SpeechEngineResourceTest extends TestCase
{
  private const API_KEY = 'sk_0123456789abcdef0123456789abcdef';
  private const TOKEN = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
    . '.eyJpc3MiOiJodHRwczovL2FwaS5lbGV2ZW5sYWJzLmlvL2NvbnZhaS9zcGVlY2gtZW5naW5lIiwic3ViIjoiY29udmFpX3NwZWVjaF9lbmdpbmVfdXBzdHJlYW0iLCJpYXQiOjEyMzQ1Njc4OTAsImV4cCI6NDEwMjQ0NDgwMH0'
    . '.UObM4hx1W8NvGViU3aqPv1-IEXhmXgWDgoS9RZZWILk';

  public function testVerifyRequestAcceptsValidHeader(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertTrue($resource->verifyRequest([
      'X-ElevenLabs-Speech-Engine-Authorization' => self::TOKEN,
    ]));
  }

  public function testVerifyRequestMatchesHeaderNameCaseInsensitively(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertTrue($resource->verifyRequest([
      'x-elevenlabs-speech-engine-authorization' => self::TOKEN,
    ]));
  }

  public function testVerifyRequestAcceptsListHeaderValue(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertTrue($resource->verifyRequest([
      'X-ElevenLabs-Speech-Engine-Authorization' => [self::TOKEN],
    ]));
  }

  public function testVerifyRequestRejectsMissingHeader(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertFalse($resource->verifyRequest([]));
  }

  public function testVerifyRequestRejectsWithoutApiKey(): void
  {
    $resource = new SpeechEngineResource('seng_123', null);
    $this->assertFalse($resource->verifyRequest([
      'X-ElevenLabs-Speech-Engine-Authorization' => self::TOKEN,
    ]));
  }

  public function testVerifyRequestRejectsBadToken(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertFalse($resource->verifyRequest([
      'X-ElevenLabs-Speech-Engine-Authorization' => 'Bearer not.a.jwt',
    ]));
  }

  public function testExposesEngineId(): void
  {
    $resource = new SpeechEngineResource('seng_123', self::API_KEY);
    $this->assertSame('seng_123', $resource->engineId);
    $this->assertNull($resource->config);
  }
}
