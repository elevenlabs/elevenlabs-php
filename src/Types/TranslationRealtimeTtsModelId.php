<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * TTS model used to synthesize the translated speech.
 */
enum TranslationRealtimeTtsModelId: string
{
  case ElevenFlashV25 = 'eleven_flash_v2_5';
  case ElevenV3 = 'eleven_v3';
  case ElevenV4Turbo = 'eleven_v4_turbo';
}
