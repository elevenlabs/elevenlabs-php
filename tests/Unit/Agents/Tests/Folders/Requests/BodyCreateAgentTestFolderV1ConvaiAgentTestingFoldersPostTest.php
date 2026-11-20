<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Tests\Folders\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateAgentTestFolderV1ConvaiAgentTestingFoldersPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "parent_folder_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Tests\Folders\Requests\BodyCreateAgentTestFolderV1ConvaiAgentTestingFoldersPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
