<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of order item.
 */
enum TranscriptionOrderItemRequestKind: string
{
  case Transcription = 'transcription';
}
