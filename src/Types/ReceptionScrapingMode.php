<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReceptionScrapingMode: string
{
  case SinglePage = 'single_page';
  case DeepScan = 'deep_scan';
  case QuickScan = 'quick_scan';
}
