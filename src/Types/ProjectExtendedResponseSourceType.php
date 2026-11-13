<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProjectExtendedResponseSourceType: string
{
  case Blank = 'blank';
  case Book = 'book';
  case Article = 'article';
  case Genfm = 'genfm';
  case Video = 'video';
  case Screenplay = 'screenplay';
}
