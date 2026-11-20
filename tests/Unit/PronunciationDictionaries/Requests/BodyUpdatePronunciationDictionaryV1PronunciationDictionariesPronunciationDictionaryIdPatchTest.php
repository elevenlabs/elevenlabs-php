<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\PronunciationDictionaries\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatchTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "archived": true,
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\PronunciationDictionaries\Requests\BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
