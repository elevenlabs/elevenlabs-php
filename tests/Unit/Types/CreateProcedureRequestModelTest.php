<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class CreateProcedureRequestModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "name": "test-value",
        "content": "test-value",
        "type": "free_form",
        "trigger": "test-value",
        "folder_parent_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\CreateProcedureRequestModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
