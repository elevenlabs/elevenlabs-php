<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoicemailDetectionToolConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "system_tool_type": "voicemail_detection",
        "voicemail_message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VoicemailDetectionToolConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
