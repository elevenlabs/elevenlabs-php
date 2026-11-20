<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AudioNativeEditContentResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "project_id": "test-value",
        "converting": true,
        "publishing": true,
        "html_snippet": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AudioNativeEditContentResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
