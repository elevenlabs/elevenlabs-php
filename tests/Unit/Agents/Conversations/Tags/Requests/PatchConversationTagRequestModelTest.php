<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Tags\Requests;

use PHPUnit\Framework\TestCase;

class PatchConversationTagRequestModelTest extends TestCase
{
    public function testFullyPopulatedRoundTrip(): void
    {
        $json = <<<'JSON'
{
    "title": "test-value",
    "description": "test-value"
}
JSON;

        $instance = \ElevenLabs\Agents\Conversations\Tags\Requests\PatchConversationTagRequestModel::fromArray(json_decode($json, true));

        $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
    }
}
