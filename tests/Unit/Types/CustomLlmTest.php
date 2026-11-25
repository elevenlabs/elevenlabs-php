<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CustomLlmTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "url": "test-value",
        "model_id": "test-value",
        "api_key": {
            "secret_id": "test-value"
        },
        "auth_connection": {
            "auth_connection_id": "test-value"
        },
        "mtls_auth_connection": {
            "auth_connection_id": "test-value"
        },
        "request_headers": {
            "key": "test-value"
        },
        "api_version": "test-value",
        "api_type": "chat_completions"
    }
    JSON;

    $instance = \ElevenLabs\Types\CustomLlm::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
