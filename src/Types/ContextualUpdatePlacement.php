<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Where the LLM view renders a contextual update.
 */
enum ContextualUpdatePlacement: string
{
  case InPlace = 'in_place';
  case End = 'end';
}
