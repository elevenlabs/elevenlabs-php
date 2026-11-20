<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DeliverableInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "signed_url": "test-value",
        "content_type": "test-value",
        "name": "test-value",
        "version": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\DeliverableInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
