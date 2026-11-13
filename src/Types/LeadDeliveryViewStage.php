<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The furthest the message got, or `failed` if sending it failed.
 */
enum LeadDeliveryViewStage: string
{
  case Queued = 'queued';
  case Sent = 'sent';
  case Delivered = 'delivered';
  case Read = 'read';
  case Replied = 'replied';
  case Failed = 'failed';
}
