<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum FileInputMimeType: string
{
  case ImagePng = 'image/png';
  case ImageJpeg = 'image/jpeg';
  case ImageGif = 'image/gif';
  case ImageWebp = 'image/webp';
  case ApplicationPdf = 'application/pdf';
  case TextPlain = 'text/plain';
}
