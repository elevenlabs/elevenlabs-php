<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The state of the project.
 */
enum ProjectState: string
{
  case Creating = 'creating';
  case Default_ = 'default';
  case Converting = 'converting';
  case InQueue = 'in_queue';
}
