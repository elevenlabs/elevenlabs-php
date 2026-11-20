<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SampleConfigDbModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_sample": true,
        "parent_id": "test-value",
        "parent_type": "read",
        "chapter_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\SampleConfigDbModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
