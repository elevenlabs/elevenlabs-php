<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The model to use for the generation.
 */
enum GptImage2RequestModelId: string
{
  case GptImage2 = 'gpt-image-2';
}
