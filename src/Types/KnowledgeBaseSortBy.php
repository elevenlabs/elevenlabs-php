<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum KnowledgeBaseSortBy: string
{
  case Name = 'name';
  case CreatedAt = 'created_at';
  case UpdatedAt = 'updated_at';
  case Size = 'size';
}
