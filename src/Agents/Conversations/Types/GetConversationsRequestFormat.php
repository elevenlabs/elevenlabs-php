<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Types;

/**
 * Response format. Defaults to 'json'. Set to 'opentelemetry' for an OTLP-compatible trace payload using the same structure as the post-call webhook.
 */
enum GetConversationsRequestFormat: string
{
  case Json = 'json';
  case Opentelemetry = 'opentelemetry';
}
