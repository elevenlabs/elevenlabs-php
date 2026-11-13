<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SingleUseTokenType: string
{
  case RealtimeScribe = 'realtime_scribe';
  case BatchScribe = 'batch_scribe';
  case TtsWebsocket = 'tts_websocket';
}
