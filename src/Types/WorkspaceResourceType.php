<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Resource types that can be shared in the workspace. The name always need to match the collection names
 */
enum WorkspaceResourceType: string
{
  case Voice = 'voice';
  case VoiceCollection = 'voice_collection';
  case PronunciationDictionary = 'pronunciation_dictionary';
  case Dubbing = 'dubbing';
  case DubbingProject = 'dubbing_project';
  case Project = 'project';
  case ConvaiAgents = 'convai_agents';
  case ConvaiKnowledgeBaseDocuments = 'convai_knowledge_base_documents';
  case ConvaiTools = 'convai_tools';
  case ConvaiSettings = 'convai_settings';
  case ConvaiSecrets = 'convai_secrets';
  case WorkspaceAuthConnections = 'workspace_auth_connections';
  case ConvaiPhoneNumbers = 'convai_phone_numbers';
  case ConvaiMcpServers = 'convai_mcp_servers';
  case ConvaiApiIntegrationConnections = 'convai_api_integration_connections';
  case ConvaiApiIntegrationTriggerConnections = 'convai_api_integration_trigger_connections';
  case ConvaiBatchCalls = 'convai_batch_calls';
  case ConvaiAgentResponseTests = 'convai_agent_response_tests';
  case ConvaiTestSuiteInvocations = 'convai_test_suite_invocations';
  case ConvaiCrawlJobs = 'convai_crawl_jobs';
  case ConvaiCrawlTasks = 'convai_crawl_tasks';
  case ConvaiKbExternalSyncJobs = 'convai_kb_external_sync_jobs';
  case ConvaiWhatsappAccounts = 'convai_whatsapp_accounts';
  case ConvaiAgentVersions = 'convai_agent_versions';
  case ConvaiAgentBranches = 'convai_agent_branches';
  case ConvaiAgentVersionsDeployments = 'convai_agent_versions_deployments';
  case ConvaiAgentExperiments = 'convai_agent_experiments';
  case ConvaiMemoryEntries = 'convai_memory_entries';
  case ConvaiTemplates = 'convai_templates';
  case Dashboard = 'dashboard';
  case DashboardConfiguration = 'dashboard_configuration';
  case ConvaiAgentDrafts = 'convai_agent_drafts';
  case ResourceLocators = 'resource_locators';
  case Assets = 'assets';
  case ContentGenerations = 'content_generations';
  case ContentTemplates = 'content_templates';
  case ContentSkills = 'content_skills';
  case Songs = 'songs';
  case TranscriptionTasks = 'transcription_tasks';
  case Avatars = 'avatars';
  case AvatarVideoGenerations = 'avatar_video_generations';
  case ResourceCollection = 'resource_collection';
  case StudioProjects = 'studio_projects';
  case ConvaiAnalysisItems = 'convai_analysis_items';
}
