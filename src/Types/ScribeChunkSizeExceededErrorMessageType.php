<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ScribeChunkSizeExceededErrorMessageType: string
{
  case ChunkSizeExceeded = 'chunk_size_exceeded';
}
