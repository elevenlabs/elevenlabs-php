<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Carrier-level AMD verdict reported by Twilio via `AnsweredBy`.
 */
enum TwilioAnsweredBy: string
{
  case Human = 'human';
  case Fax = 'fax';
  case Unknown = 'unknown';
  case MachineStart = 'machine_start';
  case MachineEndBeep = 'machine_end_beep';
  case MachineEndSilence = 'machine_end_silence';
  case MachineEndOther = 'machine_end_other';
}
