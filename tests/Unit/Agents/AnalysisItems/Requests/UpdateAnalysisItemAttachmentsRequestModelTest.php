<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\AnalysisItems\Requests;

use PHPUnit\Framework\TestCase;

class UpdateAnalysisItemAttachmentsRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "source": "user",
        "attach": [
            {
                "agent_id": "test-value",
                "branch_id": "test-value"
            }
        ],
        "detach": [
            {
                "agent_id": "test-value",
                "branch_id": "test-value"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Agents\AnalysisItems\Requests\UpdateAnalysisItemAttachmentsRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
