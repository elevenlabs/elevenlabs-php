<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The kind of output: the `type` of the port's `content_schema`.
 */
enum TemplateNumberOutputType: string
{
  case Number = 'number';
}
