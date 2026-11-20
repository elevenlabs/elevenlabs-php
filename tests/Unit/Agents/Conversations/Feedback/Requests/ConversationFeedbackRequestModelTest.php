<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Feedback\Requests;

use PHPUnit\Framework\TestCase;

class ConversationFeedbackRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "feedback": "like"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Conversations\Feedback\Requests\ConversationFeedbackRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
