<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum SpeechHistoryItemResponseSource: string
{
  case Tts = 'TTS';
  case Sts = 'STS';
  case Projects = 'Projects';
  case Pd = 'PD';
  case An = 'AN';
  case Dubbing = 'Dubbing';
  case PlayApi = 'PlayAPI';
  case ConvAi = 'ConvAI';
  case VoiceGeneration = 'VoiceGeneration';
  case InVpc = 'InVPC';
  case Flows = 'Flows';
  case VoicePreview = 'VoicePreview';
}
