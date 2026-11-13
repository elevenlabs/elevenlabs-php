<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum AsyncConversationMetadataDeliveryStatus: string
{
  case Pending = 'pending';
  case Success = 'success';
  case Failed = 'failed';
}
