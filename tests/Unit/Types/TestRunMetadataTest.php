<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestRunMetadataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "workspace_id": "test-value",
        "test_name": "test-value",
        "ran_by_user_email": "test-value",
        "test_type": "llm"
    }
    JSON;

    $instance = \ElevenLabs\Types\TestRunMetadata::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
