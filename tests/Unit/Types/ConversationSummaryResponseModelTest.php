<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationSummaryResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "branch_id": "test-value",
        "version_id": "test-value",
        "agent_name": "test-value",
        "conversation_id": "test-value",
        "start_time_unix_secs": 1,
        "call_duration_secs": 1,
        "cost": 1,
        "cost_fiat": 1,
        "message_count": 1,
        "user_message_count": 1,
        "agent_message_count": 1,
        "status": "initiated",
        "termination_reason": "test-value",
        "call_successful": "success",
        "call_success_score": 1,
        "transcript_summary": "test-value",
        "call_summary_title": "test-value",
        "main_language": "test-value",
        "conversation_initiation_source": "unknown",
        "tool_names": [
            "test-value"
        ],
        "direction": "inbound",
        "rating": 1,
        "sentiment_analysis": {
            "overall_label": "positive",
            "overall_sentiment_score": -1,
            "overall_frustration_score": 0,
            "min_user_sentiment_score": -1,
            "max_user_frustration_score": 0,
            "num_scored_user_turns": 0
        },
        "data_collection_results": {
            "key": "test-value"
        },
        "evaluation_criteria_results": {
            "key": {
                "result": "success",
                "score": 1,
                "max_score": 1
            }
        },
        "tag_ids": [
            "test-value"
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationSummaryResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
