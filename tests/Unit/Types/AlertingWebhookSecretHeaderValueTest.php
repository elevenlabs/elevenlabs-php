<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AlertingWebhookSecretHeaderValueTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "encrypted_value": "test-value",
        "nonce": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AlertingWebhookSecretHeaderValue::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
