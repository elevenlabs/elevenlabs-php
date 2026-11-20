<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Where a classic service is delivered.
 */
enum ServiceLocationType: string
{
  case Business = 'business';
  case Customer = 'customer';
}
