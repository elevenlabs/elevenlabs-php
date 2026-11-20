<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Deployments\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateOrUpdateDeploymentsV1ConvaiAgentsAgentIdDeploymentsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "deployment_request": {
            "requests": [
                {
                    "branch_id": "test-value",
                    "deployment_strategy": {
                        "type": "percentage",
                        "traffic_percentage": 0
                    }
                }
            ]
        }
    }
    JSON;

    $instance = \ElevenLabs\Agents\Deployments\Requests\BodyCreateOrUpdateDeploymentsV1ConvaiAgentsAgentIdDeploymentsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
