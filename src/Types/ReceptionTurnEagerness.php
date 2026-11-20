<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How quickly the receptionist decides the caller has finished speaking.
 */
enum ReceptionTurnEagerness: string
{
  case Patient = 'patient';
  case Normal = 'normal';
  case Eager = 'eager';
}
