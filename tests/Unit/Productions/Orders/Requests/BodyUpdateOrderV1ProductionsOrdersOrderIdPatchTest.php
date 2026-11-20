<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Productions\Orders\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpdateOrderV1ProductionsOrdersOrderIdPatchTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "request": {
            "name": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Productions\Orders\Requests\BodyUpdateOrderV1ProductionsOrdersOrderIdPatch::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
