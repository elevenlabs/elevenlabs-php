<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class DubbingResourceTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "id": "test-value",
        "version": 1,
        "source_language": "test-value",
        "target_languages": [
            "test-value"
        ],
        "input": {
            "src": "test-value",
            "content_type": "test-value",
            "bucket_name": "test-value",
            "random_path_slug": "test-value",
            "duration_secs": 1,
            "is_audio": true,
            "url": "test-value"
        },
        "background": {
            "src": "test-value",
            "content_type": "test-value",
            "bucket_name": "test-value",
            "random_path_slug": "test-value",
            "duration_secs": 1,
            "is_audio": true,
            "url": "test-value"
        },
        "foreground": {
            "src": "test-value",
            "content_type": "test-value",
            "bucket_name": "test-value",
            "random_path_slug": "test-value",
            "duration_secs": 1,
            "is_audio": true,
            "url": "test-value"
        },
        "speaker_tracks": {
            "key": {
                "id": "test-value",
                "media_ref": {
                    "src": "test-value",
                    "content_type": "test-value",
                    "bucket_name": "test-value",
                    "random_path_slug": "test-value",
                    "duration_secs": 1,
                    "is_audio": true,
                    "url": "test-value"
                },
                "speaker_name": "test-value",
                "voices": {
                    "key": "test-value"
                },
                "segments": [
                    "test-value"
                ]
            }
        },
        "speaker_segments": {
            "key": {
                "id": "test-value",
                "start_time": 1,
                "end_time": 1,
                "text": "test-value",
                "subtitles": [
                    {
                        "start_time": 1,
                        "end_time": 1,
                        "lines": [
                            "test-value"
                        ]
                    }
                ],
                "dubs": {
                    "key": {
                        "start_time": 1,
                        "end_time": 1,
                        "text": "test-value",
                        "subtitles": [
                            {
                                "start_time": 1,
                                "end_time": 1,
                                "lines": [
                                    "test-value"
                                ]
                            }
                        ],
                        "audio_stale": true,
                        "media_ref": {
                            "src": "test-value",
                            "content_type": "test-value",
                            "bucket_name": "test-value",
                            "random_path_slug": "test-value",
                            "duration_secs": 1,
                            "is_audio": true,
                            "url": "test-value"
                        }
                    }
                }
            }
        },
        "renders": {
            "key": {
                "id": "test-value",
                "version": 1,
                "language": "test-value",
                "type": "mp4",
                "media_ref": {
                    "src": "test-value",
                    "content_type": "test-value",
                    "bucket_name": "test-value",
                    "random_path_slug": "test-value",
                    "duration_secs": 1,
                    "is_audio": true,
                    "url": "test-value"
                },
                "status": "complete"
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\DubbingResource::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
