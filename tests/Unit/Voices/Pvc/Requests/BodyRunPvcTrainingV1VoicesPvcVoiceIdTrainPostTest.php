<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Pvc\Requests;

use PHPUnit\Framework\TestCase;

class BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Voices\Pvc\Requests\BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
