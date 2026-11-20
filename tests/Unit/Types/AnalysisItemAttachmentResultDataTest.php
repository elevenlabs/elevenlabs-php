<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AnalysisItemAttachmentResultDataTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "branch_id": "test-value",
        "action": "attach",
        "changed": true
    }
    JSON;

    $instance = \ElevenLabs\Types\AnalysisItemAttachmentResultData::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
