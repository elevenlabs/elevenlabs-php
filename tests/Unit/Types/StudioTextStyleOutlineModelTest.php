<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StudioTextStyleOutlineModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "color": "test-value",
        "opacity": 1,
        "width": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\StudioTextStyleOutlineModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
