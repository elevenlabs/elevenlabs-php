<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationSentimentAnalysisOverallLabel: string
{
  case Positive = 'positive';
  case Neutral = 'neutral';
  case Negative = 'negative';
}
