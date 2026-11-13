<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum EmbeddingModelEnum: string
{
  case E5Mistral7BInstruct = 'e5_mistral_7b_instruct';
  case MultilingualE5LargeInstruct = 'multilingual_e5_large_instruct';
}
