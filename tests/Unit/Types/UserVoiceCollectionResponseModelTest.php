<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UserVoiceCollectionResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "collection_id": "test-value",
        "title": "test-value",
        "icon": "test-value",
        "permission_on_resource": "admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\UserVoiceCollectionResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
