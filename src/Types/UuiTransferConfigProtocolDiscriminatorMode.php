<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How to attach protocol_discriminator. 'prefix' prepends the octet to the hex payload (User-to-User=XX<hex>;encoding=hex). 'pd_parameter' sends it as a separate parameter (User-to-User=<hex>;pd=XX;encoding=hex). Ignored when protocol_discriminator is unset.
 */
enum UuiTransferConfigProtocolDiscriminatorMode: string
{
  case Prefix = 'prefix';
  case PdParameter = 'pd_parameter';
}
