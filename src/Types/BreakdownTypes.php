<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * How to break down the information. Cannot be "user" or "api_key" if include_workspace_metrics is False.
 */
enum BreakdownTypes: string
{
  case None = 'none';
  case Voice = 'voice';
  case VoiceMultiplier = 'voice_multiplier';
  case User = 'user';
  case Groups = 'groups';
  case ApiKeys = 'api_keys';
  case AllApiKeys = 'all_api_keys';
  case ProductType = 'product_type';
  case Model = 'model';
  case Resource = 'resource';
  case RequestQueue = 'request_queue';
  case Region = 'region';
  case SubresourceId = 'subresource_id';
  case ReportingWorkspaceId = 'reporting_workspace_id';
  case HasApiKey = 'has_api_key';
  case RequestSource = 'request_source';
}
