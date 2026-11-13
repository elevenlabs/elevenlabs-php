<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum StudioClipLocatorClipType: string
{
  case Video = 'video';
  case Image = 'image';
  case ExternalAudio = 'external_audio';
  case TtsNode = 'tts_node';
}
