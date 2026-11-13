<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Messages\Types;

/**
 * Whether to include transcript summaries in the response.
 */
enum TextSearchMessagesRequestSummaryMode: string
{
  case Exclude = 'exclude';
  case Include_ = 'include';
}
