<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum ConversationTokenPurpose: string
{
  case SignedUrl = 'signed_url';
  case ShareableLink = 'shareable_link';
}
