<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetPronunciationDictionaryMetadataResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "latest_version_id": "test-value",
        "latest_version_rules_num": 1,
        "name": "test-value",
        "permission_on_resource": "admin",
        "created_by": "test-value",
        "creation_time_unix": 1,
        "archived_time_unix": 1,
        "description": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
