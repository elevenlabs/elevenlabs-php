<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VoiceMailDetectionResultSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "voicemail_detection_success",
        "status": "success",
        "voicemail_message": "test-value",
        "reason": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VoiceMailDetectionResultSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
