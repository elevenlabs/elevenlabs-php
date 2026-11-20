<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * What a service books.
 *
 * - `classic`: a staff-delivered service (haircut, consultation, massage, ...).
 * - `rental`: an asset reservation (court, room, equipment).
 * - `group`: seats in a multi-participant session (class, workshop, tour).
 */
enum ReceptionServiceKind: string
{
  case Classic = 'classic';
  case Rental = 'rental';
  case Group = 'group';
}
