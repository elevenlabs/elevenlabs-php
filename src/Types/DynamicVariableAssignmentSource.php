<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The source to extract the value from. Currently only 'response' is supported.
 */
enum DynamicVariableAssignmentSource: string
{
  case Response = 'response';
}
