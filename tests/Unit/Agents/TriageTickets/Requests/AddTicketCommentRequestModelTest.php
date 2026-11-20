<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\TriageTickets\Requests;

use PHPUnit\Framework\TestCase;

class AddTicketCommentRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "comment": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\TriageTickets\Requests\AddTicketCommentRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
