<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ProcedureRefResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "procedure_id": "test-value",
        "version_id": "test-value",
        "name": "test-value",
        "type": "free_form",
        "trigger": "test-value",
        "referenced_tool_ids": [
            "test-value"
        ],
        "referenced_kb_ids": [
            "test-value"
        ],
        "referenced_procedure_ids": [
            "test-value"
        ],
        "referenced_dynamic_variables": [
            "test-value"
        ],
        "written_dynamic_variables": [
            "test-value"
        ],
        "folder_parent_id": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\ProcedureRefResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
