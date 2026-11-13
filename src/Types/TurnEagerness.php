<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Agent's eagerness to respond. Higher values make agent wait for higher turn probability.
 */
enum TurnEagerness: string
{
  case Patient = 'patient';
  case Normal = 'normal';
  case Eager = 'eager';
}
