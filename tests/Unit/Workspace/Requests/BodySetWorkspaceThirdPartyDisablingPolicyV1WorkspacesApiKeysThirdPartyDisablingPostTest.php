<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Requests;

use PHPUnit\Framework\TestCase;

class BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPostTest
  extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "third_party_disable_allowed": true
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Requests\BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
