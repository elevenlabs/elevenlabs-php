<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The background of the output image. With `auto`, the model picks the background that suits the image.
 */
enum GptImage1RequestBackground: string
{
  case Transparent = 'transparent';
  case Opaque = 'opaque';
  case Auto = 'auto';
}
