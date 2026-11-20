<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\PronunciationDictionaries\Rules\Requests;

use PHPUnit\Framework\TestCase;

class RemovePronunciationDictionaryRulesRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "rule_strings": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\PronunciationDictionaries\Rules\Requests\RemovePronunciationDictionaryRulesRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
