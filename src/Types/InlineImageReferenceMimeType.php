<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The MIME type of the encoded image.
 */
enum InlineImageReferenceMimeType: string
{
  case ImageJpeg = 'image/jpeg';
  case ImagePng = 'image/png';
  case ImageWebp = 'image/webp';
  case ImageHeic = 'image/heic';
  case ImageHeif = 'image/heif';
}
