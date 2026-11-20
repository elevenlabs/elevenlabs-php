<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TemplateBooleanOutputTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "status": "pending",
        "failure_reason": "timeout",
        "error_message": "test-value",
        "type": "boolean",
        "content": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TemplateBooleanOutput::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
