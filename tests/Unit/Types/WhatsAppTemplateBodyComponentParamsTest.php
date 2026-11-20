<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateBodyComponentParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "body",
        "parameters": [
            {
                "parameter_name": "test-value",
                "type": "text",
                "text": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateBodyComponentParams::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
