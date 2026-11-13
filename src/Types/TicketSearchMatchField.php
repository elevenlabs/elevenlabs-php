<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TicketSearchMatchField: string
{
  case Title = 'title';
  case Description = 'description';
  case Comment = 'comment';
  case TurnComment = 'turn_comment';
}
