<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TurnDetectionType: string
{
  case SemanticVad = 'semantic_vad';
  case ServerVad = 'server_vad';
}
