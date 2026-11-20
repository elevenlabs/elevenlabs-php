<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FollowUpRequestCountsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "requested": 1,
        "requested_by_disposition": {
            "key": 1
        },
        "distinct_leads": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\FollowUpRequestCounts::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
