<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Defines the MCP server-level approval policy for tool execution.
 */
enum McpApprovalPolicy: string
{
  case AutoApproveAll = 'auto_approve_all';
  case RequireApprovalAll = 'require_approval_all';
  case RequireApprovalPerTool = 'require_approval_per_tool';
}
