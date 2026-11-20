<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether to wait for the reply, or keep going and get it later in the conversation.
 */
enum SubAgentOutputExecutionMode: string
{
  case Immediate = 'immediate';
  case Async = 'async';
}
