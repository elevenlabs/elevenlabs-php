<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Requests;

use PHPUnit\Framework\TestCase;

class BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Requests\BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
