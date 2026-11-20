<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SingleTestRunRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "test_id": "test-value",
        "workflow_node_id": "test-value",
        "root_folder_id": "test-value",
        "root_folder_name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SingleTestRunRequestModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
