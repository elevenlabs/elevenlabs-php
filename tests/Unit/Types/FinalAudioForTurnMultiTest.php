<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FinalAudioForTurnMultiTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_final_audio_for_turn": true,
        "context_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\FinalAudioForTurnMulti::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
