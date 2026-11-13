<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ProjectCreationMetaType: string
{
  case Blank = 'blank';
  case GeneratePodcast = 'generate_podcast';
  case AutoAssignVoices = 'auto_assign_voices';
  case DubVideo = 'dub_video';
  case ImportSpeech = 'import_speech';
}
