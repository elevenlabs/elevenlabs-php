<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DataCollectionPolicyTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "callback_time": "test-value",
        "redirect_phone_number": "test-value",
        "stop": "test-value",
        "mappings": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\DataCollectionPolicy::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
