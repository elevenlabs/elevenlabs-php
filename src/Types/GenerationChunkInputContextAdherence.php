<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How much the model adheres to the context of its surrounding chunks. Low adherence means the model can deviate from the context and be more creative. High adherence means the model will be more consistent with the context.
 */
enum GenerationChunkInputContextAdherence: string
{
  case Low = 'low';
  case Medium = 'medium';
  case High = 'high';
}
