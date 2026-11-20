<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DependentPhoneNumberIdentifierTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "phone_number_id": "test-value",
        "phone_number": "test-value",
        "label": "test-value",
        "provider": "twilio"
    }
    JSON;

    $instance = \ElevenLabs\Types\DependentPhoneNumberIdentifier::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
