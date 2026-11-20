<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ClientToolResultItemErrorType: string
{
  case UserRejected = 'user_rejected';
  case ExternalServer = 'external_server';
  case ExternalClient = 'external_client';
  case CustomerAuth = 'customer_auth';
  case ClientTimeout = 'client_timeout';
  case Unknown = 'unknown';
}
