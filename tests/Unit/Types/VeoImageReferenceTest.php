<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class VeoImageReferenceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "image": {
            "type": "generation",
            "generation_id": "test-value"
        },
        "role": "subject"
    }
    JSON;

    $instance = \ElevenLabs\Types\VeoImageReference::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
