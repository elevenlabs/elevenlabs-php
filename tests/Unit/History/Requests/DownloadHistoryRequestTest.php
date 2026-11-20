<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\History\Requests;

use PHPUnit\Framework\TestCase;

class DownloadHistoryRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "history_item_ids": [
            "test-value"
        ],
        "output_format": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\History\Requests\DownloadHistoryRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
