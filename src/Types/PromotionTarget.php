<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * What a promotion discounts: the service price or add-on prices.
 */
enum PromotionTarget: string
{
  case Service = 'service';
  case AddOn = 'add_on';
}
