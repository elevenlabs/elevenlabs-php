<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class StartProcedureToolResultErrorModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "result_type": "start_procedure_error",
        "status": "not_found",
        "procedure_id": "test-value",
        "message": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Types\StartProcedureToolResultErrorModel::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
