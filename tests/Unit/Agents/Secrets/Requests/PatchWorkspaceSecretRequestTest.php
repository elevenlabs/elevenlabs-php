<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Secrets\Requests;

use PHPUnit\Framework\TestCase;

class PatchWorkspaceSecretRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "update",
        "name": "test-value",
        "value": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Secrets\Requests\PatchWorkspaceSecretRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
