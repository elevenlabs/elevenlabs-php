<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CharacterGender: string
{
  case Male = 'male';
  case Female = 'female';
  case Neutral = 'neutral';
}
