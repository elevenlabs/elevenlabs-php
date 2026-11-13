<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentSortBy: string
{
  case Name = 'name';
  case CreatedAt = 'created_at';
  case UpdatedAt = 'updated_at';
  case CallCount7D = 'call_count_7d';
}
