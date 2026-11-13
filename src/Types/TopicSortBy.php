<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TopicSortBy: string
{
  case Conversations = 'conversations';
  case Sentiment = 'sentiment';
  case SuccessRate = 'success_rate';
  case Frustration = 'frustration';
}
