<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class SafetyResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "is_blocked_ivc": true,
        "is_blocked_non_ivc": true,
        "ignore_safety_evaluation": true
    }
    JSON;

    $instance = \ElevenLabs\Types\SafetyResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
