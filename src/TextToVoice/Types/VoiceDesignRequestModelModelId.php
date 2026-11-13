<?php

declare(strict_types=1);

namespace ElevenLabs\TextToVoice\Types;

/**
 * Model to use for the voice generation. Possible values: eleven_multilingual_ttv_v2, eleven_ttv_v3.
 */
enum VoiceDesignRequestModelModelId: string
{
  case ElevenMultilingualTtvV2 = 'eleven_multilingual_ttv_v2';
  case ElevenTtvV3 = 'eleven_ttv_v3';
}
