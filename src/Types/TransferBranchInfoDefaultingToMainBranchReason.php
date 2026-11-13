<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TransferBranchInfoDefaultingToMainBranchReason: string
{
  case DefaultingToMain = 'defaulting_to_main';
}
