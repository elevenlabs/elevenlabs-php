<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum GuardrailType: string
{
  case Custom = 'custom';
  case PromptInjection = 'prompt_injection';
  case SelfHarmIntent = 'self_harm_intent';
  case ViolenceGraphic = 'violence_graphic';
  case Sexual = 'sexual';
  case Violence = 'violence';
  case Harassment = 'harassment';
  case SexualMinors = 'sexual_minors';
  case SelfHarm = 'self_harm';
  case SelfHarmInstructions = 'self_harm_instructions';
  case HarassmentThreatening = 'harassment_threatening';
  case Hate = 'hate';
  case HateThreatening = 'hate_threatening';
  case Profanity = 'profanity';
  case ReligionOrPolitics = 'religion_or_politics';
  case MedicalAndLegal = 'medical_and_legal';
  case Guardrail = 'guardrail';
}
