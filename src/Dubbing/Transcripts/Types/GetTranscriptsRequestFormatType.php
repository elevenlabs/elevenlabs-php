<?php

declare(strict_types=1);

namespace ElevenLabs\Dubbing\Transcripts\Types;

/**
 * Format to return transcript in. For subtitles use either 'srt' or 'webvtt', and for a full transcript use 'json'. The 'json' format is not yet supported for Dubbing Studio.
 */
enum GetTranscriptsRequestFormatType: string
{
  case Srt = 'srt';
  case Webvtt = 'webvtt';
  case Json = 'json';
}
