<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\OutboundCampaigns\Attention\Requests;

use PHPUnit\Framework\TestCase;

class AttentionResolutionRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "resolution": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\OutboundCampaigns\Attention\Requests\AttentionResolutionRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
