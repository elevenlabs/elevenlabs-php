<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplateVersionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "version_id": "test-value",
        "published_at_unix": 1,
        "is_latest": true,
        "inputs": [
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
        ],
        "outputs": [
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
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplateVersion::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
