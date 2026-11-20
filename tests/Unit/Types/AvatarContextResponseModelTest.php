<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AvatarContextResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "avatar_id": "test-value",
        "avatar_style_id": "test-value",
        "avatar_name": "test-value",
        "avatar_style_name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AvatarContextResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
