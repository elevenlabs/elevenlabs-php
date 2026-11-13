<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisItemAttachmentAction: string
{
  case Attach = 'attach';
  case Detach = 'detach';
}
