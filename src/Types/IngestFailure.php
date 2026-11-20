<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Why processing a knowledge source failed.
 */
enum IngestFailure: string
{
  case BlockedUrl = 'blocked_url';
  case DnsFailure = 'dns_failure';
  case HostUnreachable = 'host_unreachable';
  case AccessRefused = 'access_refused';
  case CrawlTimeout = 'crawl_timeout';
  case NoPages = 'no_pages';
  case NoContent = 'no_content';
  case UpstreamTimeout = 'upstream_timeout';
  case UpstreamError = 'upstream_error';
  case Unknown = 'unknown';
}
