<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationFeedbackType: string
{
  case Thumbs = 'thumbs';
  case Rating = 'rating';
}
