<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Types;

/**
 * The granularity of the timestamps in the transcription. 'word' provides word-level timestamps and 'character' provides character-level timestamps per word.
 */
enum ConvertSpeechToTextRequestTimestampsGranularity: string
{
  case None = 'none';
  case Word = 'word';
  case Character = 'character';
}
