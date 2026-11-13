<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CrawlStatus: string
{
  case Queued = 'queued';
  case Processing = 'processing';
  case Succeeded = 'succeeded';
  case Failed = 'failed';
  case Skipped = 'skipped';
  case Cancelled = 'cancelled';
}
