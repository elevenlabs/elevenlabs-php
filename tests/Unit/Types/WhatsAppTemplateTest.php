<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "language": "test-value",
        "parameter_format": "POSITIONAL",
        "components": [
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
        ],
        "category": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplate::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
