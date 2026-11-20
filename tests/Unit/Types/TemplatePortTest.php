<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplatePortTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "content_schema": {
            "title": "test-value",
            "description": "test-value",
            "type": "string",
            "enum": [
                "test-value"
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplatePort::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
