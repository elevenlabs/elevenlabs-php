<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Tests\Folders;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class FoldersWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Tests\Folders\Requests\BodyCreateAgentTestFolderV1ConvaiAgentTestingFoldersPost(
      [
        'name' => 'name',
        'parentFolderId' => 'parent_folder_id'
      ]
    );
    $sdk->agents->tests->folders->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/folders$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "folder_path": [
              {
                  "id": "test-value",
                  "name": "test-value"
              }
          ],
          "children_count": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->folders->get(folderId: 'tfld_7301khxdkycse5f88fzjdtrterzm');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/folders/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "folder_path": [
              {
                  "id": "test-value",
                  "name": "test-value"
              }
          ],
          "children_count": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Tests\Folders\Requests\BodyUpdateAgentTestFolderV1ConvaiAgentTestingFoldersFolderIdPatch(
      [
        'name' => 'name'
      ]
    );
    $sdk->agents->tests->folders->update(
      request: $request,
      folderId: 'tfld_7301khxdkycse5f88fzjdtrterzm'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/folders/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(204, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->tests->folders->delete(
      request: new \ElevenLabs\Agents\Tests\Folders\Requests\DeleteFoldersRequest([
        'force' => false
      ]),
      folderId: 'tfld_7301khxdkycse5f88fzjdtrterzm'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agent-testing/folders/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
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

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}
