<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Separator for scopes
 */
enum ApiIntegrationOAuth2CustomAppResponseScopeSeparator: string
{
  case Space = ' ';
  case Comma = ',';
}
