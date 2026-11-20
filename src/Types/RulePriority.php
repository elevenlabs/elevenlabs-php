<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How strictly the receptionist follows a rule.
 */
enum RulePriority: string
{
  case Strict = 'strict';
  case Suggestion = 'suggestion';
}
