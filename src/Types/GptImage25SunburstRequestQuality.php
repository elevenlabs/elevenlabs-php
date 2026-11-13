<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The quality of the output image.
 */
enum GptImage25SunburstRequestQuality: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
  case Xhigh = 'xhigh';
  case Max = 'max';
}
