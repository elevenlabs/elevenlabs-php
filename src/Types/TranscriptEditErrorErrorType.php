<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * edit_failed: the edit could not be produced.
 */
enum TranscriptEditErrorErrorType: string
{
  case EditFailed = 'edit_failed';
}
