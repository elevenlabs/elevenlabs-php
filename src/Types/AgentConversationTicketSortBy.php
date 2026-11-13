<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentConversationTicketSortBy: string
{
  case CreatedAt = 'created_at';
  case Priority = 'priority';
  case LastReported = 'last_reported';
}
