<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum PermissionType: string
{
  case TextToSpeech = 'text_to_speech';
  case SpeechToSpeech = 'speech_to_speech';
  case SpeechToText = 'speech_to_text';
  case ModelsRead = 'models_read';
  case ModelsWrite = 'models_write';
  case VoicesRead = 'voices_read';
  case VoicesWrite = 'voices_write';
  case VoiceCollectionsRead = 'voice_collections_read';
  case VoiceCollectionsWrite = 'voice_collections_write';
  case SpeechHistoryRead = 'speech_history_read';
  case SpeechHistoryWrite = 'speech_history_write';
  case SoundGeneration = 'sound_generation';
  case AudioIsolation = 'audio_isolation';
  case VoiceGeneration = 'voice_generation';
  case DubbingRead = 'dubbing_read';
  case DubbingWrite = 'dubbing_write';
  case PronunciationDictionariesRead = 'pronunciation_dictionaries_read';
  case PronunciationDictionariesWrite = 'pronunciation_dictionaries_write';
  case UserRead = 'user_read';
  case UserWrite = 'user_write';
  case ProjectsRead = 'projects_read';
  case ProjectsWrite = 'projects_write';
  case AudioNativeRead = 'audio_native_read';
  case AudioNativeWrite = 'audio_native_write';
  case WorkspaceRead = 'workspace_read';
  case WorkspaceWrite = 'workspace_write';
  case ForcedAlignment = 'forced_alignment';
  case ConvaiRead = 'convai_read';
  case ConvaiWrite = 'convai_write';
  case AgentsArchitect = 'agents_architect';
  case MusicGeneration = 'music_generation';
  case ImageVideoGeneration = 'image_video_generation';
  case Flows = 'flows';
  case Templates = 'templates';
  case AddVoiceFromVoiceLibrary = 'add_voice_from_voice_library';
  case CreateInstantVoiceClone = 'create_instant_voice_clone';
  case CreateProfessionalVoiceClone = 'create_professional_voice_clone';
  case PublishVoiceToVoiceLibrary = 'publish_voice_to_voice_library';
  case ShareVoiceExternally = 'share_voice_externally';
  case CreateUserApiKey = 'create_user_api_key';
  case WorkspaceAnalyticsFullRead = 'workspace_analytics_full_read';
  case WebhooksWrite = 'webhooks_write';
  case ServiceAccountWrite = 'service_account_write';
  case GroupMembersManage = 'group_members_manage';
  case WorkspaceMembersRead = 'workspace_members_read';
  case WorkspaceMembersInvite = 'workspace_members_invite';
  case WorkspaceMembersRemove = 'workspace_members_remove';
  case TermsOfServiceAccept = 'terms_of_service_accept';
  case AuditLogRead = 'audit_log_read';
  case ConversationPrivacyManage = 'conversation_privacy_manage';
  case CopyResourcesCrossWorkspace = 'copy_resources_cross_workspace';
  case SynthidDetector = 'synthid_detector';
}
