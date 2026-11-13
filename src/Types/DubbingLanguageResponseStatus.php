<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Lifecycle status: `queued` (waiting on the project to be ready, or on a worker), `processing` while it is being dubbed, `completed` once its output is available, `stale` when the transcript changed after the output was produced, or `failed`.
 */
enum DubbingLanguageResponseStatus: string
{
  case Queued = 'queued';
  case Processing = 'processing';
  case Completed = 'completed';
  case Stale = 'stale';
  case Failed = 'failed';
}
