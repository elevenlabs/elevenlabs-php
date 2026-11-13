<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SampleConfigDbModelParentType: string
{
  case Read = 'read';
  case Collection = 'collection';
}
