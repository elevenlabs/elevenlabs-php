<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Answer shape for a per-item intake question.
 */
enum IntakeQuestionKind: string
{
  case Text = 'text';
  case Number = 'number';
  case Choice = 'choice';
}
