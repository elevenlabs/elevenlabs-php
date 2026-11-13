<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EvaluationResultFilter: string
{
  case Success = 'success';
  case Failure = 'failure';
  case Unknown = 'unknown';
  case Error = 'error';
}
