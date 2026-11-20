<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EndProcedureToolConfigTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "system_tool_type": "end_procedure",
        "procedures": {
            "key": {
                "procedure_id": "test-value",
                "version_id": "test-value"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\EndProcedureToolConfig::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
