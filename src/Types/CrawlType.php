<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CrawlType: string
{
  case Discovery = 'discovery';
  case Sitemap = 'sitemap';
}
