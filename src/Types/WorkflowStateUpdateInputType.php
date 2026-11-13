<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WorkflowStateUpdateInputType: string
{
  case DynamicVariable = 'dynamic_variable';
}
