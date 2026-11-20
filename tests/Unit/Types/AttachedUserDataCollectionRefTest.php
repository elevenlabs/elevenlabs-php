<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AttachedUserDataCollectionRefTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "user",
        "analysis_item_id": "test-value",
        "version_id": "test-value",
        "scope": "conversation"
    }
    JSON;

    $instance = \ElevenLabs\Types\AttachedUserDataCollectionRef::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
