<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\PronunciationDictionaries\Requests;

use PHPUnit\Framework\TestCase;

class BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostTest extends
  TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "rules": [
            {
                "string_to_replace": "test-value",
                "case_sensitive": true,
                "word_boundaries": true,
                "type": "alias",
                "alias": "test-value"
            }
        ],
        "name": "test-value",
        "description": "test-value",
        "workspace_access": "admin"
    }
    JSON;

    $instance = \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
