<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Single-word processing step shown in the UI status badge.
 */
enum ProcessingProgress: string
{
  case Converting = 'Converting';
  case Storing = 'Storing';
  case Scraping = 'Scraping';
  case Crawling = 'Crawling';
  case Extracting = 'Extracting';
}
