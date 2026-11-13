<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WorkspaceGroupPermission: string
{
  case TextToSpeech = 'text_to_speech';
  case SpeechToSpeech = 'speech_to_speech';
  case SpeechToText = 'speech_to_text';
  case VoiceLab = 'voice_lab';
  case SoundEffects = 'sound_effects';
  case Projects = 'projects';
  case VoiceoverStudio = 'voiceover_studio';
  case Dubbing = 'dubbing';
  case AudioNative = 'audio_native';
  case ConversationalAi = 'conversational_ai';
  case ConversationalAiRead = 'conversational_ai_read';
  case Architect = 'architect';
  case VoiceIsolator = 'voice_isolator';
  case AiSpeechClassifier = 'ai_speech_classifier';
  case SynthidDetector = 'synthid_detector';
  case AddVoiceFromVoiceLibrary = 'add_voice_from_voice_library';
  case CreateInstantVoiceClone = 'create_instant_voice_clone';
  case CreateProfessionalVoiceClone = 'create_professional_voice_clone';
  case CreateUserApiKey = 'create_user_api_key';
  case PublishStudioProject = 'publish_studio_project';
  case Music = 'music';
  case ImageVideoGeneration = 'image_video_generation';
  case Flows = 'flows';
  case Templates = 'templates';
  case ShareVoiceExternally = 'share_voice_externally';
  case PublishVoiceToVoiceLibrary = 'publish_voice_to_voice_library';
  case ViewFiatBalance = 'view_fiat_balance';
  case WorkspaceAnalyticsFullRead = 'workspace_analytics_full_read';
  case ServiceAccountsManage = 'service_accounts_manage';
  case WebhooksManage = 'webhooks_manage';
  case GroupMembersManage = 'group_members_manage';
  case WorkspaceMembersInvite = 'workspace_members_invite';
  case WorkspaceMembersRemove = 'workspace_members_remove';
  case TermsOfServiceAccept = 'terms_of_service_accept';
  case AuditLogRead = 'audit_log_read';
  case ConversationPrivacyManage = 'conversation_privacy_manage';
  case AllResourcesAccess = 'all_resources_access';
  case CopyResourcesCrossWorkspace = 'copy_resources_cross_workspace';
  case VoiceDesign = 'voice_design';
}
