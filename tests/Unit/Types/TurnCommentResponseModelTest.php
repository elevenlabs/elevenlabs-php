<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TurnCommentResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "turn_index": 1,
        "comment": "test-value",
        "created_at_unix_secs": 1,
        "owner_user_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TurnCommentResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
