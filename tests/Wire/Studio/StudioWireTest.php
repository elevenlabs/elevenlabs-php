<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Studio;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class StudioWireTest extends TestCase
{
  public function testCreatePodcastSendsWireRequest(): void
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
    $podcastConversationModeType =
      \ElevenLabs\Types\PodcastConversationModeType::Conversation->value;

    $podcastConversationModeData = new \ElevenLabs\Types\PodcastConversationModeData([
      'hostVoiceId' => 'host_voice_id',
      'guestVoiceId' => 'guest_voice_id'
    ]);

    $podcastConversationMode = new \ElevenLabs\Types\PodcastConversationMode([
      'type' => $podcastConversationModeType,
      'conversation' => $podcastConversationModeData
    ]);
    $bodyCreatePodcastV1StudioPodcastsPostMode = \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostMode::conversation(
      $podcastConversationMode
    );

    $podcastTextSourceType = \ElevenLabs\Types\PodcastTextSourceType::Text->value;

    $bodyCreatePodcastV1StudioPodcastsPostSource = new \ElevenLabs\Types\PodcastTextSource([
      'type' => $podcastTextSourceType,
      'text' => 'text'
    ]);

    $qualityPresetType = \ElevenLabs\Types\QualityPresetType::Standard->value;

    $bodyCreatePodcastV1StudioPodcastsPostDurationScale =
      \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostDurationScale::Short->value;

    $bodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization =
      \ElevenLabs\Studio\Types\BodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization::Auto
        ->value;

    $request = new \ElevenLabs\Studio\Requests\BodyCreatePodcastV1StudioPodcastsPost([
      'safetyIdentifier' => 'safety-identifier',
      'modelId' => 'eleven_multilingual_v2',
      'mode' => $bodyCreatePodcastV1StudioPodcastsPostMode,
      'source' => $bodyCreatePodcastV1StudioPodcastsPostSource,
      'qualityPreset' => $qualityPresetType,
      'durationScale' => $bodyCreatePodcastV1StudioPodcastsPostDurationScale,
      'language' => 'qu',
      'intro' => 'intro',
      'outro' => 'outro',
      'instructionsPrompt' => 'instructions_prompt',
      'highlights' => [],
      'callbackUrl' => 'callback_url',
      'applyTextNormalization' => $bodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization
    ]);
    $sdk->studio->createPodcast(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/studio/podcasts$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
