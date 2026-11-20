<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplateAudioOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "status": "pending",
        "failure_reason": "timeout",
        "error_message": "test-value",
        "content_url": "test-value",
        "content_mime_type": "test-value",
        "type": "audio"
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplateAudioOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
