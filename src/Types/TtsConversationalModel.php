<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TtsConversationalModel: string
{
  case ElevenTurboV2 = 'eleven_turbo_v2';
  case ElevenTurboV25 = 'eleven_turbo_v2_5';
  case ElevenFlashV2 = 'eleven_flash_v2';
  case ElevenFlashV25 = 'eleven_flash_v2_5';
  case ElevenMultilingualV2 = 'eleven_multilingual_v2';
  case ElevenV3Conversational = 'eleven_v3_conversational';
  case ElevenV4 = 'eleven_v4';
  case ElevenV4Turbo = 'eleven_v4_turbo';
}
