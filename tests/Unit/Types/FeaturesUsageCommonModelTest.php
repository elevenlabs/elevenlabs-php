<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FeaturesUsageCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "language_detection": {
            "enabled": true,
            "used": true
        },
        "transfer_to_agent": {
            "enabled": true,
            "used": true
        },
        "transfer_to_number": {
            "enabled": true,
            "used": true
        },
        "multivoice": {
            "enabled": true,
            "used": true
        },
        "dtmf_tones": {
            "enabled": true,
            "used": true
        },
        "external_mcp_servers": {
            "enabled": true,
            "used": true
        },
        "pii_zrm_workspace": true,
        "pii_zrm_agent": true,
        "tool_dynamic_variable_updates": {
            "enabled": true,
            "used": true
        },
        "is_livekit": true,
        "voicemail_detection": {
            "enabled": true,
            "used": true
        },
        "dtmf_input": {
            "enabled": true,
            "used": true
        },
        "workflow": {
            "enabled": true,
            "tool_node": {
                "enabled": true,
                "used": true
            },
            "standalone_agent_node": {
                "enabled": true,
                "used": true
            },
            "phone_number_node": {
                "enabled": true,
                "used": true
            },
            "end_node": {
                "enabled": true,
                "used": true
            },
            "override_agent_node": {
                "enabled": true,
                "used": true
            }
        },
        "agent_testing": {
            "enabled": true,
            "tests_ran_after_last_modification": true,
            "tests_ran_in_last_7_days": true
        },
        "versioning": {
            "enabled": true,
            "used": true
        },
        "file_input": {
            "enabled": true,
            "used": true
        },
        "freeform_procedure": {
            "enabled": true,
            "used": true
        },
        "structured_procedure": {
            "enabled": true,
            "used": true
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\FeaturesUsageCommonModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
