<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryAnalysisCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "evaluation_criteria_results": {
            "key": {
                "criteria_id": "test-value",
                "result": "success",
                "rationale": "test-value",
                "scoring_mode": "binary",
                "score": 1,
                "max_score": 1
            }
        },
        "data_collection_results": {
            "key": {
                "data_collection_id": "test-value",
                "name": "test-value",
                "value": "test-value",
                "json_schema": {
                    "type": "boolean",
                    "description": "test-value",
                    "enum": [
                        "test-value"
                    ],
                    "is_system_provided": true,
                    "dynamic_variable": "test-value",
                    "allowed_values": {
                        "dynamic_variable": "test-value"
                    },
                    "allowed_values_dynamic_variable": "test-value",
                    "constant_value": "test-value",
                    "is_omitted": true
                },
                "rationale": "test-value"
            }
        },
        "evaluation_criteria_results_list": [
            {
                "criteria_id": "test-value",
                "result": "success",
                "rationale": "test-value",
                "scoring_mode": "binary",
                "score": 1,
                "max_score": 1
            }
        ],
        "data_collection_results_list": [
            {
                "data_collection_id": "test-value",
                "name": "test-value",
                "value": "test-value",
                "json_schema": {
                    "type": "boolean",
                    "description": "test-value",
                    "enum": [
                        "test-value"
                    ],
                    "is_system_provided": true,
                    "dynamic_variable": "test-value",
                    "allowed_values": {
                        "dynamic_variable": "test-value"
                    },
                    "allowed_values_dynamic_variable": "test-value",
                    "constant_value": "test-value",
                    "is_omitted": true
                },
                "rationale": "test-value"
            }
        ],
        "call_successful": "success",
        "call_success_score": 1,
        "transcript_summary": "test-value",
        "call_summary_title": "test-value",
        "scoped": [
            {
                "scope": "conversation",
                "source_agent_id": "test-value",
                "source_branch_id": "test-value",
                "evaluation_criteria_results": {
                    "key": {
                        "criteria_id": "test-value",
                        "result": "success",
                        "rationale": "test-value",
                        "scoring_mode": "binary",
                        "score": 1,
                        "max_score": 1
                    }
                },
                "data_collection_results": {
                    "key": {
                        "data_collection_id": "test-value",
                        "name": "test-value",
                        "value": "test-value",
                        "json_schema": {
                            "type": "boolean",
                            "description": "test-value",
                            "enum": [
                                "test-value"
                            ],
                            "is_system_provided": true,
                            "dynamic_variable": "test-value",
                            "allowed_values": {
                                "dynamic_variable": "test-value"
                            },
                            "allowed_values_dynamic_variable": "test-value",
                            "constant_value": "test-value",
                            "is_omitted": true
                        },
                        "rationale": "test-value"
                    }
                },
                "successful": "success",
                "success_score": 1
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryAnalysisCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
