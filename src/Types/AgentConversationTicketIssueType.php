<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentConversationTicketIssueType: string
{
  case KnowledgeGap = 'knowledge_gap';
  case IncorrectInformation = 'incorrect_information';
  case DocumentationGap = 'documentation_gap';
  case ProductFeedback = 'product_feedback';
  case PlatformBug = 'platform_bug';
  case ToolIssue = 'tool_issue';
  case MissingTool = 'missing_tool';
  case UnnecessaryEscalation = 'unnecessary_escalation';
  case WrongAction = 'wrong_action';
}
