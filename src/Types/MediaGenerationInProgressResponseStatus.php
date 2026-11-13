<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The lifecycle status of the generation. It ends at `completed` or `failed`.
 */
enum MediaGenerationInProgressResponseStatus: string
{
  case Pending = 'pending';
  case Generating = 'generating';
}
