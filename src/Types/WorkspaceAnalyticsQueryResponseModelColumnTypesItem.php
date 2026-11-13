<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WorkspaceAnalyticsQueryResponseModelColumnTypesItem: string
{
  case String = 'String';
  case Float = 'Float';
  case DateTime = 'DateTime';
  case Int = 'Int';
  case Bool = 'Bool';
  case Json = 'JSON';
  case Map = 'Map';
  case Array = 'Array';
}
