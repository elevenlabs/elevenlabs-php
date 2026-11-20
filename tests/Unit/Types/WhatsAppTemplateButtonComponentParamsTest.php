<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateButtonComponentParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "button",
        "parameters": [
            {
                "parameter_name": "test-value",
                "type": "text",
                "text": "test-value"
            }
        ],
        "index": 1,
        "sub_type": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateButtonComponentParams::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
