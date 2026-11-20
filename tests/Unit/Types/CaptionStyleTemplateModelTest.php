<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CaptionStyleTemplateModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "key": "test-value",
        "label": "test-value",
        "requires_high_fps": true
    }
    JSON;

    $instance = \ElevenLabs\Types\CaptionStyleTemplateModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
