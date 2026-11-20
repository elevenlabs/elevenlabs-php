<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum WebhookOutcome: string
{
  case Delivered = 'delivered';
  case FailedRetryScheduled = 'failed_retry_scheduled';
  case FailedExhausted = 'failed_exhausted';
  case FailedNoRetry = 'failed_no_retry';
  case FailedRetryError = 'failed_retry_error';
  case DroppedQueueFull = 'dropped_queue_full';
  case DroppedPayloadTooLarge = 'dropped_payload_too_large';
  case SkippedDisabled = 'skipped_disabled';
  case NotSentConfiguration = 'not_sent_configuration';
}
