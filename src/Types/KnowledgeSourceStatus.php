<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Processing status for knowledge sources.
 *
 * - `processing`: the file or site is being read.
 * - `ready`: done; the results are available.
 * - `error`: it failed and can be retried.
 *
 * See `progress` for detail.
 */
enum KnowledgeSourceStatus: string
{
  case Processing = 'processing';
  case Ready = 'ready';
  case Error = 'error';
}
