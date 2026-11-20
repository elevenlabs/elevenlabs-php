<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UuiTransferConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "data": "test-value",
        "protocol_discriminator": "test-value",
        "protocol_discriminator_mode": "prefix"
    }
    JSON;

    $instance = \ElevenLabs\Types\UuiTransferConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
