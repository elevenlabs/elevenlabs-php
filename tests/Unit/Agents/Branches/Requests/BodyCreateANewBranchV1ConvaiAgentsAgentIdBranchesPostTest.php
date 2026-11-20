<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Branches\Requests;

use PHPUnit\Framework\TestCase;

class BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "parent_version_id": "test-value",
        "name": "test-value",
        "description": "test-value",
        "conversation_config": {
            "key": "test-value"
        },
        "platform_settings": {
            "key": "test-value"
        },
        "workflow": {
            "edges": {
                "key": {
                    "source": "test-value",
                    "target": "test-value",
                    "forward_condition": {
                        "label": "test-value",
                        "type": "unconditional"
                    },
                    "backward_condition": {
                        "label": "test-value",
                        "type": "unconditional"
                    },
                    "reroutes": [
                        {
                            "x": 1,
                            "y": 1
                        }
                    ]
                }
            },
            "nodes": {
                "key": {
                    "type": "start",
                    "position": {
                        "x": 1,
                        "y": 1
                    },
                    "edge_order": [
                        "test-value"
                    ]
                }
            },
            "prevent_subagent_loops": true
        },
        "include_draft": true
    }
    JSON;

    $instance = \ElevenLabs\Agents\Branches\Requests\BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
