<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseBulkDeleteSuccessfulResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "status": "success",
        "data": {
            "id": "test-value"
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseBulkDeleteSuccessfulResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
