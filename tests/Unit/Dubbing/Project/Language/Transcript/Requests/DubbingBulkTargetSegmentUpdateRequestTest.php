<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Dubbing\Project\Language\Transcript\Requests;

use PHPUnit\Framework\TestCase;

class DubbingBulkTargetSegmentUpdateRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "segments": {
            "key": {
                "translation": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Dubbing\Project\Language\Transcript\Requests\DubbingBulkTargetSegmentUpdateRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
