<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SecretDependencyResourceType: string
{
  case Tools = 'tools';
  case Agents = 'agents';
  case PhoneNumbers = 'phone_numbers';
}
