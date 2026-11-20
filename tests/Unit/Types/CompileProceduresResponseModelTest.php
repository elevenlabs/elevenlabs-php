<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CompileProceduresResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\CompileProceduresResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
