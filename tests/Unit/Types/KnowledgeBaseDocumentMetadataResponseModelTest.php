<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class KnowledgeBaseDocumentMetadataResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "created_at_unix_secs": 1,
        "last_updated_at_unix_secs": 1,
        "size_bytes": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\KnowledgeBaseDocumentMetadataResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
