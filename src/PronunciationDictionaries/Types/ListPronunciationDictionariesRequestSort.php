<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Types;

enum ListPronunciationDictionariesRequestSort: string
{
  case CreationTimeUnix = 'creation_time_unix';
  case Name = 'name';
}
