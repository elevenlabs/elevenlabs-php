<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TicketSearchMatchResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "field": "title",
        "snippet": "test-value",
        "highlight_start": 1,
        "highlight_end": 1,
        "turn_index": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\TicketSearchMatchResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
