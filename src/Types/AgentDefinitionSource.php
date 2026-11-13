<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentDefinitionSource: string
{
  case Cli = 'cli';
  case Ui = 'ui';
  case Api = 'api';
  case Template = 'template';
  case Architect = 'architect';
  case Mcp = 'mcp';
  case Unknown = 'unknown';
}
