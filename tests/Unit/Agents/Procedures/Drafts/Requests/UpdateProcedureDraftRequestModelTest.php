<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Procedures\Drafts\Requests;

use PHPUnit\Framework\TestCase;

class UpdateProcedureDraftRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "content": "test-value",
        "type": "free_form",
        "trigger": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Agents\Procedures\Drafts\Requests\UpdateProcedureDraftRequestModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
