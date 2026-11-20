<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Productions\Orders\Media\Requests;

use PHPUnit\Framework\TestCase;

class BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "declared_language": "test-value",
        "media_url": "test-value",
        "media_url_filename": "test-value",
        "media_url_content_type": "test-value"
    }
    JSON;

    $instance = \ElevenLabs\Productions\Orders\Media\Requests\BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
