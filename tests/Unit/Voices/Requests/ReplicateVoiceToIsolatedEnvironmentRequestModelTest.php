<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Requests;

use PHPUnit\Framework\TestCase;

class ReplicateVoiceToIsolatedEnvironmentRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "target_workspace_id": "test-value",
        "preserve_voice_id": true
    }
    JSON;

    $instance = \ElevenLabs\Voices\Requests\ReplicateVoiceToIsolatedEnvironmentRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
