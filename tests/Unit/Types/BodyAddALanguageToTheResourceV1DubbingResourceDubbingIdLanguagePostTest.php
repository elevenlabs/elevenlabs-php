<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyAddALanguageToTheResourceV1DubbingResourceDubbingIdLanguagePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyAddALanguageToTheResourceV1DubbingResourceDubbingIdLanguagePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
