<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Which kind of regulated number a request or an issued number is for.
 */
enum ApplicationNumberType: string
{
  case Local = 'local';
  case Mobile = 'mobile';
}
