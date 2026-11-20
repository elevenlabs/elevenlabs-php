<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AttachedUserEvaluationRefTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "user",
        "analysis_item_id": "test-value",
        "version_id": "test-value",
        "additional_version_ids": [
            "test-value"
        ],
        "scope": "conversation",
        "weight": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AttachedUserEvaluationRef::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
