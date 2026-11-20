<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAgentTestFolderResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "folder_path": [
            {
                "id": "test-value",
                "name": "test-value"
            }
        ],
        "children_count": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAgentTestFolderResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
