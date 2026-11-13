<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum CaptionStyleSectionAnimationModelExitType: string
{
  case None = 'none';
  case Fade = 'fade';
  case Scale = 'scale';
  case Pop = 'pop';
  case SlideUp = 'slide_up';
  case SlideDown = 'slide_down';
  case Slam = 'slam';
  case ScaleDown = 'scale_down';
  case SlideIn = 'slide_in';
}
