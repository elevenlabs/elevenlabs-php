<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RagIndexOverviewResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "total_used_bytes": 1,
        "total_max_bytes": 1,
        "models": [
            {
                "model": "e5_mistral_7b_instruct",
                "used_bytes": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\RagIndexOverviewResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
