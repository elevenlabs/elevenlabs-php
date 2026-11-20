<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAgentTopicsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "topics": [
            {
                "topic_id": "test-value",
                "label": "test-value",
                "description": "test-value",
                "conversation_count": 1,
                "parent_topic_id": "test-value",
                "x_2d": 1,
                "y_2d": 1,
                "metrics": {
                    "conversation_count": 1,
                    "sentiment": {
                        "sentiment": {
                            "count": 1,
                            "sum": 1,
                            "min": 1,
                            "max": 1
                        },
                        "frustration": {
                            "count": 1,
                            "sum": 1,
                            "min": 1,
                            "max": 1
                        },
                        "positive_count": 1,
                        "neutral_count": 1,
                        "negative_count": 1
                    },
                    "evaluation_criteria": [
                        {
                            "criteria_id": "test-value",
                            "success_count": 1,
                            "failure_count": 1,
                            "unknown_count": 1
                        }
                    ]
                },
                "success_rate": 1
            }
        ],
        "window_start_unix_secs": 1,
        "window_end_unix_secs": 1,
        "aggregated_run_count": 1,
        "has_more": true,
        "next_cursor": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAgentTopicsResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
