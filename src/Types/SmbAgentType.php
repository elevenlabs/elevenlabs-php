<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SmbAgentType: string
{
  case CustomerFacing = 'customer_facing';
  case Assistant = 'assistant';
}
