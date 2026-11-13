<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProcedureType: string
{
  case FreeForm = 'free_form';
  case Deterministic = 'deterministic';
  case Folder = 'folder';
}
