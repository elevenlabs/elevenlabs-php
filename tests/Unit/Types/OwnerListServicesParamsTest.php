<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class OwnerListServicesParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "list_kwargs": {
            "key": "test-value"
        },
        "smb_tool_type": "owner_list_services"
    }
    JSON;

    $instance = \ElevenLabs\Types\OwnerListServicesParams::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
