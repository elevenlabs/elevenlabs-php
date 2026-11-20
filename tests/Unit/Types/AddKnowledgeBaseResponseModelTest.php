<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AddKnowledgeBaseResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "folder_path": [
            {
                "id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\AddKnowledgeBaseResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
