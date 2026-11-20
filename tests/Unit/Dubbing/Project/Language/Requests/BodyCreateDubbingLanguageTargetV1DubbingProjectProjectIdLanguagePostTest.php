<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Dubbing\Project\Language\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateDubbingLanguageTargetV1DubbingProjectProjectIdLanguagePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "target_language": "test-value",
        "voice_settings": {
            "cloning_strength": 0
        },
        "translations": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Dubbing\Project\Language\Requests\BodyCreateDubbingLanguageTargetV1DubbingProjectProjectIdLanguagePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
