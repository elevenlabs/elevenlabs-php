<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Voices\Requests;

use PHPUnit\Framework\TestCase;

class BodyGetSimilarLibraryVoicesV1SimilarVoicesPostTest extends TestCase
{
  public function testFullyPopulatedRoundTrip(): void
  {
    $json = <<<'JSON'
    {
        "similarity_threshold": 1,
        "top_k": 1
    }
    JSON;

    $instance = \ElevenLabs\Voices\Requests\BodyGetSimilarLibraryVoicesV1SimilarVoicesPost::fromArray(
      json_decode($json, true)
    );

    $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
  }
}
