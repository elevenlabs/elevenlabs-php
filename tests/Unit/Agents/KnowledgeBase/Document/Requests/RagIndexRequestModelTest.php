<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\KnowledgeBase\Document\Requests;

use PHPUnit\Framework\TestCase;

class RagIndexRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "model": "e5_mistral_7b_instruct"
    }
    JSON;

    $instance = \ElevenLabs\Agents\KnowledgeBase\Document\Requests\RagIndexRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
