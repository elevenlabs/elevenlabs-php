<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Where on the page the widget sits.
 */
enum ReceptionWidgetAppearancePlacement: string
{
  case TopLeft = 'top-left';
  case Top = 'top';
  case TopRight = 'top-right';
  case BottomLeft = 'bottom-left';
  case Bottom = 'bottom';
  case BottomRight = 'bottom-right';
}
