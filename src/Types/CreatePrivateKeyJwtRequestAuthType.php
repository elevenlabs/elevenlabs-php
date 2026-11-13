<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CreatePrivateKeyJwtRequestAuthType: string
{
  case PrivateKeyJwt = 'private_key_jwt';
}
