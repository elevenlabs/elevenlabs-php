<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DtmfInputConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "dtmf_input_timeout": 0.5,
        "hash_terminator": true,
        "redact_input": true
    }
    JSON;

    $instance = \ElevenLabs\Types\DtmfInputConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
