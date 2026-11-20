<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StartProcedureToolConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "system_tool_type": "start_procedure",
        "procedures": {
            "key": {
                "procedure_id": "test-value",
                "version_id": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\StartProcedureToolConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
