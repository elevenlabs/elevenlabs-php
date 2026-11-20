<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionProductScrapableTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "pricing_mode": "fixed",
        "groups": [
            {
                "label": "test-value",
                "rank": 0
            }
        ],
        "ungrouped_rank": 0,
        "name": "test-value",
        "description": "test-value",
        "price": 0
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionProductScrapable::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
