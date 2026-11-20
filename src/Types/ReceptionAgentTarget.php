<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ReceptionAgentTarget: string
{
  case CustomerFacing = 'customer_facing';
  case Assistant = 'assistant';
}
