<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Tests\Requests;

use PHPUnit\Framework\TestCase;

class BodyBulkMoveTestsToFolderV1ConvaiAgentTestingBulkMovePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "entity_ids": [
            "test-value"
        ],
        "move_to": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Tests\Requests\BodyBulkMoveTestsToFolderV1ConvaiAgentTestingBulkMovePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
