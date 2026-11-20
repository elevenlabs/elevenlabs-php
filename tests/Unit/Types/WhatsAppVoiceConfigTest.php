<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppVoiceConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mode": "voice",
        "whatsapp_call_permission_request_template_name": "test-value",
        "whatsapp_call_permission_request_template_language_code": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppVoiceConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
