<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateCrawlJobResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "type": "discovery",
        "root_folder_id": "test-value",
        "status": "test-value",
        "created_at": 1,
        "folder_path": [
            {
                "id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateCrawlJobResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
