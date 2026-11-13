<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum OpenAimcpToolRequireApproval: string
{
  case Never = 'never';
  case Always = 'always';
}
