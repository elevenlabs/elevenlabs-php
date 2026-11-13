<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ChapterContentBlockInputModelSubType: string
{
  case P = 'p';
  case H1 = 'h1';
  case H2 = 'h2';
  case H3 = 'h3';
}
