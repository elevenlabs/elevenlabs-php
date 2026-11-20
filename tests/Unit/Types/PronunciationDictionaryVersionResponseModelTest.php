<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PronunciationDictionaryVersionResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "version_id": "test-value",
        "version_rules_num": 1,
        "pronunciation_dictionary_id": "test-value",
        "dictionary_name": "test-value",
        "version_name": "test-value",
        "permission_on_resource": "admin",
        "created_by": "test-value",
        "creation_time_unix": 1,
        "archived_time_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\PronunciationDictionaryVersionResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
