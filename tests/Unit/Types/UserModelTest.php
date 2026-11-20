<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "uid": "test-value",
        "type_id": 0,
        "type": "test-value",
        "email_addr": "test-value",
        "full_name": "test-value",
        "domain": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\UserModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
