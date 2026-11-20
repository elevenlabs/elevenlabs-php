<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\ServiceAccounts\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateServiceAccountV1ServiceAccountsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "default_sharing_groups": [
            {
                "group_id": "test-value",
                "permission_level": "admin"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\ServiceAccounts\Requests\BodyCreateServiceAccountV1ServiceAccountsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
