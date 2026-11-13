<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The lifecycle status of the generation.
 */
enum MediaGenerationFailedResponseStatus: string
{
  case Failed = 'failed';
}
