<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Chapters\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateChapterV1StudioProjectsProjectIdChaptersPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "from_url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Chapters\Requests\BodyCreateChapterV1StudioProjectsProjectIdChaptersPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
