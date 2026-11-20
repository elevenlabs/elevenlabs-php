<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PronunciationDictionaryAliasRuleRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "string_to_replace": "test-value",
        "case_sensitive": true,
        "word_boundaries": true,
        "type": "alias",
        "alias": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\PronunciationDictionaryAliasRuleRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
