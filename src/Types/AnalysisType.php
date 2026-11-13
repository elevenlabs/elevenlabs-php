<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AnalysisType: string
{
  case EvaluationCriteria = 'evaluation_criteria';
  case DataCollection = 'data_collection';
}
