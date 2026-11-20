<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Regulatory standing of a number in a country that requires paperwork.
 *
 * Null for numbers that need no paperwork, such as US and Canadian numbers.
 */
enum ReceptionPhoneRegulatoryStatus: string
{
  case Held = 'held';
  case Approved = 'approved';
}
