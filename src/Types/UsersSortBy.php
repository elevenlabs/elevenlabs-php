<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UsersSortBy: string
{
  case LastContactUnixSecs = 'last_contact_unix_secs';
  case ConversationCount = 'conversation_count';
  case AverageSentimentScore = 'average_sentiment_score';
}
