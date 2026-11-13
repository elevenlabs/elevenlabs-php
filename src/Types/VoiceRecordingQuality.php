<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum VoiceRecordingQuality: string
{
  case Studio = 'studio';
  case Good = 'good';
  case Ok = 'ok';
  case Poor = 'poor';
  case Bad = 'bad';
}
