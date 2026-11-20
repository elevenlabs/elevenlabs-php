<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Studio\Projects\Content\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "from_url": "test-value",
        "from_content_json": "test-value",
        "auto_convert": true
    }
    JSON;

    $instance = \ElevenLabs\Studio\Projects\Content\Requests\BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
