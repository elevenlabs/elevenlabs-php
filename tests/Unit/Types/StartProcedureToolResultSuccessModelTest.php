<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StartProcedureToolResultSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "start_procedure_success",
        "status": "success",
        "procedure_id": "test-value",
        "procedure_name": "test-value",
        "procedure_entry_workflow_node": "test-value",
        "procedure_return_workflow_node": "test-value",
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\StartProcedureToolResultSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
