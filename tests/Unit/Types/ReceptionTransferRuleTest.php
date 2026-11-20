<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionTransferRuleTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "label": "test-value",
        "phone_number": "test-value",
        "condition": "test-value",
        "post_dial_digits": "test-value",
        "id": "test-value",
        "created_at_unix": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionTransferRule::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
