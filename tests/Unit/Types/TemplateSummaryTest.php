<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplateSummaryTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "description": "test-value",
        "versions": [
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
        ],
        "has_more_versions": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplateSummary::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
