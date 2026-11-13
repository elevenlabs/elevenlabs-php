<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Method for converting numbers to words before sending to TTS
 */
enum TextNormalisationType: string
{
  case SystemPrompt = 'system_prompt';
  case Elevenlabs = 'elevenlabs';
}
