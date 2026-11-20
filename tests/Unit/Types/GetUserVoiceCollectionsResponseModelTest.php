<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetUserVoiceCollectionsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "collections": [
            {
                "collection_id": "test-value",
                "title": "test-value",
                "icon": "test-value",
                "permission_on_resource": "admin"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetUserVoiceCollectionsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
