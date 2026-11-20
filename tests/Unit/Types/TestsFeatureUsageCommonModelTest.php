<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class TestsFeatureUsageCommonModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "enabled": true,
        "tests_ran_after_last_modification": true,
        "tests_ran_in_last_7_days": true
    }
    JSON;

    $instance = \ElevenLabs\Types\TestsFeatureUsageCommonModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
