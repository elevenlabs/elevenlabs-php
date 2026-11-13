<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The MIME type of the encoded media.
 */
enum InlineBase64ReferenceMimeType: string
{
  case ImageJpeg = 'image/jpeg';
  case ImagePng = 'image/png';
  case ImageWebp = 'image/webp';
  case ImageHeic = 'image/heic';
  case ImageHeif = 'image/heif';
  case AudioMpeg = 'audio/mpeg';
  case AudioWav = 'audio/wav';
  case VideoMp4 = 'video/mp4';
  case VideoQuicktime = 'video/quicktime';
  case VideoWebm = 'video/webm';
}
