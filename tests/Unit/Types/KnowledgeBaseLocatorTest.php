<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseLocatorTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "type": "file",
        "name": "test-value",
        "id": "test-value",
        "usage_mode": "prompt"
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseLocator::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
