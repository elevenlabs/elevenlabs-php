<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Types;

use PHPUnit\Framework\TestCase;

class LeadsProgressTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "total": 1,
        "uncalled": 1,
        "leads_needing_attention": 1,
        "active": 1,
        "finished": 1,
        "finished_by_disposition": {
            "key": 1
        }
    }
    JSON;

    $instance = \ElevenLabs\Types\LeadsProgress::fromArray(json_decode($json, true));

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
