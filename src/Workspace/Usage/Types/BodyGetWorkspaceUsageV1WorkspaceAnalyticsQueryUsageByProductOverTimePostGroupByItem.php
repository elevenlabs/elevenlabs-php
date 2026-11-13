<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Usage\Types;

enum BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePostGroupByItem: string
{
  case ProductType = 'product_type';
  case Model = 'model';
  case VoiceId = 'voice_id';
  case UserId = 'user_id';
  case FiatCurrency = 'fiat_currency';
  case FiatChargeType = 'fiat_charge_type';
  case Region = 'region';
  case ReportingWorkspaceId = 'reporting_workspace_id';
  case RequestSource = 'request_source';
  case ResourceId = 'resource_id';
  case SubresourceId = 'subresource_id';
  case RequestQueueType = 'request_queue_type';
  case VoiceMultiplier = 'voice_multiplier';
  case HashedXiApiKey = 'hashed_xi_api_key';
  case BillingGroupId = 'billing_group_id';
  case Surface = 'surface';
  case Actor = 'actor';
}
