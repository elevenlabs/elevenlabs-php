<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of the knowledge base
 */
enum ConversationInitiationClientDataConversationConfigOverrideAgentPromptKnowledgeBaseItemType: string
{
  case File = 'file';
  case Url = 'url';
  case Text = 'text';
  case Folder = 'folder';
}
