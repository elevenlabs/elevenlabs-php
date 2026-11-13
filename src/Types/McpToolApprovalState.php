<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Whether a discovered MCP tool has an approval and whether it still matches.
 */
enum McpToolApprovalState: string
{
  case UpToDate = 'up_to_date';
  case NeedsReview = 'needs_review';
  case NotApproved = 'not_approved';
}
