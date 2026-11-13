<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SystemEvaluationId: string
{
  case SystemEvalCriteriaSentiment = '__system_eval_criteria_sentiment';
  case SystemEvalCriteriaFrustration = '__system_eval_criteria_frustration';
}
