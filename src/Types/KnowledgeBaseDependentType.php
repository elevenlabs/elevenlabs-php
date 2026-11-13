<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum KnowledgeBaseDependentType: string
{
  case Direct = 'direct';
  case Transitive = 'transitive';
  case All = 'all';
}
