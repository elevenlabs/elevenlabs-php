<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\TriageTickets\Requests;

use PHPUnit\Framework\TestCase;

class AddTurnCommentRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "turn_index": 0,
        "comment": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\TriageTickets\Requests\AddTurnCommentRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
