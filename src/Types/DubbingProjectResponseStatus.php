<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Lifecycle status of the project: `queued` before the source is picked up, `preparing` while it is transcribed, `ready` once transcription is done and language targets can start, or `failed`. A project is never reported as `processing` — that value belongs to language targets.
 */
enum DubbingProjectResponseStatus: string
{
  case Queued = 'queued';
  case Preparing = 'preparing';
  case Processing = 'processing';
  case Ready = 'ready';
  case Failed = 'failed';
}
