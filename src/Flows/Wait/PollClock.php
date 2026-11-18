<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Wait;

/**
 * The time source, sleep and jitter source `createAndWait` uses between status checks.
 *
 * Exists so tests can run the wait loop without sleeping; pass a subclass to `FlowsWaiter`.
 * Applications have no reason to replace it.
 *
 * @internal
 */
class PollClock
{
  /** Seconds on a monotonic clock, for measuring the total wait. */
  public function monotonic(): float
  {
    return hrtime(true) / 1e9;
  }

  /** Seconds since the Unix epoch, for reading a `Retry-After` HTTP date. */
  public function now(): float
  {
    return microtime(true);
  }

  public function sleep(float $seconds): void
  {
    if ($seconds > 0) {
      usleep((int) round($seconds * 1e6));
    }
  }

  /** A random number in [0, 1), for the jitter added to each wait. */
  public function random(): float
  {
    return mt_rand() / (mt_getrandmax() + 1);
  }
}
