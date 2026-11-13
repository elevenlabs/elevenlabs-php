<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How eagerly translation starts while the speaker is still talking. 'high' starts translating soonest for the lowest latency. 'low' waits for more of the sentence, giving higher quality translations with more delay.
 */
enum TranslationRealtimeEagerness: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
}
