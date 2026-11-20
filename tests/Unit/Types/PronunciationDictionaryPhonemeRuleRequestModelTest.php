<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PronunciationDictionaryPhonemeRuleRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "string_to_replace": "test-value",
        "case_sensitive": true,
        "word_boundaries": true,
        "type": "phoneme",
        "phoneme": "test-value",
        "alphabet": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PronunciationDictionaryPhonemeRuleRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
