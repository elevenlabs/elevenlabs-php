<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The model to use for the generation.
 */
enum Gemini25FlashImageRequestModelId: string
{
  case Gemini25FlashImage = 'gemini-2.5-flash-image';
}
