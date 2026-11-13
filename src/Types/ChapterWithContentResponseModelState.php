<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The state of the chapter.
 */
enum ChapterWithContentResponseModelState: string
{
  case Default_ = 'default';
  case Converting = 'converting';
}
