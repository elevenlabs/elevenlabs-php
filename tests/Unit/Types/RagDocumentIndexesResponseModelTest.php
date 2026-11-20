<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class RagDocumentIndexesResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "indexes": [
            {
                "id": "test-value",
                "model": "e5_mistral_7b_instruct",
                "status": "new",
                "progress_percentage": 1,
                "document_model_index_usage": {
                    "used_bytes": 1
                }
            }
        ]
    }
    JSON;

    $instance = \ElevenLabs\Types\RagDocumentIndexesResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
