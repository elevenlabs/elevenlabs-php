<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of the word or sound. 'audio_event' is used for non-word sounds like laughter or footsteps.
 */
enum SpeechToTextWordResponseModelType: string
{
  case Word = 'word';
  case Spacing = 'spacing';
  case AudioEvent = 'audio_event';
}
