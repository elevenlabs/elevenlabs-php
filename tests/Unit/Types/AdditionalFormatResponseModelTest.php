<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class AdditionalFormatResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "requested_format": "test-value",
        "file_extension": "test-value",
        "content_type": "test-value",
        "is_base64_encoded": true,
        "content": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\AdditionalFormatResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
