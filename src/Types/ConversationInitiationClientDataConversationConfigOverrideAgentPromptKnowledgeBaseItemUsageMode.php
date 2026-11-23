<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The usage mode of the knowledge base
 */
enum ConversationInitiationClientDataConversationConfigOverrideAgentPromptKnowledgeBaseItemUsageMode: string
{
  case Prompt = 'prompt';
  case Auto = 'auto';
}
