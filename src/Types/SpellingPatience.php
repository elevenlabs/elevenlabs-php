<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Controls if the agent should be more patient when user is spelling numbers and named entities.
 */
enum SpellingPatience: string
{
  case Auto = 'auto';
  case Off = 'off';
}
