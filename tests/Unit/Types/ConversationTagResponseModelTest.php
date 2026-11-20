<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationTagResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "tag_id": "test-value",
        "workspace_id": "test-value",
        "owner_user_id": "test-value",
        "title": "test-value",
        "description": "test-value",
        "created_at_unix_secs": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationTagResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
