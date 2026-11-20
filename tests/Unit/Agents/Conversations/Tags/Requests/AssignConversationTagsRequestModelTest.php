<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Unit\Agents\Conversations\Tags\Requests;

use PHPUnit\Framework\TestCase;

class AssignConversationTagsRequestModelTest extends TestCase
{
    public function testFullyPopulatedRoundTrip(): void
    {
        $json = <<<'JSON'
{
    "tag_ids": [
        "test-value"
    ]
}
JSON;

        $instance = \ElevenLabs\Agents\Conversations\Tags\Requests\AssignConversationTagsRequestModel::fromArray(json_decode($json, true));

        $this->assertJsonStringEqualsJsonString($json, json_encode($instance));
    }
}
