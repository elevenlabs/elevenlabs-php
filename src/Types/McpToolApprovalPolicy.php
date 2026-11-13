<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Defines the tool-level approval policy.
 */
enum McpToolApprovalPolicy: string
{
  case AutoApproved = 'auto_approved';
  case RequiresApproval = 'requires_approval';
}
