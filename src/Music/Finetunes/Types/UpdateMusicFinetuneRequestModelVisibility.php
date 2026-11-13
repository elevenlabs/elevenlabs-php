<?php

declare(strict_types=1);

namespace ElevenLabs\Music\Finetunes\Types;

enum UpdateMusicFinetuneRequestModelVisibility: string
{
  case Private_ = 'private';
  case Workspace = 'workspace';
}
