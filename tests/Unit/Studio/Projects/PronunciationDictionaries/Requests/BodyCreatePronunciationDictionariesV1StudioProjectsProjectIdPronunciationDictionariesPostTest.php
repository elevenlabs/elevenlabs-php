<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\PronunciationDictionaries\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "pronunciation_dictionary_locators": [
            {
                "pronunciation_dictionary_id": "test-value",
                "version_id": "test-value"
            }
        ],
        "invalidate_affected_text": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\PronunciationDictionaries\Requests\BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
