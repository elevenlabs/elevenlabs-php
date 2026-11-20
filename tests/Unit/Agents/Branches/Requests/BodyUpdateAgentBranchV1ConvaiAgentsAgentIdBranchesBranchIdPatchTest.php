<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Branches\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "description": "test-value",
        "is_archived": true,
        "protection_status": "writer_perms_required",
        "auto_rebase": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\Branches\Requests\BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
