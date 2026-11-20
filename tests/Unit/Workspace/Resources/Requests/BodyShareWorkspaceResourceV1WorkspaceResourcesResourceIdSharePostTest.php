<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Resources\Requests;

use PHPUnit\Framework\TestCase;

class BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "role": "admin",
        "resource_type": "voice",
        "user_email": "test-value",
        "group_id": "test-value",
        "workspace_api_key_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Resources\Requests\BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
