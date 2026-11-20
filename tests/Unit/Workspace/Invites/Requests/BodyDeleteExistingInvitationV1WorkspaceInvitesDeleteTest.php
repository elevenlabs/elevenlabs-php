<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Invites\Requests;

use PHPUnit\Framework\TestCase;

class BodyDeleteExistingInvitationV1WorkspaceInvitesDeleteTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Invites\Requests\BodyDeleteExistingInvitationV1WorkspaceInvitesDelete::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
