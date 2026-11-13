<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ZendeskPlatformMetadataConversationInitiationSource: string
{
  case ZendeskIntegration = 'zendesk_integration';
}
