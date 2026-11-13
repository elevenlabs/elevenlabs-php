<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Controls how tool responses are filtered before being visible to the agent.
 */
enum ResponseFilterMode: string
{
  case All = 'all';
  case Allow = 'allow';
  case HideAll = 'hide_all';
}
