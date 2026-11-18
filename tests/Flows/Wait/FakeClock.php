<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Flows\Wait;

use ElevenLabs\Flows\Wait\PollClock;

/** Advances on sleep instead of sleeping, and records each wait. */
final class FakeClock extends PollClock
{
  /** @var list<float> */
  public array $sleeps = [];

  public function __construct(
    public float $monotonic = 100.0,
    public float $wall = 1_000_000_000.0,
    public float $randomValue = 0.0,
  ) {
  }

  public function monotonic(): float
  {
    return $this->monotonic;
  }

  public function now(): float
  {
    return $this->wall;
  }

  public function sleep(float $seconds): void
  {
    $this->sleeps[] = $seconds;
    $this->monotonic += $seconds;
    $this->wall += $seconds;
  }

  public function random(): float
  {
    return $this->randomValue;
  }
}
