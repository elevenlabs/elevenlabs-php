<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Current state of the project
 */
enum AudioNativeProjectSettingsResponseModelStatus: string
{
  case Processing = 'processing';
  case Ready = 'ready';
}
