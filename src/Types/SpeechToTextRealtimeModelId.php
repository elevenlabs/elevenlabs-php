<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The ID of the model to use for speech-to-text transcription.
 */
enum SpeechToTextRealtimeModelId: string
{
  case ScribeV2Realtime = 'scribe_v2_realtime';
  case ScribeV3Live = 'scribe_v3_live';
}
