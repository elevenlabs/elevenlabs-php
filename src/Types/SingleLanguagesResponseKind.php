<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Indicates this response contains single languages (not source-to-destination pairs).
 */
enum SingleLanguagesResponseKind: string
{
  case Single = 'single';
}
