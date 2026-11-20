<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class BodyAddToKnowledgeBaseV1ConvaiKnowledgeBasePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "url": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\BodyAddToKnowledgeBaseV1ConvaiKnowledgeBasePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
