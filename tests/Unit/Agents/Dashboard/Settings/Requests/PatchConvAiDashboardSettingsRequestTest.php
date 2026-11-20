<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Dashboard\Settings\Requests;

use PHPUnit\Framework\TestCase;

class PatchConvAiDashboardSettingsRequestTest extends TestCase
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

    $instance = \ElevenLabs\Agents\Dashboard\Settings\Requests\PatchConvAiDashboardSettingsRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
