<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WidgetFeedbackMode: string
{
  case None = 'none';
  case During = 'during';
  case End = 'end';
}
