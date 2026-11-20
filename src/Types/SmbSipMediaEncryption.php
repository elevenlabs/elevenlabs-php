<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Media (SRTP) encryption policy for a SIP trunk.
 *
 * Values match the Agents platform ``SIPMediaEncryptionEnum`` so the SMB
 * adapter maps by value.
 */
enum SmbSipMediaEncryption: string
{
  case Disabled = 'disabled';
  case Allowed = 'allowed';
  case Required = 'required';
}
