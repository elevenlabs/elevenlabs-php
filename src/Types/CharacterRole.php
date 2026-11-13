<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CharacterRole: string
{
  case Narrator = 'narrator';
  case Main = 'main';
  case Supporting = 'supporting';
  case Minor = 'minor';
}
