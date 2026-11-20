<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Productions\Orders\Items\Requests;

use PHPUnit\Framework\TestCase;

class BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "request": {
            "item": {
                "kind": "dub",
                "media_id": "test-value",
                "source_language": "test-value",
                "destination_languages": [
                    "test-value"
                ],
                "include_captions": true,
                "include_source_captions": true,
                "instructions": "test-value",
                "captions_sdh": true
            },
            "item_id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Productions\Orders\Items\Requests\BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
