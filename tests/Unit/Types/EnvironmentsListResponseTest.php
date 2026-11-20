<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EnvironmentsListResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "environments": [
            {
                "name": "test-value",
                "updated_at_unix_secs": 1,
                "created_by_user_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\EnvironmentsListResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
