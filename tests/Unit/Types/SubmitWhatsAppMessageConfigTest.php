<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SubmitWhatsAppMessageConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "mode": "message",
        "template": {
            "name": "test-value",
            "language": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\SubmitWhatsAppMessageConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
