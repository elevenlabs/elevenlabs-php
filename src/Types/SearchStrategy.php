<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SearchStrategy: string
{
  case Cat = 'cat';
  case Keyword = 'keyword';
  case Semantic = 'semantic';
  case Ls = 'ls';
}
