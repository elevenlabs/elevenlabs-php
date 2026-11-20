<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ScribeUnacceptedTermsErrorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "message_type": "unaccepted_terms",
        "error": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ScribeUnacceptedTermsError::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
