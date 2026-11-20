<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ReviewResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "review_status": "approved",
        "reviewed_at_unix": 1,
        "reviewed_by": "test-value",
        "reject_reasons": [
            "lacks_structure"
        ],
        "scores_breakdown": {
            "key": 1
        },
        "rejected_details": "test-value",
        "explanation": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ReviewResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
