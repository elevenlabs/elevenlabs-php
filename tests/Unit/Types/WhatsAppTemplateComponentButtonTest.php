<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateComponentButtonTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "test-value",
        "text": "test-value",
        "url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateComponentButton::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
