<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum RagIndexStatus: string
{
  case New_ = 'new';
  case Created = 'created';
  case Processing = 'processing';
  case Failed = 'failed';
  case Succeeded = 'succeeded';
  case RagLimitExceeded = 'rag_limit_exceeded';
  case DocumentTooSmall = 'document_too_small';
  case CannotIndexFolder = 'cannot_index_folder';
}
