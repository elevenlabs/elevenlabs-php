<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlayDtmfResultSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "play_dtmf_success",
        "status": "success",
        "dtmf_tones": "test-value",
        "reason": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PlayDtmfResultSuccessModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
