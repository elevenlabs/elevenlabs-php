<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TranslateQueueOverflowErrorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "queue_overflow",
        "error": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\TranslateQueueOverflowError::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
