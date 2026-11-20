<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreatifyAuroraRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "webhook": {
            "type": "all"
        },
        "model_id": "creatify-aurora",
        "image": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "audio": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "resolution": "480p",
        "guidance_scale": 0,
        "audio_guidance_scale": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\CreatifyAuroraRequest::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
