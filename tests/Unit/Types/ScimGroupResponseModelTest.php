<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class ScimGroupResponseModelTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "scim_external_id": "test-value",
        "display_name": "test-value",
        "created_at_unix": 1,
        "updated_at_unix": 1,
        "seat_type": "workspace_admin"
    }
    JSON;

    $instance = \ElevenLabs\Types\ScimGroupResponseModel::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
