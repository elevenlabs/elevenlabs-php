<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LlmInfoModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "llm": "gpt-4o-mini",
        "is_checkpoint": true,
        "max_tokens_limit": 1,
        "max_context_limit": 1,
        "supports_image_input": true,
        "supports_document_input": true,
        "supports_parallel_tool_calls": true,
        "available_reasoning_efforts": [
            "none"
        ],
        "available_service_tiers": [
            "standard"
        ],
        "deprecation_info": {
            "llm": "gpt-4o-mini",
            "is_deprecated": true,
            "is_in_warning_period": true,
            "is_in_fallback_period": true,
            "fallback_percentage": 1,
            "provider_deprecation_date": "2023-01-01T12:34:56Z",
            "replacement_model": "gpt-4o-mini",
            "deprecation_config": {
                "warning_start_days": 1,
                "fallback_start_days": 1,
                "fallback_complete_days": 1,
                "fallback_start_percentage": 1,
                "fallback_complete_percentage": 1
            }
        },
        "regional_processing_surcharge": {
            "multiplier": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LlmInfoModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
