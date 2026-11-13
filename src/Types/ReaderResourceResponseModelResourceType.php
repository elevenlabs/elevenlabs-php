<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of resource.
 */
enum ReaderResourceResponseModelResourceType: string
{
  case Read = 'read';
  case Collection = 'collection';
}
