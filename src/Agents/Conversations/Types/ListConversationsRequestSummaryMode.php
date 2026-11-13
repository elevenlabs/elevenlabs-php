<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Types;

/**
 * Whether to include transcript summaries in the response.
 */
enum ListConversationsRequestSummaryMode: string
{
  case Exclude = 'exclude';
  case Include_ = 'include';
}
