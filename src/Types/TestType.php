<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum TestType: string
{
  case Llm = 'llm';
  case Tool = 'tool';
  case Simulation = 'simulation';
  case Folder = 'folder';
}
