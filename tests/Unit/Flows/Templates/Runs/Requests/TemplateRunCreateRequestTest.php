<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Flows\Templates\Runs\Requests;

use PHPUnit\Framework\TestCase;

class TemplateRunCreateRequestTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "inputs": {
            "key": "test-value"
        },
        "version_id": "test-value",
        "webhook": {
            "type": "all"
        }
    }
    JSON;

    $instance = \ElevenLabs\Flows\Templates\Runs\Requests\TemplateRunCreateRequest::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
