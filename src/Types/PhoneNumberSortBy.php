<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

enum PhoneNumberSortBy: string
{
  case Label = 'label';
  case PhoneNumber = 'phone_number';
}
