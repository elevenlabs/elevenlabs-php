<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Messages\Types;

enum TextSearchMessagesRequestExcludeStatusesItem: string
{
  case Initiated = 'initiated';
  case InProgress = 'in-progress';
  case Processing = 'processing';
  case Done = 'done';
  case Failed = 'failed';
}
