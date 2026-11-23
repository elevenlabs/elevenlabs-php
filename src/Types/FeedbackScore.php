<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Feedback score for the referenced agent response. Null clears any previously submitted feedback for the event.
 */
enum FeedbackScore: string
{
  case Like = 'like';
  case Dislike = 'dislike';
}
