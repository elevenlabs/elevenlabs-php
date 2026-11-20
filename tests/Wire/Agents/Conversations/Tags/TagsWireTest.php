<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Conversations\Tags;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TagsWireTest extends TestCase
{
    public function testAssignSendsWireRequest(): void
    {
        $transport = $this->transport(204, '');
        $sdk = new ElevenLabs(options: ['client' => $transport]);

$request = new \ElevenLabs\Agents\Conversations\Tags\Requests\AssignConversationTagsRequestModel([
  'tagIds' => ["tag_ids"],
]);
        $sdk->agents->conversations->tags->assign(
  request: $request,
  conversationId: "conversation_id"
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('POST', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/conversations/[^/]+/tags$#', rawurldecode($sent->getUri()->getPath()));
        $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
        $this->assertNotNull(json_decode((string) $sent->getBody(), true));
    }

    public function testUnassignSendsWireRequest(): void
    {
        $transport = $this->transport(204, '');
        $sdk = new ElevenLabs(options: ['client' => $transport]);
        $sdk->agents->conversations->tags->unassign(
  conversationId: "conversation_id",
  tagId: "tag_id"
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('DELETE', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/conversations/[^/]+/tags/[^/]+$#', rawurldecode($sent->getUri()->getPath()));
    }

    public function testListSendsWireRequest(): void
    {
        $transport = $this->transport(200, <<<'JSON'
{
    "conversation_tags": [
        {
            "tag_id": "test-value",
            "workspace_id": "test-value",
            "owner_user_id": "test-value",
            "title": "test-value",
            "description": "test-value",
            "created_at_unix_secs": 1
        }
    ],
    "next_cursor": "test-value",
    "has_more": true
}
JSON);
        $sdk = new ElevenLabs(options: ['client' => $transport]);
        $sdk->agents->conversations->tags->list(
  request: new \ElevenLabs\Agents\Conversations\Tags\Requests\ListTagsRequest([
    'pageSize' => 100,
    'cursor' => "cursor",
  ])
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('GET', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/tags$#', rawurldecode($sent->getUri()->getPath()));
    }

    public function testCreateSendsWireRequest(): void
    {
        $transport = $this->transport(200, <<<'JSON'
{
    "tag_id": "test-value",
    "workspace_id": "test-value",
    "owner_user_id": "test-value",
    "title": "test-value",
    "description": "test-value",
    "created_at_unix_secs": 1
}
JSON);
        $sdk = new ElevenLabs(options: ['client' => $transport]);

$request = new \ElevenLabs\Agents\Conversations\Tags\Requests\CreateConversationTagRequestModel([
  'title' => "title",
  'description' => "description",
]);
        $sdk->agents->conversations->tags->create(
  request: $request
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('POST', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/tags$#', rawurldecode($sent->getUri()->getPath()));
        $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
        $this->assertNotNull(json_decode((string) $sent->getBody(), true));
    }

    public function testGetSendsWireRequest(): void
    {
        $transport = $this->transport(200, <<<'JSON'
{
    "tag_id": "test-value",
    "workspace_id": "test-value",
    "owner_user_id": "test-value",
    "title": "test-value",
    "description": "test-value",
    "created_at_unix_secs": 1
}
JSON);
        $sdk = new ElevenLabs(options: ['client' => $transport]);
        $sdk->agents->conversations->tags->get(
  tagId: "tag_id"
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('GET', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/tags/[^/]+$#', rawurldecode($sent->getUri()->getPath()));
    }

    public function testUpdateSendsWireRequest(): void
    {
        $transport = $this->transport(200, <<<'JSON'
{
    "tag_id": "test-value",
    "workspace_id": "test-value",
    "owner_user_id": "test-value",
    "title": "test-value",
    "description": "test-value",
    "created_at_unix_secs": 1
}
JSON);
        $sdk = new ElevenLabs(options: ['client' => $transport]);

$request = new \ElevenLabs\Agents\Conversations\Tags\Requests\PatchConversationTagRequestModel([
  'title' => "title",
  'description' => "description",
]);
        $sdk->agents->conversations->tags->update(
  request: $request,
  tagId: "tag_id"
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('PATCH', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/tags/[^/]+$#', rawurldecode($sent->getUri()->getPath()));
        $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
        $this->assertNotNull(json_decode((string) $sent->getBody(), true));
    }

    public function testDeleteSendsWireRequest(): void
    {
        $transport = $this->transport(204, '');
        $sdk = new ElevenLabs(options: ['client' => $transport]);
        $sdk->agents->conversations->tags->delete(
  tagId: "tag_id"
);

        $this->assertCount(1, $transport->requests);
        $sent = $transport->requests[0];
        $this->assertSame('DELETE', $sent->getMethod());
        $this->assertMatchesRegularExpression('#/v1/convai/tags/[^/]+$#', rawurldecode($sent->getUri()->getPath()));
    }

    /**
     * @return ClientInterface&object{requests: list<RequestInterface>}
     */
    private function transport(int $status, string $body): ClientInterface
    {
        return new class ($status, $body) implements ClientInterface {
            /** @var list<RequestInterface> */
            public array $requests = [];

            public function __construct(private int $status, private string $body)
            {
            }

            public function sendRequest(RequestInterface $request): ResponseInterface
            {
                $this->requests[] = $request;

                return new \GuzzleHttp\Psr7\Response($this->status, ['Content-Type' => 'application/json'], $this->body);
            }
        };
    }
}
