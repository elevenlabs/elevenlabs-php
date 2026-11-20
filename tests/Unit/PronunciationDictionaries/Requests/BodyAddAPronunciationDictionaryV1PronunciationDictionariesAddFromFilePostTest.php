<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\PronunciationDictionaries\Requests;

use PHPUnit\Framework\TestCase;

class BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "description": "test-value",
        "workspace_access": "admin"
    }
    JSON;

    $instance = \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
