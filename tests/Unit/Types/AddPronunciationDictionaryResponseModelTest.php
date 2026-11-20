<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AddPronunciationDictionaryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "created_by": "test-value",
        "creation_time_unix": 1,
        "version_id": "test-value",
        "version_rules_num": 1,
        "description": "test-value",
        "permission_on_resource": "admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\AddPronunciationDictionaryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
