<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReadLegalTermsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "terms": "test-value",
        "start_date": "test-value",
        "end_date": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReadLegalTerms::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
