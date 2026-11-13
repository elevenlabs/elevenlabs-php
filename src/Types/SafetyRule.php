<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SafetyRule: string
{
  case SexualMinors = 'sexual_minors';
  case ForgetModeration = 'forget_moderation';
  case Extremism = 'extremism';
  case ScamFraud = 'scam_fraud';
  case Political = 'political';
  case SelfHarm = 'self_harm';
  case IllegalDistributionMedical = 'illegal_distribution_medical';
  case SexualAdults = 'sexual_adults';
  case Unknown = 'unknown';
}
