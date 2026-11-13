<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * The type of order item.
 */
enum DubOrderItemRequestKind: string
{
  case Dub = 'dub';
}
