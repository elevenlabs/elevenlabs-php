<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Buckets that make up the non-LLM ``platform_charge`` of a conversation.
 */
enum PlatformCategory: string
{
  case Voice = 'voice';
  case Silence = 'silence';
  case Burst = 'burst';
  case Asr = 'asr';
  case TextMessage = 'text_message';
  case Reception = 'reception';
  case V3Addon = 'v3_addon';
  case V4Addon = 'v4_addon';
  case RagAddon = 'rag_addon';
  case Other = 'other';
}
