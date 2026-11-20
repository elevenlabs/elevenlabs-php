<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetSecretDependenciesResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "dependencies": [
            {
                "id": "test-value",
                "name": "test-value",
                "type": "available",
                "created_at_unix_secs": 1,
                "access_level": "admin"
            }
        ],
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetSecretDependenciesResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
