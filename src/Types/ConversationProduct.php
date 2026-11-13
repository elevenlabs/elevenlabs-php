<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Which product surface owns this agent document.
 */
enum ConversationProduct: string
{
  case Agents = 'agents';
  case SpeechEngine = 'speech_engine';
}
