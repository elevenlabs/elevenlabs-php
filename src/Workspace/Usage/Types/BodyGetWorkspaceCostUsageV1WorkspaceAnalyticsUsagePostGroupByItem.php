<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Usage\Types;

enum BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePostGroupByItem: string
{
  case Model = 'model';
  case RequestSource = 'request_source';
  case FiatChargeType = 'fiat_charge_type';
  case FiatCurrency = 'fiat_currency';
  case UserId = 'user_id';
  case HashedXiApiKey = 'hashed_xi_api_key';
  case Region = 'region';
  case ReportingWorkspaceId = 'reporting_workspace_id';
  case BillingGroupId = 'billing_group_id';
  case ProductType = 'product_type';
  case Surface = 'surface';
  case Actor = 'actor';
}
