<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Dubbing\Project\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateDubbingProjectV1DubbingProjectPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source_url": "test-value",
        "reference": "test-value",
        "source_language": "test-value",
        "model_id": "dubbing_v1",
        "keyterms": [
            "test-value"
        ],
        "webhook_ids": [
            "test-value"
        ],
        "target_language": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Dubbing\Project\Requests\BodyCreateDubbingProjectV1DubbingProjectPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
