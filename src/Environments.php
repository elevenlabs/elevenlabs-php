<?php

declare(strict_types=1);

namespace ElevenLabs;

/**
 * Predefined API environment URLs.
 *
 * Each case is backed by the environment's base URL, so `->value` yields the
 * URL as a string when one is required.
 */
enum Environments: string
{
  case Production = 'https://api.elevenlabs.io';
  case ProductionUs = 'https://api.us.elevenlabs.io';
  case ProductionEu = 'https://api.eu.residency.elevenlabs.io';
  case ProductionIndia = 'https://api.in.residency.elevenlabs.io';
  case ProductionSingapore = 'https://api.sg.residency.elevenlabs.io';
  case Api = 'wss://api.elevenlabs.io';
  case ProductionUs_1 = 'wss://api.us.elevenlabs.io';
  case ProductionEu_1 = 'wss://api.eu.residency.elevenlabs.io';
  case ProductionIndia_1 = 'wss://api.in.residency.elevenlabs.io';
  case ProductionSingapore_1 = 'wss://api.sg.residency.elevenlabs.io';
}
