<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class EndProcedureToolResultSuccessModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "end_procedure_success",
        "status": "success",
        "procedure_id": "test-value",
        "procedure_name": "test-value",
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\EndProcedureToolResultSuccessModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
