<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplateRunListResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "runs": [
            {
                "id": "test-value",
                "template_id": "test-value",
                "version_id": "test-value",
                "status": "pending",
                "outputs": {
                    "key": {
                        "id": "test-value",
                        "status": "pending",
                        "failure_reason": "timeout",
                        "error_message": "test-value",
                        "content_url": "test-value",
                        "content_mime_type": "test-value",
                        "type": "image"
                    }
                }
            }
        ],
        "next_cursor": "test-value",
        "has_more": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplateRunListResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
