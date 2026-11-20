<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Tests\Folders\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateAgentTestFolderV1ConvaiAgentTestingFoldersFolderIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Tests\Folders\Requests\BodyUpdateAgentTestFolderV1ConvaiAgentTestingFoldersFolderIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
