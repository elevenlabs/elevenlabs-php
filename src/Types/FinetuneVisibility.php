<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum FinetuneVisibility: string
{
  case Private_ = 'private';
  case Workspace = 'workspace';
  case Public_ = 'public';
}
