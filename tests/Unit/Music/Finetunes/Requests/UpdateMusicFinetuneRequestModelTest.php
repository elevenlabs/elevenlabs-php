<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Music\Finetunes\Requests;

use PHPUnit\Framework\TestCase;

class UpdateMusicFinetuneRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "tags": [
            "test-value"
        ],
        "primary_genre": "test-value",
        "visibility": "private"
    }
    JSON;

    $instance = \ElevenLabs\Music\Finetunes\Requests\UpdateMusicFinetuneRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
