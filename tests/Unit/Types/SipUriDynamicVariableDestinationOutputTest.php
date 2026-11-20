<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SipUriDynamicVariableDestinationOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "destination": "test-value",
        "type": "sip_uri_dynamic_variable"
    }
    JSON;

    $instance = \ElevenLabs\Types\SipUriDynamicVariableDestinationOutput::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
