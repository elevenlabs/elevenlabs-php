<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ConversationHistoryFeedbackCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "thumbs",
        "overall_score": "like",
        "likes": 1,
        "dislikes": 1,
        "rating": 1,
        "comment": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ConversationHistoryFeedbackCommonModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
