<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Where a run, or one of its outputs, is in its lifecycle. The run's is rolled
 * up from its outputs' (``aggregate_output_statuses``). A class rather than a
 * ``Literal`` so it publishes as one named enum instead of being inlined into
 * every kind.
 */
enum TemplateRunStatus: string
{
  case Pending = 'pending';
  case Generating = 'generating';
  case Completed = 'completed';
  case Failed = 'failed';
}
