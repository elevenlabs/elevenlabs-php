<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingSourceMediaInfoTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "filename": "test-value",
        "duration_s": 1,
        "has_video": true,
        "mime_type": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingSourceMediaInfo::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
