<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Studio\Projects;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class ProjectsWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "projects": [
              {
                  "project_id": "test-value",
                  "name": "test-value",
                  "create_date_unix": 1,
                  "created_by_user_id": "test-value",
                  "default_title_voice_ref_id": "test-value",
                  "default_paragraph_voice_ref_id": "test-value",
                  "default_model_id": "test-value",
                  "last_conversion_date_unix": 1,
                  "can_be_downloaded": true,
                  "title": "test-value",
                  "author": "test-value",
                  "description": "test-value",
                  "genres": [
                      "test-value"
                  ],
                  "cover_image_url": "test-value",
                  "target_audience": "children",
                  "language": "test-value",
                  "content_type": "test-value",
                  "original_publication_date": "test-value",
                  "mature_content": true,
                  "isbn_number": "test-value",
                  "volume_normalization": true,
                  "state": "creating",
                  "access_level": "admin",
                  "fiction": "fiction",
                  "quality_check_on": true,
                  "quality_check_on_when_bulk_convert": true,
                  "creation_meta": {
                      "creation_progress": 1,
                      "status": "draft",
                      "type": "blank"
                  },
                  "source_type": "blank",
                  "chapters_enabled": true,
                  "captions_enabled": true,
                  "caption_style": {
                      "template": {
                          "key": "test-value",
                          "label": "test-value",
                          "requires_high_fps": true
                      },
                      "text_font": "test-value",
                      "text_scale": 1,
                      "text_color": "test-value",
                      "text_align": "start",
                      "text_style": "normal",
                      "text_weight": "normal",
                      "text_transform": "none",
                      "text_blend_mode": "normal",
                      "text_shadow": {
                          "enabled": true,
                          "color": "test-value",
                          "opacity": 1,
                          "blur": 1,
                          "offset_x": 1,
                          "offset_y": 1
                      },
                      "text_outline": {
                          "enabled": true,
                          "color": "test-value",
                          "opacity": 1,
                          "width": 1
                      },
                      "background_enabled": true,
                      "background_color": "test-value",
                      "background_opacity": 1,
                      "background_blur": 1,
                      "background_border_radius": 1,
                      "word_highlights_enabled": true,
                      "word_highlights_color": "test-value",
                      "word_highlights_background_color": "test-value",
                      "word_highlights_opacity": 1,
                      "word_highlights_border_radius": 1,
                      "word_highlights_blur": 1,
                      "section_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "word_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "character_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "cursor_enabled": true,
                      "width_pct": 1,
                      "horizontal_placement": {
                          "align": "left",
                          "translate_pct": 1
                      },
                      "vertical_placement": {
                          "align": "top",
                          "translate_pct": 1
                      },
                      "auto_break_enabled": true,
                      "max_lines_per_section": 1,
                      "max_words_per_line": 1
                  },
                  "caption_style_template_overrides": {
                      "key": {
                          "template": {
                              "key": "test-value",
                              "label": "test-value",
                              "requires_high_fps": true
                          },
                          "text_font": "test-value",
                          "text_scale": 1,
                          "text_color": "test-value",
                          "text_align": "start",
                          "text_style": "normal",
                          "text_weight": "normal",
                          "text_transform": "none",
                          "text_blend_mode": "normal",
                          "text_shadow": {
                              "enabled": true,
                              "color": "test-value",
                              "opacity": 1,
                              "blur": 1,
                              "offset_x": 1,
                              "offset_y": 1
                          },
                          "text_outline": {
                              "enabled": true,
                              "color": "test-value",
                              "opacity": 1,
                              "width": 1
                          },
                          "background_enabled": true,
                          "background_color": "test-value",
                          "background_opacity": 1,
                          "background_blur": 1,
                          "background_border_radius": 1,
                          "word_highlights_enabled": true,
                          "word_highlights_color": "test-value",
                          "word_highlights_background_color": "test-value",
                          "word_highlights_opacity": 1,
                          "word_highlights_border_radius": 1,
                          "word_highlights_blur": 1,
                          "section_animation": {
                              "enter_type": "none",
                              "exit_type": "none"
                          },
                          "word_animation": {
                              "enter_type": "none",
                              "exit_type": "none"
                          },
                          "character_animation": {
                              "enter_type": "none",
                              "exit_type": "none"
                          },
                          "cursor_enabled": true,
                          "width_pct": 1,
                          "horizontal_placement": {
                              "align": "left",
                              "translate_pct": 1
                          },
                          "vertical_placement": {
                              "align": "top",
                              "translate_pct": 1
                          },
                          "auto_break_enabled": true,
                          "max_lines_per_section": 1,
                          "max_words_per_line": 1
                      }
                  },
                  "public_share_id": "test-value",
                  "aspect_ratio": "16:9",
                  "agent_settings": {
                      "tool_settings": {
                          "key": {
                              "skip_confirmation": true
                          }
                      }
                  },
                  "default_title_voice_id": "test-value",
                  "default_paragraph_voice_id": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->list();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "project_id": "test-value",
          "name": "test-value",
          "create_date_unix": 1,
          "created_by_user_id": "test-value",
          "default_title_voice_ref_id": "test-value",
          "default_paragraph_voice_ref_id": "test-value",
          "default_model_id": "test-value",
          "last_conversion_date_unix": 1,
          "can_be_downloaded": true,
          "title": "test-value",
          "author": "test-value",
          "description": "test-value",
          "genres": [
              "test-value"
          ],
          "cover_image_url": "test-value",
          "target_audience": "children",
          "language": "test-value",
          "content_type": "test-value",
          "original_publication_date": "test-value",
          "mature_content": true,
          "isbn_number": "test-value",
          "volume_normalization": true,
          "state": "creating",
          "access_level": "admin",
          "fiction": "fiction",
          "quality_check_on": true,
          "quality_check_on_when_bulk_convert": true,
          "creation_meta": {
              "creation_progress": 1,
              "status": "draft",
              "type": "blank"
          },
          "source_type": "blank",
          "chapters_enabled": true,
          "captions_enabled": true,
          "caption_style": {
              "template": {
                  "key": "test-value",
                  "label": "test-value",
                  "requires_high_fps": true
              },
              "text_font": "test-value",
              "text_scale": 1,
              "text_color": "test-value",
              "text_align": "start",
              "text_style": "normal",
              "text_weight": "normal",
              "text_transform": "none",
              "text_blend_mode": "normal",
              "text_shadow": {
                  "enabled": true,
                  "color": "test-value",
                  "opacity": 1,
                  "blur": 1,
                  "offset_x": 1,
                  "offset_y": 1
              },
              "text_outline": {
                  "enabled": true,
                  "color": "test-value",
                  "opacity": 1,
                  "width": 1
              },
              "background_enabled": true,
              "background_color": "test-value",
              "background_opacity": 1,
              "background_blur": 1,
              "background_border_radius": 1,
              "word_highlights_enabled": true,
              "word_highlights_color": "test-value",
              "word_highlights_background_color": "test-value",
              "word_highlights_opacity": 1,
              "word_highlights_border_radius": 1,
              "word_highlights_blur": 1,
              "section_animation": {
                  "enter_type": "none",
                  "exit_type": "none"
              },
              "word_animation": {
                  "enter_type": "none",
                  "exit_type": "none"
              },
              "character_animation": {
                  "enter_type": "none",
                  "exit_type": "none"
              },
              "cursor_enabled": true,
              "width_pct": 1,
              "horizontal_placement": {
                  "align": "left",
                  "translate_pct": 1
              },
              "vertical_placement": {
                  "align": "top",
                  "translate_pct": 1
              },
              "auto_break_enabled": true,
              "max_lines_per_section": 1,
              "max_words_per_line": 1
          },
          "caption_style_template_overrides": {
              "key": {
                  "template": {
                      "key": "test-value",
                      "label": "test-value",
                      "requires_high_fps": true
                  },
                  "text_font": "test-value",
                  "text_scale": 1,
                  "text_color": "test-value",
                  "text_align": "start",
                  "text_style": "normal",
                  "text_weight": "normal",
                  "text_transform": "none",
                  "text_blend_mode": "normal",
                  "text_shadow": {
                      "enabled": true,
                      "color": "test-value",
                      "opacity": 1,
                      "blur": 1,
                      "offset_x": 1,
                      "offset_y": 1
                  },
                  "text_outline": {
                      "enabled": true,
                      "color": "test-value",
                      "opacity": 1,
                      "width": 1
                  },
                  "background_enabled": true,
                  "background_color": "test-value",
                  "background_opacity": 1,
                  "background_blur": 1,
                  "background_border_radius": 1,
                  "word_highlights_enabled": true,
                  "word_highlights_color": "test-value",
                  "word_highlights_background_color": "test-value",
                  "word_highlights_opacity": 1,
                  "word_highlights_border_radius": 1,
                  "word_highlights_blur": 1,
                  "section_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "word_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "character_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "cursor_enabled": true,
                  "width_pct": 1,
                  "horizontal_placement": {
                      "align": "left",
                      "translate_pct": 1
                  },
                  "vertical_placement": {
                      "align": "top",
                      "translate_pct": 1
                  },
                  "auto_break_enabled": true,
                  "max_lines_per_section": 1,
                  "max_words_per_line": 1
              }
          },
          "public_share_id": "test-value",
          "aspect_ratio": "16:9",
          "agent_settings": {
              "tool_settings": {
                  "key": {
                      "skip_confirmation": true
                  }
              }
          },
          "quality_preset": "standard",
          "chapters": [
              {
                  "chapter_id": "test-value",
                  "name": "test-value",
                  "last_conversion_date_unix": 1,
                  "conversion_progress": 1,
                  "can_be_downloaded": true,
                  "state": "default",
                  "has_video": true,
                  "has_visual_content": true,
                  "voice_ids": [
                      "test-value"
                  ],
                  "statistics": {
                      "characters_unconverted": 1,
                      "characters_converted": 1,
                      "paragraphs_converted": 1,
                      "paragraphs_unconverted": 1,
                      "credits_needed_to_convert": 1,
                      "voice_statistics": [
                          {
                              "project_voice_ref_id": "test-value",
                              "characters_unconverted": 1,
                              "characters_converted": 1,
                              "credits_needed_to_convert": 1,
                              "voice_id": "test-value"
                          }
                      ]
                  },
                  "last_conversion_error": "test-value"
              }
          ],
          "pronunciation_dictionary_versions": [
              {
                  "version_id": "test-value",
                  "version_rules_num": 1,
                  "pronunciation_dictionary_id": "test-value",
                  "dictionary_name": "test-value",
                  "version_name": "test-value",
                  "permission_on_resource": "admin",
                  "created_by": "test-value",
                  "creation_time_unix": 1,
                  "archived_time_unix": 1
              }
          ],
          "pronunciation_dictionary_locators": [
              {
                  "pronunciation_dictionary_id": "test-value",
                  "version_id": "test-value"
              }
          ],
          "apply_text_normalization": "auto",
          "experimental": {
              "key": "test-value"
          },
          "assets": [
              {
                  "video_id": "test-value",
                  "filename": "test-value",
                  "signed_url": "test-value",
                  "signed_preview_url": "test-value",
                  "offset_ms": 1,
                  "duration_ms": 1,
                  "volume_gain_db": 1,
                  "muted": true,
                  "fade_in_ms": 1,
                  "fade_out_ms": 1,
                  "width": 1,
                  "height": 1,
                  "codec": "test-value",
                  "order": "test-value",
                  "created_at_ms": 1,
                  "updated_at_ms": 1,
                  "error": "test-value",
                  "thumbnail_interval_seconds": 1,
                  "thumbnail_size": [
                      1,
                      1
                  ],
                  "thumbnail_sheets": [
                      {
                          "start_thumbnail_index": 1,
                          "thumbnail_count": 1,
                          "signed_cloud_url": "test-value"
                      }
                  ],
                  "start_time_ms": 1,
                  "end_time_ms": 1,
                  "asset_preview_signed_url": "test-value",
                  "source_video_id": "test-value",
                  "source_asset_id": "test-value",
                  "source_platform_asset_id": "test-value",
                  "pending_blocks_metadata": {
                      "target_global_offset_ms": 1,
                      "block_ids": [
                          "test-value"
                      ]
                  },
                  "pending_external_audios_metadata": {
                      "target_global_offset_ms": 1,
                      "external_audio_ids": [
                          "test-value"
                      ]
                  },
                  "speech_imported": true,
                  "pending_task": {
                      "type": "preprocessing",
                      "progress": 1,
                      "started_at_ms": 1,
                      "updated_at_ms": 1,
                      "metadata": {
                          "key": "test-value"
                      }
                  },
                  "audio_track_ready": true,
                  "export_format_ready": true,
                  "current_snapshot_id": "test-value",
                  "source_context": {
                      "source_type": "generation",
                      "generation_id": "test-value",
                      "prompt": "test-value",
                      "model_id": "test-value",
                      "model_provider": "test-value",
                      "generation_session_id": "test-value",
                      "session_iteration_id": "test-value",
                      "model_parameters": {
                          "key": "test-value"
                      },
                      "extend_video": {
                          "generation_id": "test-value",
                          "content_asset_id": "test-value",
                          "template_node_id": "test-value",
                          "studio_clip": {
                              "project_id": "test-value",
                              "chapter_id": "test-value",
                              "clip_type": "video",
                              "clip_id": "test-value",
                              "block_id": "test-value",
                              "preview_url": "test-value"
                          }
                      }
                  },
                  "analysis": {
                      "status": "processing",
                      "data": {
                          "title": "test-value",
                          "description": "test-value",
                          "content_type": "test-value",
                          "overall_pacing": "test-value",
                          "subjects": [
                              {
                                  "name": "test-value",
                                  "description": "test-value"
                              }
                          ],
                          "segments": [
                              {
                                  "start_ms": 1,
                                  "end_ms": 1,
                                  "description": "test-value",
                                  "subjects": [
                                      "test-value"
                                  ],
                                  "shot_type": "test-value",
                                  "camera_movement": "test-value",
                                  "transition_in": "test-value",
                                  "has_speech": true,
                                  "has_music": true,
                                  "pacing": "test-value"
                              }
                          ],
                          "key_moments": [
                              {
                                  "timestamp_ms": 1,
                                  "type": "test-value",
                                  "description": "test-value"
                              }
                          ]
                      },
                      "updated_at_ms": 1
                  },
                  "transcription": {
                      "status": "processing",
                      "data": {
                          "language_code": "test-value",
                          "text": "test-value",
                          "words": [
                              "test-value"
                          ],
                          "word_start_times_ms": [
                              1
                          ],
                          "word_end_times_ms": [
                              1
                          ],
                          "word_speaker_ids": [
                              "test-value"
                          ]
                      },
                      "updated_at_ms": 1
                  },
                  "type": "video",
                  "canvas_placement": {
                      "x_relative": 1,
                      "y_relative": 1,
                      "scale_x": 1,
                      "scale_y": 1,
                      "pivot_x": 1,
                      "pivot_y": 1,
                      "skew_x": 1,
                      "skew_y": 1,
                      "crop_top": 1,
                      "crop_right": 1,
                      "crop_bottom": 1,
                      "crop_left": 1,
                      "flip_x": true,
                      "flip_y": true
                  },
                  "animation": {
                      "enter_effect": "none",
                      "enter_duration_ms": 1,
                      "exit_effect": "none",
                      "exit_duration_ms": 1
                  },
                  "playback_speed": 1,
                  "opacity": 0,
                  "track_id": "test-value",
                  "preview_job_progress": 1,
                  "import_speech_progress": 1
              }
          ],
          "voices": [
              {
                  "project_voice_ref_id": "test-value",
                  "voice_id": "test-value",
                  "alias": "test-value",
                  "stability": 1,
                  "similarity_boost": 1,
                  "style": 1,
                  "is_pinned": true,
                  "use_speaker_boost": true,
                  "volume_gain": 1,
                  "speed": 1
              }
          ],
          "base_voices": [
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
          "publishing_read": {
              "read_id": "test-value",
              "created_at_unix": 1,
              "updated_at_unix": 1,
              "word_count": 1,
              "char_count": 1,
              "chapters": [
                  {
                      "chapter_name": "test-value",
                      "word_count": 1,
                      "char_count": 1,
                      "starting_char_offset": 1,
                      "has_parsed_html": true,
                      "has_summary": true,
                      "duration_seconds": 1,
                      "file_number": "test-value",
                      "is_fallback_name": true,
                      "chapter_id": "test-value"
                  }
              ],
              "title": "test-value",
              "author": "test-value",
              "description": "test-value",
              "article_image_url": "test-value",
              "language": "test-value",
              "locale": "test-value",
              "display_mode": "text",
              "genre": [
                  "Fantasy"
              ],
              "fiction": "test-value",
              "content_type": "test-value",
              "original_file_type": "test-value",
              "target_audience": "children",
              "mature_content": true,
              "safesearch_adult": true,
              "origin": "test-value",
              "publication_date": "test-value",
              "isbn": "test-value",
              "ean": "test-value",
              "legal_terms": {
                  "terms": "test-value",
                  "start_date": "test-value",
                  "end_date": "test-value"
              },
              "content_guidelines_terms": {
                  "terms": "test-value",
                  "start_date": "test-value",
                  "end_date": "test-value"
              },
              "last_updated_from_project_unix": 1,
              "publishing_project_id": "test-value",
              "publishing_state": "test-value",
              "publisher_profile_id": "test-value",
              "quality_score": 1,
              "publisher": "test-value",
              "copyright": "test-value",
              "subtitle": "test-value",
              "distribution_territories": [
                  "test-value"
              ],
              "edition": "test-value",
              "contributors": [
                  {
                      "name": "test-value",
                      "role": "test-value",
                      "bio": "test-value",
                      "profile_id": "test-value"
                  }
              ],
              "payout_type": "none",
              "list_price": 1,
              "currency": "usd",
              "original_audio_project_export_id": "test-value",
              "original_audio_document_id": "test-value",
              "series_id": "test-value",
              "volume": 1,
              "published_at_unix": 1,
              "read_slug": "test-value",
              "preview_audio_object": {
                  "voice_id": "test-value",
                  "text": "test-value",
                  "audio_url": "test-value",
                  "hls_manifest_url": "test-value",
                  "dash_manifest_url": "test-value",
                  "is_auto_generated": true,
                  "generated_at_unix": 1
              },
              "sample_config": {
                  "is_sample": true,
                  "parent_id": "test-value",
                  "parent_type": "read",
                  "chapter_ids": [
                      "test-value"
                  ]
              },
              "review": {
                  "review_status": "approved",
                  "reviewed_at_unix": 1,
                  "reviewed_by": "test-value",
                  "reject_reasons": [
                      "lacks_structure"
                  ],
                  "scores_breakdown": {
                      "key": 1
                  },
                  "rejected_details": "test-value",
                  "explanation": "test-value"
              },
              "voice_id": "test-value",
              "can_use_assistant": true,
              "is_voice_changer_on": true,
              "restricted_to_user_email_domains": [
                  "test-value"
              ]
          },
          "default_title_voice_id": "test-value",
          "default_paragraph_voice_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->get(
      request: new \ElevenLabs\Studio\Projects\Requests\GetProjectsRequest([
        'shareId' => 'share_id'
      ]),
      projectId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "project": {
              "project_id": "test-value",
              "name": "test-value",
              "create_date_unix": 1,
              "created_by_user_id": "test-value",
              "default_title_voice_ref_id": "test-value",
              "default_paragraph_voice_ref_id": "test-value",
              "default_model_id": "test-value",
              "last_conversion_date_unix": 1,
              "can_be_downloaded": true,
              "title": "test-value",
              "author": "test-value",
              "description": "test-value",
              "genres": [
                  "test-value"
              ],
              "cover_image_url": "test-value",
              "target_audience": "children",
              "language": "test-value",
              "content_type": "test-value",
              "original_publication_date": "test-value",
              "mature_content": true,
              "isbn_number": "test-value",
              "volume_normalization": true,
              "state": "creating",
              "access_level": "admin",
              "fiction": "fiction",
              "quality_check_on": true,
              "quality_check_on_when_bulk_convert": true,
              "creation_meta": {
                  "creation_progress": 1,
                  "status": "draft",
                  "type": "blank"
              },
              "source_type": "blank",
              "chapters_enabled": true,
              "captions_enabled": true,
              "caption_style": {
                  "template": {
                      "key": "test-value",
                      "label": "test-value",
                      "requires_high_fps": true
                  },
                  "text_font": "test-value",
                  "text_scale": 1,
                  "text_color": "test-value",
                  "text_align": "start",
                  "text_style": "normal",
                  "text_weight": "normal",
                  "text_transform": "none",
                  "text_blend_mode": "normal",
                  "text_shadow": {
                      "enabled": true,
                      "color": "test-value",
                      "opacity": 1,
                      "blur": 1,
                      "offset_x": 1,
                      "offset_y": 1
                  },
                  "text_outline": {
                      "enabled": true,
                      "color": "test-value",
                      "opacity": 1,
                      "width": 1
                  },
                  "background_enabled": true,
                  "background_color": "test-value",
                  "background_opacity": 1,
                  "background_blur": 1,
                  "background_border_radius": 1,
                  "word_highlights_enabled": true,
                  "word_highlights_color": "test-value",
                  "word_highlights_background_color": "test-value",
                  "word_highlights_opacity": 1,
                  "word_highlights_border_radius": 1,
                  "word_highlights_blur": 1,
                  "section_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "word_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "character_animation": {
                      "enter_type": "none",
                      "exit_type": "none"
                  },
                  "cursor_enabled": true,
                  "width_pct": 1,
                  "horizontal_placement": {
                      "align": "left",
                      "translate_pct": 1
                  },
                  "vertical_placement": {
                      "align": "top",
                      "translate_pct": 1
                  },
                  "auto_break_enabled": true,
                  "max_lines_per_section": 1,
                  "max_words_per_line": 1
              },
              "caption_style_template_overrides": {
                  "key": {
                      "template": {
                          "key": "test-value",
                          "label": "test-value",
                          "requires_high_fps": true
                      },
                      "text_font": "test-value",
                      "text_scale": 1,
                      "text_color": "test-value",
                      "text_align": "start",
                      "text_style": "normal",
                      "text_weight": "normal",
                      "text_transform": "none",
                      "text_blend_mode": "normal",
                      "text_shadow": {
                          "enabled": true,
                          "color": "test-value",
                          "opacity": 1,
                          "blur": 1,
                          "offset_x": 1,
                          "offset_y": 1
                      },
                      "text_outline": {
                          "enabled": true,
                          "color": "test-value",
                          "opacity": 1,
                          "width": 1
                      },
                      "background_enabled": true,
                      "background_color": "test-value",
                      "background_opacity": 1,
                      "background_blur": 1,
                      "background_border_radius": 1,
                      "word_highlights_enabled": true,
                      "word_highlights_color": "test-value",
                      "word_highlights_background_color": "test-value",
                      "word_highlights_opacity": 1,
                      "word_highlights_border_radius": 1,
                      "word_highlights_blur": 1,
                      "section_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "word_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "character_animation": {
                          "enter_type": "none",
                          "exit_type": "none"
                      },
                      "cursor_enabled": true,
                      "width_pct": 1,
                      "horizontal_placement": {
                          "align": "left",
                          "translate_pct": 1
                      },
                      "vertical_placement": {
                          "align": "top",
                          "translate_pct": 1
                      },
                      "auto_break_enabled": true,
                      "max_lines_per_section": 1,
                      "max_words_per_line": 1
                  }
              },
              "public_share_id": "test-value",
              "aspect_ratio": "16:9",
              "agent_settings": {
                  "tool_settings": {
                      "key": {
                          "skip_confirmation": true
                      }
                  }
              },
              "default_title_voice_id": "test-value",
              "default_paragraph_voice_id": "test-value"
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Studio\Projects\Requests\BodyUpdateStudioProjectV1StudioProjectsProjectIdPost(
      [
        'name' => 'Project 1',
        'defaultTitleVoiceId' => '21m00Tcm4TlvDq8ikWAM',
        'defaultParagraphVoiceId' => '21m00Tcm4TlvDq8ikWAM',
        'title' => 'title',
        'author' => 'author',
        'isbnNumber' => 'isbn_number',
        'volumeNormalization' => false
      ]
    );
    $sdk->studio->projects->update(request: $request, projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
    $sdk->studio->projects->delete(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testConvertSendsWireRequest(): void
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
    $sdk->studio->projects->convert(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/convert$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetMutedTracksSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "chapter_ids": [
              "test-value"
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->studio->projects->getMutedTracks(projectId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/projects/[^/]+/muted-tracks$#',
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
