<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Signalling transport for outbound SIP INVITEs.
 *
 * Values match the Agents platform ``SIPTrunkTransportEnum`` so the SMB adapter
 * maps by value. ``AUTO`` is omitted: the Agents UI hides it too, since it can
 * pick UDP, which is known to misbehave (CAI-299). Reception defaults to TLS.
 */
enum SmbSipTransport: string
{
  case Udp = 'udp';
  case Tcp = 'tcp';
  case Tls = 'tls';
}
