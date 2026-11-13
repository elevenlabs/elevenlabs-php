<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SecretDependencyType: string
{
  case ConversationInitiationWebhook = 'conversation_initiation_webhook';
}
