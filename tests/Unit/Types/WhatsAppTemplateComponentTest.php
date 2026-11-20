<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateComponentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "test-value",
        "format": "test-value",
        "text": "test-value",
        "buttons": [
            {
                "type": "test-value",
                "text": "test-value",
                "url": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateComponent::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
