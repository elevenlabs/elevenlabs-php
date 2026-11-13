<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ToolSortBy: string
{
  case Name = 'name';
  case CreatedAt = 'created_at';
}
