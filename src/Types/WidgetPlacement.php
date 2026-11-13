<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WidgetPlacement: string
{
  case TopLeft = 'top-left';
  case Top = 'top';
  case TopRight = 'top-right';
  case BottomLeft = 'bottom-left';
  case Bottom = 'bottom';
  case BottomRight = 'bottom-right';
}
