<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Match any guardrail triggered by the generated turn.
 */
enum UnitTestGuardrailTriggerEvaluationModelType: string
{
  case Any = 'any';
}
