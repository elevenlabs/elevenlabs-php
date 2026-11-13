<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum GetConversationResponseModelStatus: string
{
  case Initiated = 'initiated';
  case InProgress = 'in-progress';
  case Processing = 'processing';
  case Done = 'done';
  case Failed = 'failed';
}
