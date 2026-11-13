<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Request-time processing tier for a model.
 *
 * STANDARD: default price and throughput.
 * FAST: pays a per-token price premium for higher throughput / lower latency.
 *     See OpenAI's fast mode: https://openai.com/api-fast-mode/
 */
enum LlmServiceTier: string
{
  case Standard = 'standard';
  case Fast = 'fast';
}
