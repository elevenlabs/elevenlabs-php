<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum KnowledgeBaseRagToolStatus: string
{
  case Success = 'success';
  case NoDocuments = 'no_documents';
  case NoResults = 'no_results';
}
