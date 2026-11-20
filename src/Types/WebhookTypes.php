<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookTypes: string
{
  case ProjectConversionStatus = 'project_conversion_status';
  case ChapterConversionStatus = 'chapter_conversion_status';
  case PostCallTranscription = 'post_call_transcription';
  case PostCallTranscriptionOtel = 'post_call_transcription_otel';
  case PostCallAudio = 'post_call_audio';
  case PostCallUnredactedTranscription = 'post_call_unredacted_transcription';
  case PostCallUnredactedTranscriptionOtel = 'post_call_unredacted_transcription_otel';
  case PostCallUnredactedAudio = 'post_call_unredacted_audio';
  case PostCallAnalysis = 'post_call_analysis';
  case CallInitiationFailure = 'call_initiation_failure';
  case ConversationInitiationClientData = 'conversation_initiation_client_data';
  case AnsweringMachineDetection = 'answering_machine_detection';
  case VoiceRemovalNotice = 'voice_removal_notice';
  case VoiceRemovalNoticeWithdrawn = 'voice_removal_notice_withdrawn';
  case VoiceRemoved = 'voice_removed';
  case SpeechToTextTranscription = 'speech_to_text_transcription';
  case WebhookError = 'webhook_error';
  case SpeechToTextBatch = 'speech_to_text_batch';
  case AgentQaEvaluationCompleted = 'agent_qa_evaluation_completed';
  case ConvaiAlertingNotification = 'convai_alerting_notification';
  case FlowsGeneration = 'flows_generation';
  case FlowsTemplateRun = 'flows_template_run';
  case DubbingProjectReady = 'dubbing_project_ready';
  case DubbingProjectFailed = 'dubbing_project_failed';
  case DubbingLanguageCompleted = 'dubbing_language_completed';
  case DubbingLanguageFailed = 'dubbing_language_failed';
  case SupportTicketMessageAdded = 'support_ticket_message_added';
}
