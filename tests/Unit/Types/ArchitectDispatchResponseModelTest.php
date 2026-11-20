<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ArchitectDispatchResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "architect_chat_id": "test-value",
        "user_id": "test-value",
        "dispatched_at_unix_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ArchitectDispatchResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
