<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * LLM model to use for custom guardrail evaluation
 */
enum CustomGuardrailConfigModel: string
{
  case Gemini25FlashLite = 'gemini-2.5-flash-lite';
  case Gemini25Flash = 'gemini-2.5-flash';
  case Gemini31FlashLite = 'gemini-3.1-flash-lite';
  case Gemini35Flash = 'gemini-3.5-flash';
  case ClaudeHaiku45 = 'claude-haiku-4-5';
  case ClaudeSonnet46 = 'claude-sonnet-4-6';
  case Gpt54Nano = 'gpt-5.4-nano';
  case Gpt54Mini = 'gpt-5.4-mini';
}
