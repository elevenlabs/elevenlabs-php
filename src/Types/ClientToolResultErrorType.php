<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Optional category for the failure reason. When set, `is_error` is treated as true. `user_rejected` is special-cased to mark the tool as not having been called.
 */
enum ClientToolResultErrorType: string
{
  case UserRejected = 'user_rejected';
  case ExternalServer = 'external_server';
  case ExternalClient = 'external_client';
  case CustomerAuth = 'customer_auth';
  case ClientTimeout = 'client_timeout';
  case Unknown = 'unknown';
}
