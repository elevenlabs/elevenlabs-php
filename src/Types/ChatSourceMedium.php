<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ChatSourceMedium: string
{
  case Audio = 'audio';
  case Dtmf = 'dtmf';
  case Text = 'text';
  case Image = 'image';
  case File = 'file';
}
