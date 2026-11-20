<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateStudioProjectV1StudioProjectsProjectIdPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "default_title_voice_id": "test-value",
        "default_paragraph_voice_id": "test-value",
        "title": "test-value",
        "author": "test-value",
        "isbn_number": "test-value",
        "volume_normalization": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Requests\BodyUpdateStudioProjectV1StudioProjectsProjectIdPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
