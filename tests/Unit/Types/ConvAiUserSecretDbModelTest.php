<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConvAiUserSecretDbModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "encrypted_value": "test-value",
        "nonce": "test-value",
        "id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConvAiUserSecretDbModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
