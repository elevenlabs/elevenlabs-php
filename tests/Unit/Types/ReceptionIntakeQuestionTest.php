<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReceptionIntakeQuestionTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "label": "test-value",
        "kind": "text",
        "options": [
            "test-value"
        ],
        "required": true,
        "is_active": true
    }
    JSON;

    $instance = \ElevenLabs\Types\ReceptionIntakeQuestion::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
