<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LanguageDetectionToolResultModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "language_detection_success",
        "status": "success",
        "reason": "test-value",
        "language": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\LanguageDetectionToolResultModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
