<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ClipAnimationExitEffect: string
{
  case None = 'none';
  case Fade = 'fade';
  case Float = 'float';
  case GentleFloat = 'gentle_float';
  case ZoomIn = 'zoom_in';
  case Drop = 'drop';
  case SlideLeft = 'slide_left';
  case SlideRight = 'slide_right';
  case SlideUp = 'slide_up';
  case SlideDown = 'slide_down';
  case Pop = 'pop';
  case Bounce = 'bounce';
  case Spin = 'spin';
  case SlideBounce = 'slide_bounce';
}
