<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SipUriDynamicVariableTransferDestinationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "sip_uri_dynamic_variable",
        "sip_uri": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\SipUriDynamicVariableTransferDestination::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
