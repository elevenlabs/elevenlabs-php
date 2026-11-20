<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetConvAiDashboardSettingsResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "charts": [
            {
                "name": "test-value",
                "type": "call_success"
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\GetConvAiDashboardSettingsResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
