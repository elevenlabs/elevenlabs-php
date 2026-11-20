<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class FileInputConfigWorkflowOverrideTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "max_files_in_memory": 1,
        "max_files_per_conversation": 1
    }
    JSON;

    $instance = \ElevenLabs\Types\FileInputConfigWorkflowOverride::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
