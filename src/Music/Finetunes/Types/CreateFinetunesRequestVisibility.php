<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Types;

enum CreateFinetunesRequestVisibility: string
{
  case Private_ = 'private';
  case Workspace = 'workspace';
}
