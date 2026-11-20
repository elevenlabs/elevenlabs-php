<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AgentMetadataDbModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "created_at_unix_secs": 1,
        "updated_at_unix_secs": 1,
        "created_from": "cli",
        "last_updated_from": "cli"
    }
    JSON;

    $instance = \ElevenLabs\Types\AgentMetadataDbModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
