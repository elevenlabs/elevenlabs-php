<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum KnowledgeBaseToolStatus: string
{
  case Success = 'success';
  case NoMatchingDocuments = 'no_matching_documents';
  case NoResults = 'no_results';
}
