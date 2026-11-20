<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetOrCreateRagIndexRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "document_id": "test-value",
        "create_if_missing": true,
        "model": "e5_mistral_7b_instruct"
    }
    JSON;

    $instance = \ElevenLabs\Types\GetOrCreateRagIndexRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
