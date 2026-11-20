<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EditedTranscriptResponseTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "kind": "transcript",
        "text": "test-value",
        "edited_text": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\EditedTranscriptResponse::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
