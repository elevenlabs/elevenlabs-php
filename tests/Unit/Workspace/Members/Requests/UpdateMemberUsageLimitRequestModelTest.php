<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Members\Requests;

use PHPUnit\Framework\TestCase;

class UpdateMemberUsageLimitRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "usage_limit": 0
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Members\Requests\UpdateMemberUsageLimitRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
