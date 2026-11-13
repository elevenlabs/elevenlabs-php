<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Types;

enum ListConversationsRequestExcludeStatusesItem: string
{
  case Initiated = 'initiated';
  case InProgress = 'in-progress';
  case Processing = 'processing';
  case Done = 'done';
  case Failed = 'failed';
}
