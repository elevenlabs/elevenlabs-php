<?php

declare(strict_types=1);

namespace ElevenLabs\Studio\Types;

/**
 * Duration of the generated podcast. Must be one of:
 * short - produces podcasts shorter than 3 minutes.
 * default - produces podcasts roughly between 3-7 minutes.
 * long - produces podcasts longer than 7 minutes.
 *
 */
enum BodyCreatePodcastV1StudioPodcastsPostDurationScale: string
{
  case Short = 'short';
  case Default_ = 'default';
  case Long = 'long';
}
