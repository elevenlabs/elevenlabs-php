<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlayDtmfResultErrorModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "play_dtmf_error",
        "status": "error",
        "error": "test-value",
        "details": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PlayDtmfResultErrorModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
