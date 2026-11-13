<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisItemKind: string
{
  case Evaluation = 'evaluation';
  case DataCollection = 'data_collection';
}
