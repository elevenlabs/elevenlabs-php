<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum DirectPublishingReadResponseModelDisplayMode: string
{
  case Text = 'text';
  case AudioOnly = 'audio-only';
  case TextWithAudio = 'text-with-audio';
}
