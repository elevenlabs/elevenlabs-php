<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WidgetTextContentsTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
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
    }
    JSON;

    $instance = \ElevenLabs\Types\WidgetTextContents::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
