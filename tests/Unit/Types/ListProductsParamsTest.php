<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ListProductsParamsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "list_kwargs": {
            "key": "test-value"
        },
        "smb_tool_type": "list_products"
    }
    JSON;

    $instance = \ElevenLabs\Types\ListProductsParams::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
