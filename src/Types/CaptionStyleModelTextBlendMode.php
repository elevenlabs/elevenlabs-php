<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CaptionStyleModelTextBlendMode: string
{
  case Normal = 'normal';
  case Difference = 'difference';
  case Multiply = 'multiply';
}
