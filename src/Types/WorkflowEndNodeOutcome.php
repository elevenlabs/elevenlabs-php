<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether reaching an End node completes successfully or fails.
 */
enum WorkflowEndNodeOutcome: string
{
  case Success = 'success';
  case Failure = 'failure';
}
