<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Projects\Types;

enum CreateProjectsRequestFiction: string
{
  case Fiction = 'fiction';
  case NonFiction = 'non-fiction';
}
