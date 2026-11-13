<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Secrets\Types;

enum PatchWorkspaceSecretRequestType: string
{
  case Update = 'update';
}
