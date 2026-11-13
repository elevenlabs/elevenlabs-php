<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Predefined background sound preset identifiers.
 */
enum BackgroundSoundPresetId: string
{
  case Office2 = 'office2';
  case Office1 = 'office1';
  case Restaurant = 'restaurant';
  case City = 'city';
  case Typing = 'typing';
  case Elevator1 = 'elevator1';
  case Elevator2 = 'elevator2';
  case Elevator3 = 'elevator3';
  case Elevator4 = 'elevator4';
}
