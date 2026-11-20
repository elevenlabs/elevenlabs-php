<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateDocumentParamDetailsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "link": "test-value",
        "filename": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateDocumentParamDetails::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
