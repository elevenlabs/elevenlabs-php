<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Voices;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class VoicesWireTest extends TestCase
{
  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voice_id": "test-value",
          "name": "test-value",
          "samples": [
              {
                  "sample_id": "test-value",
                  "file_name": "test-value",
                  "mime_type": "test-value",
                  "size_bytes": 1,
                  "hash": "test-value",
                  "duration_secs": 1,
                  "remove_background_noise": true,
                  "has_isolated_audio": true,
                  "has_isolated_audio_preview": true,
                  "speaker_separation": {
                      "voice_id": "test-value",
                      "sample_id": "test-value",
                      "status": "not_started",
                      "speakers": {
                          "key": {
                              "speaker_id": "test-value",
                              "duration_secs": 1,
                              "utterances": [
                                  {
                                      "start": 1,
                                      "end": 1
                                  }
                              ]
                          }
                      },
                      "selected_speaker_ids": [
                          "test-value"
                      ]
                  },
                  "trim_start": 1,
                  "trim_end": 1
              }
          ],
          "category": "generated",
          "fine_tuning": {
              "is_allowed_to_fine_tune": true,
              "state": {
                  "key": "not_started"
              },
              "verification_failures": [
                  "test-value"
              ],
              "verification_attempts_count": 1,
              "manual_verification_requested": true,
              "language": "test-value",
              "progress": {
                  "key": 1
              },
              "message": {
                  "key": "test-value"
              },
              "dataset_duration_seconds": 1,
              "verification_attempts": [
                  {
                      "text": "test-value",
                      "date_unix": 1,
                      "accepted": true,
                      "similarity": 1,
                      "levenshtein_distance": 1,
                      "recording": {
                          "recording_id": "test-value",
                          "mime_type": "test-value",
                          "size_bytes": 1,
                          "upload_date_unix": 1,
                          "transcription": "test-value"
                      }
                  }
              ],
              "slice_ids": [
                  "test-value"
              ],
              "manual_verification": {
                  "extra_text": "test-value",
                  "request_time_unix": 1,
                  "files": [
                      {
                          "file_id": "test-value",
                          "file_name": "test-value",
                          "mime_type": "test-value",
                          "size_bytes": 1,
                          "upload_date_unix": 1
                      }
                  ]
              },
              "max_verification_attempts": 1,
              "next_max_verification_attempts_reset_unix_ms": 1,
              "finetuning_state": "test-value"
          },
          "labels": {
              "key": "test-value"
          },
          "description": "test-value",
          "preview_url": "test-value",
          "available_for_tiers": [
              "test-value"
          ],
          "settings": {
              "stability": 0,
              "use_speaker_boost": true,
              "similarity_boost": 0,
              "style": 1,
              "speed": 1,
              "clone_strength": 0
          },
          "sharing": {
              "status": "enabled",
              "history_item_sample_id": "test-value",
              "date_unix": 1,
              "whitelisted_emails": [
                  "test-value"
              ],
              "public_owner_id": "test-value",
              "original_voice_id": "test-value",
              "financial_rewards_enabled": true,
              "free_users_allowed": true,
              "live_moderation_enabled": true,
              "rate": 1,
              "fiat_rate": 1,
              "notice_period": 1,
              "disable_at_unix": 1,
              "voice_mixing_allowed": true,
              "featured": true,
              "category": "generated",
              "reader_app_enabled": true,
              "image_url": "test-value",
              "ban_reason": "test-value",
              "liked_by_count": 1,
              "cloned_by_count": 1,
              "name": "test-value",
              "description": "test-value",
              "labels": {
                  "key": "test-value"
              },
              "review_status": "not_requested",
              "review_message": "test-value",
              "enabled_in_library": true,
              "instagram_username": "test-value",
              "twitter_username": "test-value",
              "youtube_username": "test-value",
              "tiktok_username": "test-value",
              "moderation_check": {
                  "date_checked_unix": 1,
                  "name_value": "test-value",
                  "name_check": true,
                  "description_value": "test-value",
                  "description_check": true,
                  "sample_ids": [
                      "test-value"
                  ],
                  "sample_checks": [
                      1
                  ],
                  "captcha_ids": [
                      "test-value"
                  ],
                  "captcha_checks": [
                      1
                  ]
              },
              "reader_restricted_on": [
                  {
                      "resource_type": "read",
                      "resource_id": "test-value"
                  }
              ]
          },
          "high_quality_base_model_ids": [
              "test-value"
          ],
          "verified_languages": [
              {
                  "language": "test-value",
                  "model_id": "test-value",
                  "accent": "test-value",
                  "locale": "test-value",
                  "preview_url": "test-value"
              }
          ],
          "collection_ids": [
              "test-value"
          ],
          "safety_control": "NONE",
          "voice_verification": {
              "requires_verification": true,
              "is_verified": true,
              "verification_failures": [
                  "test-value"
              ],
              "verification_attempts_count": 1,
              "language": "test-value",
              "verification_attempts": [
                  {
                      "text": "test-value",
                      "date_unix": 1,
                      "accepted": true,
                      "similarity": 1,
                      "levenshtein_distance": 1,
                      "recording": {
                          "recording_id": "test-value",
                          "mime_type": "test-value",
                          "size_bytes": 1,
                          "upload_date_unix": 1,
                          "transcription": "test-value"
                      }
                  }
              ]
          },
          "permission_on_resource": "test-value",
          "is_owner": true,
          "is_legacy": true,
          "is_mixed": true,
          "favorited_at_unix": 1,
          "created_at_unix": 1,
          "is_bookmarked": true,
          "recording_quality": "studio",
          "labelling_status": "in_review",
          "recording_quality_reason": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->get(
      request: new \ElevenLabs\Voices\Requests\GetVoicesRequest([
        'withSettings' => true
      ]),
      voiceId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "status": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->delete(voiceId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testSearchSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voices": [
              {
                  "voice_id": "test-value",
                  "name": "test-value",
                  "samples": [
                      {
                          "sample_id": "test-value",
                          "file_name": "test-value",
                          "mime_type": "test-value",
                          "size_bytes": 1,
                          "hash": "test-value",
                          "duration_secs": 1,
                          "remove_background_noise": true,
                          "has_isolated_audio": true,
                          "has_isolated_audio_preview": true,
                          "speaker_separation": {
                              "voice_id": "test-value",
                              "sample_id": "test-value",
                              "status": "not_started",
                              "speakers": {
                                  "key": {
                                      "speaker_id": "test-value",
                                      "duration_secs": 1,
                                      "utterances": [
                                          {
                                              "start": 1,
                                              "end": 1
                                          }
                                      ]
                                  }
                              },
                              "selected_speaker_ids": [
                                  "test-value"
                              ]
                          },
                          "trim_start": 1,
                          "trim_end": 1
                      }
                  ],
                  "category": "generated",
                  "fine_tuning": {
                      "is_allowed_to_fine_tune": true,
                      "state": {
                          "key": "not_started"
                      },
                      "verification_failures": [
                          "test-value"
                      ],
                      "verification_attempts_count": 1,
                      "manual_verification_requested": true,
                      "language": "test-value",
                      "progress": {
                          "key": 1
                      },
                      "message": {
                          "key": "test-value"
                      },
                      "dataset_duration_seconds": 1,
                      "verification_attempts": [
                          {
                              "text": "test-value",
                              "date_unix": 1,
                              "accepted": true,
                              "similarity": 1,
                              "levenshtein_distance": 1,
                              "recording": {
                                  "recording_id": "test-value",
                                  "mime_type": "test-value",
                                  "size_bytes": 1,
                                  "upload_date_unix": 1,
                                  "transcription": "test-value"
                              }
                          }
                      ],
                      "slice_ids": [
                          "test-value"
                      ],
                      "manual_verification": {
                          "extra_text": "test-value",
                          "request_time_unix": 1,
                          "files": [
                              {
                                  "file_id": "test-value",
                                  "file_name": "test-value",
                                  "mime_type": "test-value",
                                  "size_bytes": 1,
                                  "upload_date_unix": 1
                              }
                          ]
                      },
                      "max_verification_attempts": 1,
                      "next_max_verification_attempts_reset_unix_ms": 1,
                      "finetuning_state": "test-value"
                  },
                  "labels": {
                      "key": "test-value"
                  },
                  "description": "test-value",
                  "preview_url": "test-value",
                  "available_for_tiers": [
                      "test-value"
                  ],
                  "settings": {
                      "stability": 0,
                      "use_speaker_boost": true,
                      "similarity_boost": 0,
                      "style": 1,
                      "speed": 1,
                      "clone_strength": 0
                  },
                  "sharing": {
                      "status": "enabled",
                      "history_item_sample_id": "test-value",
                      "date_unix": 1,
                      "whitelisted_emails": [
                          "test-value"
                      ],
                      "public_owner_id": "test-value",
                      "original_voice_id": "test-value",
                      "financial_rewards_enabled": true,
                      "free_users_allowed": true,
                      "live_moderation_enabled": true,
                      "rate": 1,
                      "fiat_rate": 1,
                      "notice_period": 1,
                      "disable_at_unix": 1,
                      "voice_mixing_allowed": true,
                      "featured": true,
                      "category": "generated",
                      "reader_app_enabled": true,
                      "image_url": "test-value",
                      "ban_reason": "test-value",
                      "liked_by_count": 1,
                      "cloned_by_count": 1,
                      "name": "test-value",
                      "description": "test-value",
                      "labels": {
                          "key": "test-value"
                      },
                      "review_status": "not_requested",
                      "review_message": "test-value",
                      "enabled_in_library": true,
                      "instagram_username": "test-value",
                      "twitter_username": "test-value",
                      "youtube_username": "test-value",
                      "tiktok_username": "test-value",
                      "moderation_check": {
                          "date_checked_unix": 1,
                          "name_value": "test-value",
                          "name_check": true,
                          "description_value": "test-value",
                          "description_check": true,
                          "sample_ids": [
                              "test-value"
                          ],
                          "sample_checks": [
                              1
                          ],
                          "captcha_ids": [
                              "test-value"
                          ],
                          "captcha_checks": [
                              1
                          ]
                      },
                      "reader_restricted_on": [
                          {
                              "resource_type": "read",
                              "resource_id": "test-value"
                          }
                      ]
                  },
                  "high_quality_base_model_ids": [
                      "test-value"
                  ],
                  "verified_languages": [
                      {
                          "language": "test-value",
                          "model_id": "test-value",
                          "accent": "test-value",
                          "locale": "test-value",
                          "preview_url": "test-value"
                      }
                  ],
                  "collection_ids": [
                      "test-value"
                  ],
                  "safety_control": "NONE",
                  "voice_verification": {
                      "requires_verification": true,
                      "is_verified": true,
                      "verification_failures": [
                          "test-value"
                      ],
                      "verification_attempts_count": 1,
                      "language": "test-value",
                      "verification_attempts": [
                          {
                              "text": "test-value",
                              "date_unix": 1,
                              "accepted": true,
                              "similarity": 1,
                              "levenshtein_distance": 1,
                              "recording": {
                                  "recording_id": "test-value",
                                  "mime_type": "test-value",
                                  "size_bytes": 1,
                                  "upload_date_unix": 1,
                                  "transcription": "test-value"
                              }
                          }
                      ]
                  },
                  "permission_on_resource": "test-value",
                  "is_owner": true,
                  "is_legacy": true,
                  "is_mixed": true,
                  "favorited_at_unix": 1,
                  "created_at_unix": 1,
                  "is_bookmarked": true,
                  "recording_quality": "studio",
                  "labelling_status": "in_review",
                  "recording_quality_reason": "test-value"
              }
          ],
          "has_more": true,
          "total_count": 1,
          "next_page_token": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->voices->search(
      request: new \ElevenLabs\Voices\Requests\SearchVoicesRequest([
        'nextPageToken' => 'next_page_token',
        'pageSize' => 10,
        'search' => 'search',
        'sort' => 'sort',
        'sortDirection' => 'sort_direction',
        'voiceType' => 'voice_type',
        'category' => 'category',
        'fineTuningState' => 'fine_tuning_state',
        'collectionId' => 'collection_id',
        'gender' => 'gender',
        'age' => 'age',
        'language' => [],
        'accent' => 'accent',
        'useCases' => [],
        'minNoticePeriodDays' => 1,
        'includeCustomRates' => false,
        'includeLiveModerated' => true,
        'highQuality' => false,
        'includeTotalCount' => true,
        'voiceIds' => []
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v2/voices$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testReplicateToIsolatedEnvironmentSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Voices\Requests\ReplicateVoiceToIsolatedEnvironmentRequestModel([
      'targetWorkspaceId' => 'target_workspace_id',
      'preserveVoiceId' => true
    ]);
    $sdk->voices->replicateToIsolatedEnvironment(
      request: $request,
      voiceId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/[^/]+/replicate-to-isolated-environment$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testShareSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Voices\Requests\BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost(
      [
        'newName' => 'John Smith',
        'bookmarked' => true
      ]
    );
    $sdk->voices->share(
      request: $request,
      publicUserId: '63e06b7e7cafdc46be4d2e0b3f045940231ae058d508589653d74d1265a574ca',
      voiceId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/voices/add/[^/]+/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSharedSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "voices": [
              {
                  "public_owner_id": "test-value",
                  "voice_id": "test-value",
                  "date_unix": 1,
                  "name": "test-value",
                  "accent": "test-value",
                  "gender": "test-value",
                  "age": "test-value",
                  "descriptive": "test-value",
                  "use_case": "test-value",
                  "category": "generated",
                  "language": "test-value",
                  "locale": "test-value",
                  "description": "test-value",
                  "preview_url": "test-value",
                  "usage_character_count_1y": 1,
                  "usage_character_count_7d": 1,
                  "play_api_usage_character_count_1y": 1,
                  "cloned_by_count": 1,
                  "rate": 1,
                  "fiat_rate": 1,
                  "free_users_allowed": true,
                  "live_moderation_enabled": true,
                  "featured": true,
                  "verified_languages": [
                      {
                          "language": "test-value",
                          "model_id": "test-value",
                          "accent": "test-value",
                          "locale": "test-value",
                          "preview_url": "test-value"
                      }
                  ],
                  "notice_period": 1,
                  "instagram_username": "test-value",
                  "twitter_username": "test-value",
                  "youtube_username": "test-value",
                  "tiktok_username": "test-value",
                  "image_url": "test-value",
                  "is_added_by_user": true,
                  "is_bookmarked": true
              }
          ],
          "has_more": true,
          "total_count": 1,
          "last_sort_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $category = \ElevenLabs\Voices\Types\GetSharedVoicesRequestCategory::Professional;
    $sort = \ElevenLabs\Voices\Types\GetSharedVoicesRequestSort::CreatedDate;
    $sdk->voices->getShared(
      request: new \ElevenLabs\Voices\Requests\GetSharedVoicesRequest([
        'pageSize' => 30,
        'category' => $category->value,
        'gender' => 'gender',
        'age' => 'age',
        'accent' => 'accent',
        'language' => 'language',
        'locale' => 'locale',
        'search' => 'search',
        'useCases' => [],
        'descriptives' => [],
        'featured' => true,
        'minNoticePeriodDays' => 6,
        'includeCustomRates' => false,
        'includeLiveModerated' => true,
        'readerAppEnabled' => true,
        'ownerId' => 'owner_id',
        'sort' => $sort->value,
        'page' => 10
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/shared-voices$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  /**
   * @return ClientInterface&object{requests: list<RequestInterface>}
   */
  private function transport(int $status, string $body): ClientInterface
  {
    return new class ($status, $body) implements ClientInterface {
      /** @var list<RequestInterface> */
      public array $requests = [];

      public function __construct(private int $status, private string $body)
      {
      }

      public function sendRequest(RequestInterface $request): ResponseInterface
      {
        $this->requests[] = $request;

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}
