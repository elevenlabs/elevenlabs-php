<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Type of knowledge source.
 */
enum KnowledgeSourceType: string
{
  case File = 'file';
  case Url = 'url';
}
