<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The status of the project creation action.
 */
enum ProjectCreationMetaResponseModelStatus: string
{
  case Draft = 'draft';
  case Pending = 'pending';
  case Creating = 'creating';
  case Finished = 'finished';
  case Failed = 'failed';
}
