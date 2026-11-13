<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TemplateAudioOutputFailureReason: string
{
  case Timeout = 'timeout';
  case ModelError = 'model_error';
  case Moderated = 'moderated';
  case InvalidParameters = 'invalid_parameters';
  case DependencyFailed = 'dependency_failed';
  case ChargingFailed = 'charging_failed';
  case InternalError = 'internal_error';
}
