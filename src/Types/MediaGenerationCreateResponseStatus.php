<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * A newly created generation is always `pending`.
 */
enum MediaGenerationCreateResponseStatus: string
{
  case Pending = 'pending';
}
