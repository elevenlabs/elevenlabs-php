<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentKnowledgeBaseRagListingResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "entries": [
            {
                "id": "test-value",
                "name": "test-value",
                "is_folder": true
            }
        ],
        "total_count": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentKnowledgeBaseRagListingResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
