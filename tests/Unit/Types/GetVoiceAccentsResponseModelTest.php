<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetVoiceAccentsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "accents": [
            {
                "accent": "test-value",
                "language": "test-value",
                "code": "test-value",
                "name": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetVoiceAccentsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
