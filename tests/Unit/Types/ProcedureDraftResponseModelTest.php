<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProcedureDraftResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "procedure_id": "test-value",
        "name": "test-value",
        "content": "test-value",
        "type": "free_form",
        "trigger": "test-value",
        "folder_parent_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ProcedureDraftResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
