<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class GetAgentEmbedResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "agent_id": "test-value",
        "widget_config": {
            "variant": "tiny",
            "placement": "top-left",
            "expandable": "never",
            "avatar": {
                "type": "orb",
                "color_1": "test-value",
                "color_2": "test-value"
            },
            "feedback_mode": "none",
            "end_feedback": {
                "type": "rating"
            },
            "bg_color": "test-value",
            "text_color": "test-value",
            "btn_color": "test-value",
            "btn_text_color": "test-value",
            "border_color": "test-value",
            "focus_color": "test-value",
            "border_radius": 1,
            "btn_radius": 1,
            "action_text": "test-value",
            "start_call_text": "test-value",
            "end_call_text": "test-value",
            "expand_text": "test-value",
            "listening_text": "test-value",
            "speaking_text": "test-value",
            "shareable_page_text": "test-value",
            "shareable_page_show_terms": true,
            "terms_text": "test-value",
            "terms_html": "test-value",
            "terms_key": "test-value",
            "show_avatar_when_collapsed": true,
            "disable_banner": true,
            "override_link": "test-value",
            "markdown_link_allowed_hosts": [
                {
                    "hostname": "test-value"
                }
            ],
            "markdown_link_include_www": true,
            "markdown_link_allow_http": true,
            "mic_muting_enabled": true,
            "transcript_enabled": true,
            "text_input_enabled": true,
            "conversation_mode_toggle_enabled": true,
            "default_expanded": true,
            "always_expanded": true,
            "dismissible": true,
            "show_agent_status": true,
            "show_conversation_id": true,
            "strip_audio_tags": true,
            "syntax_highlight_theme": "light",
            "text_contents": {
                "main_label": "test-value",
                "start_call": "test-value",
                "start_chat": "test-value",
                "new_call": "test-value",
                "end_call": "test-value",
                "mute_microphone": "test-value",
                "change_language": "test-value",
                "collapse": "test-value",
                "expand": "test-value",
                "copied": "test-value",
                "accept_terms": "test-value",
                "dismiss_terms": "test-value",
                "listening_status": "test-value",
                "speaking_status": "test-value",
                "connecting_status": "test-value",
                "chatting_status": "test-value",
                "queue_waiting_status": "test-value",
                "queue_waiting_status_short": "test-value",
                "input_label": "test-value",
                "input_placeholder": "test-value",
                "input_placeholder_text_only": "test-value",
                "input_placeholder_new_conversation": "test-value",
                "user_ended_conversation": "test-value",
                "agent_ended_conversation": "test-value",
                "conversation_id": "test-value",
                "error_occurred": "test-value",
                "queue_timed_out": "test-value",
                "copy_id": "test-value",
                "initiate_feedback": "test-value",
                "request_follow_up_feedback": "test-value",
                "thanks_for_feedback": "test-value",
                "thanks_for_feedback_details": "test-value",
                "follow_up_feedback_placeholder": "test-value",
                "submit": "test-value",
                "go_back": "test-value",
                "send_message": "test-value",
                "text_mode": "test-value",
                "voice_mode": "test-value",
                "switched_to_text_mode": "test-value",
                "switched_to_voice_mode": "test-value",
                "copy": "test-value",
                "download": "test-value",
                "wrap": "test-value",
                "agent_working": "test-value",
                "agent_done": "test-value",
                "agent_error": "test-value",
                "attach_file": "test-value",
                "remove_file": "test-value",
                "file_upload_error": "test-value",
                "file_type_unsupported": "test-value",
                "file_too_large": "test-value",
                "file_limit_reached": "test-value",
                "typing_indicator": "test-value",
                "rich_content_unavailable": "test-value"
            },
            "styles": {
                "base": "test-value",
                "base_hover": "test-value",
                "base_active": "test-value",
                "base_border": "test-value",
                "base_subtle": "test-value",
                "base_primary": "test-value",
                "base_error": "test-value",
                "accent": "test-value",
                "accent_hover": "test-value",
                "accent_active": "test-value",
                "accent_border": "test-value",
                "accent_subtle": "test-value",
                "accent_primary": "test-value",
                "overlay_padding": 1,
                "button_radius": 1,
                "input_radius": 1,
                "bubble_radius": 1,
                "sheet_radius": 1,
                "compact_sheet_radius": 1,
                "dropdown_sheet_radius": 1
            },
            "show_resize_button": true,
            "end_confirmation_enabled": true,
            "mobile_fullscreen": true,
            "transcript_speech_sync_enabled": true,
            "language": "test-value",
            "supported_language_overrides": [
                "test-value"
            ],
            "language_presets": {
                "key": {
                    "first_message": "test-value",
                    "text_contents": {
                        "main_label": "test-value",
                        "start_call": "test-value",
                        "start_chat": "test-value",
                        "new_call": "test-value",
                        "end_call": "test-value",
                        "mute_microphone": "test-value",
                        "change_language": "test-value",
                        "collapse": "test-value",
                        "expand": "test-value",
                        "copied": "test-value",
                        "accept_terms": "test-value",
                        "dismiss_terms": "test-value",
                        "listening_status": "test-value",
                        "speaking_status": "test-value",
                        "connecting_status": "test-value",
                        "chatting_status": "test-value",
                        "queue_waiting_status": "test-value",
                        "queue_waiting_status_short": "test-value",
                        "input_label": "test-value",
                        "input_placeholder": "test-value",
                        "input_placeholder_text_only": "test-value",
                        "input_placeholder_new_conversation": "test-value",
                        "user_ended_conversation": "test-value",
                        "agent_ended_conversation": "test-value",
                        "conversation_id": "test-value",
                        "error_occurred": "test-value",
                        "queue_timed_out": "test-value",
                        "copy_id": "test-value",
                        "initiate_feedback": "test-value",
                        "request_follow_up_feedback": "test-value",
                        "thanks_for_feedback": "test-value",
                        "thanks_for_feedback_details": "test-value",
                        "follow_up_feedback_placeholder": "test-value",
                        "submit": "test-value",
                        "go_back": "test-value",
                        "send_message": "test-value",
                        "text_mode": "test-value",
                        "voice_mode": "test-value",
                        "switched_to_text_mode": "test-value",
                        "switched_to_voice_mode": "test-value",
                        "copy": "test-value",
                        "download": "test-value",
                        "wrap": "test-value",
                        "agent_working": "test-value",
                        "agent_done": "test-value",
                        "agent_error": "test-value",
                        "attach_file": "test-value",
                        "remove_file": "test-value",
                        "file_upload_error": "test-value",
                        "file_type_unsupported": "test-value",
                        "file_too_large": "test-value",
                        "file_limit_reached": "test-value",
                        "typing_indicator": "test-value",
                        "rich_content_unavailable": "test-value"
                    },
                    "terms_text": "test-value",
                    "terms_html": "test-value",
                    "terms_key": "test-value"
                }
            },
            "text_only": true,
            "supports_text_only": true,
            "first_message": "test-value",
            "use_rtc": true,
            "file_input_config": {
                "enabled": true,
                "max_files_in_memory": 1,
                "max_files_per_conversation": 1
            }
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\GetAgentEmbedResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
