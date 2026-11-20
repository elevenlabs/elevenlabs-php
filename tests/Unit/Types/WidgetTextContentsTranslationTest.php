<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WidgetTextContentsTranslationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": {
            "key": "test-value"
        },
        "text": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\WidgetTextContentsTranslation::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
