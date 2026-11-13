<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum KnowledgeBaseDocumentType: string
{
  case File = 'file';
  case Url = 'url';
  case Text = 'text';
  case Folder = 'folder';
}
