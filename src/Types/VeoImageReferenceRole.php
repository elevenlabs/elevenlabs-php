<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How the model uses the image: `subject` places its subject or scene elements into the video; `style` transfers its visual style.
 */
enum VeoImageReferenceRole: string
{
  case Subject = 'subject';
  case Style = 'style';
}
