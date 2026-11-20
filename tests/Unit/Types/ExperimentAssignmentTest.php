<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ExperimentAssignmentTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "key": "test-value",
        "variant": "test-value",
        "source": "server_branch",
        "experiment_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ExperimentAssignment::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
