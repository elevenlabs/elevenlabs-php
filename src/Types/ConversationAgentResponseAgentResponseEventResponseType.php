<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationAgentResponseAgentResponseEventResponseType: string
{
  case Text = 'text';
  case Voice = 'voice';
}
