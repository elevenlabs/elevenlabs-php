<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AttachedSystemDataCollectionRefTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "system",
        "analysis_item_id": "__system_data_collection_topic",
        "scope": "conversation"
    }
    JSON;

    $instance = \ElevenLabs\Types\AttachedSystemDataCollectionRef::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
