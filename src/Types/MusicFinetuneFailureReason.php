<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum MusicFinetuneFailureReason: string
{
  case AudioProcessingFailed = 'audio_processing_failed';
  case CopyrightViolation = 'copyright_violation';
  case TrainingFailed = 'training_failed';
}
