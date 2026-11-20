<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OpenAiTracingConfigurationTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "group_id": "test-value",
        "workflow_name": "test-value",
        "metadata": {
            "key": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\OpenAiTracingConfiguration::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
