<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Indicates this response contains source-to-destination language pairs.
 */
enum PairedLanguagesResponseKind: string
{
  case Pair = 'pair';
}
