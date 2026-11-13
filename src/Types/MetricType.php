<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MetricType: string
{
  case Credits = 'credits';
  case TtsCharacters = 'tts_characters';
  case MinutesUsed = 'minutes_used';
  case RequestCount = 'request_count';
  case TtfbAvg = 'ttfb_avg';
  case TtfbP95 = 'ttfb_p95';
  case FiatUnitsSpent = 'fiat_units_spent';
  case Concurrency = 'concurrency';
  case ConcurrencyAverage = 'concurrency_average';
}
