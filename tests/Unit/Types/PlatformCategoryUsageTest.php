<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class PlatformCategoryUsageTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "credits": 1,
        "price": 1,
        "quantity": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\PlatformCategoryUsage::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
