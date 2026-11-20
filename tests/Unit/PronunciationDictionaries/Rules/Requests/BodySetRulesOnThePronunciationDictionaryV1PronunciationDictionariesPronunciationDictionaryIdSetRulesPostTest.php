<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\PronunciationDictionaries\Rules\Requests;

use PHPUnit\Framework\TestCase;

class BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPostTest
  extends TestCase
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
        ]
    }
    JSON;

    $instance = \ElevenLabs\PronunciationDictionaries\Rules\Requests\BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
