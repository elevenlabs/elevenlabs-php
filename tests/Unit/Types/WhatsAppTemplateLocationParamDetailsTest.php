<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateLocationParamDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "latitude": "test-value",
        "longitude": "test-value",
        "name": "test-value",
        "address": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateLocationParamDetails::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
