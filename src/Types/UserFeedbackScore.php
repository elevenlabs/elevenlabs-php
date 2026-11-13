<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum UserFeedbackScore: string
{
  case Like = 'like';
  case Dislike = 'dislike';
}
