<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Canonical representation of a knowledge base document's stored content.
 *
 * HTML is the legacy default; documents created before this field existed are
 * interpreted as HTML.
 */
enum ContentFormat: string
{
  case Html = 'html';
  case Markdown = 'markdown';
}
