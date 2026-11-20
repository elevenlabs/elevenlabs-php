<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ForcedAlignmentResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "characters": [
            {
                "text": "test-value",
                "start": 1,
                "end": 1
            }
        ],
        "words": [
            {
                "text": "test-value",
                "start": 1,
                "end": 1,
                "loss": 1
            }
        ],
        "loss": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ForcedAlignmentResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
