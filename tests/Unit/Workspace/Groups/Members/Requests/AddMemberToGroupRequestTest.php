<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Workspace\Groups\Members\Requests;

use PHPUnit\Framework\TestCase;

class AddMemberToGroupRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "email": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Workspace\Groups\Members\Requests\AddMemberToGroupRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
