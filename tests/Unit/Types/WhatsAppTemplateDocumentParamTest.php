<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WhatsAppTemplateDocumentParamTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "document",
        "document": {
            "link": "test-value",
            "filename": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WhatsAppTemplateDocumentParam::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
