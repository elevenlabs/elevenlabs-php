<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EndCallToolResultModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "end_call_success",
        "status": "success",
        "reason": "test-value",
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\EndCallToolResultModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
