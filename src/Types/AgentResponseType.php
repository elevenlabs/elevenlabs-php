<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AgentResponseType: string
{
  case Text = 'text';
  case Voice = 'voice';
}
