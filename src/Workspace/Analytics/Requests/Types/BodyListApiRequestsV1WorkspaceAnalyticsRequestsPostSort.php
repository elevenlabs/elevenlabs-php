<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Analytics\Requests\Types;

enum BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort: string
{
  case Asc = 'asc';
  case Desc = 'desc';
}
