<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class WorkflowToolMaxIterationsExceededStepModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "step_latency_secs": 1,
        "type": "max_iterations_exceeded",
        "max_iterations": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\WorkflowToolMaxIterationsExceededStepModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
