<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The trust context in which the agent operates.
 *
 * UNKNOWN: not yet classified (existing agents created before this feature).
 * LOW: serves untrusted external participants (e.g. customer support, sales) —
 *      outputs should be vetted and tool access scoped.
 * HIGH: serves the owner (e.g. personal assistant) — full tool access is appropriate.
 */
enum AgentTrustContext: string
{
  case Unknown = 'unknown';
  case Low = 'low';
  case High = 'high';
}
