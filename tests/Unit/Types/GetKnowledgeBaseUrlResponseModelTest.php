<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetKnowledgeBaseUrlResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "name": "test-value",
        "metadata": {
            "created_at_unix_secs": 1,
            "last_updated_at_unix_secs": 1,
            "size_bytes": 1
        },
        "supported_usages": [
            "prompt"
        ],
        "access_info": {
            "is_creator": true,
            "creator_name": "test-value",
            "creator_email": "test-value",
            "role": "admin",
            "anonymous_access_level_override": "admin",
            "access_source": "creator"
        },
        "folder_parent_id": "test-value",
        "chunking_override": {
            "max_chunk_size": 1,
            "overlap_percentage": 1,
            "custom_separators": [
                "test-value"
            ]
        },
        "folder_path": [
            {
                "id": "test-value",
                "name": "test-value"
            }
        ],
        "type": "url",
        "url": "test-value",
        "extracted_inner_html": "test-value",
        "content_format": "html",
        "auto_sync_info": {
            "minimum_frequency_days": 1,
            "auto_remove": true,
            "consec_failures": 0,
            "next_refresh_by": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GetKnowledgeBaseUrlResponseModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
