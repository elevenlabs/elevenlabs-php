<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VerifiedVoiceLanguageResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language": "test-value",
        "model_id": "test-value",
        "accent": "test-value",
        "locale": "test-value",
        "preview_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\VerifiedVoiceLanguageResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
