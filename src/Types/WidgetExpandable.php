<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WidgetExpandable: string
{
  case Never = 'never';
  case Mobile = 'mobile';
  case Desktop = 'desktop';
  case Always = 'always';
}
