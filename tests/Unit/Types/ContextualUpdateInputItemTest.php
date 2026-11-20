<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ContextualUpdateInputItemTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "contextual_update",
        "text": "test-value",
        "context_id": "test-value",
        "placement": "in_place"
    }
    JSON;

    $instance = \ElevenLabs\Types\ContextualUpdateInputItem::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
