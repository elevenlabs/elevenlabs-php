<?php

declare(strict_types=1);

namespace ElevenLabs\SpeechToText\Types;

enum ConvertSpeechToTextRequestNumbersFormat: string
{
  case Digits = 'digits';
  case Words = 'words';
}
