<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How eagerly translation starts while the speaker is still talking. 'high' starts translating soonest, so subtitles appear sooner. 'low' waits for more of the sentence, giving higher quality translations with more delay.
 */
enum SubtitlingRealtimeEagerness: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
}
