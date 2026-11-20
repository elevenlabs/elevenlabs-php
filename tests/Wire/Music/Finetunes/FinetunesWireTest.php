<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Music\Finetunes;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class FinetunesWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "finetunes": [
              {
                  "id": "test-value",
                  "name": "test-value",
                  "tags": [
                      "test-value"
                  ],
                  "primary_genre": "test-value",
                  "model_id": "test-value",
                  "created_at": "2023-01-01T12:34:56Z",
                  "visibility": "private",
                  "created_by": "self",
                  "status": "pending",
                  "training_progress": 1,
                  "failure_reason": "audio_processing_failed"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $visibility = \ElevenLabs\Types\FinetuneVisibility::Private_;
    $createdBy = \ElevenLabs\Types\FinetuneCreatedBy::Self;
    $sort = \ElevenLabs\Music\Finetunes\Types\ListFinetunesRequestSort::CreatedAt;
    $sortDirection = \ElevenLabs\Music\Finetunes\Types\ListFinetunesRequestSortDirection::Asc;
    $sdk->music->finetunes->list(
      request: new \ElevenLabs\Music\Finetunes\Requests\ListFinetunesRequest([
        'cursor' => 'cursor',
        'pageSize' => 50,
        'visibility' => $visibility->value,
        'createdBy' => $createdBy->value,
        'sort' => $sort->value,
        'sortDirection' => $sortDirection->value
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/music/finetunes$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "tags": [
              "test-value"
          ],
          "primary_genre": "test-value",
          "model_id": "test-value",
          "created_at": "2023-01-01T12:34:56Z",
          "visibility": "private",
          "created_by": "self",
          "status": "pending",
          "training_progress": 1,
          "failure_reason": "audio_processing_failed"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->music->finetunes->get(finetuneId: 'finetune_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/music/finetunes/[^/]+$#',
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
          "tags": [
              "test-value"
          ],
          "primary_genre": "test-value",
          "model_id": "test-value",
          "created_at": "2023-01-01T12:34:56Z",
          "visibility": "private",
          "created_by": "self",
          "status": "pending",
          "training_progress": 1,
          "failure_reason": "audio_processing_failed"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $updateMusicFinetuneRequestModelVisibility =
      \ElevenLabs\Music\Finetunes\Types\UpdateMusicFinetuneRequestModelVisibility::Private_->value;

    $request = new \ElevenLabs\Music\Finetunes\Requests\UpdateMusicFinetuneRequestModel([
      'name' => 'commodo in dolore fugiat sed',
      'tags' => [],
      'primaryGenre' => 'primary_genre',
      'visibility' => $updateMusicFinetuneRequestModelVisibility
    ]);
    $sdk->music->finetunes->update(request: $request, finetuneId: 'finetune_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/music/finetunes/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "tags": [
              "test-value"
          ],
          "primary_genre": "test-value",
          "model_id": "test-value",
          "created_at": "2023-01-01T12:34:56Z",
          "visibility": "private",
          "created_by": "self",
          "status": "pending",
          "training_progress": 1,
          "failure_reason": "audio_processing_failed"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->music->finetunes->delete(finetuneId: 'finetune_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/music/finetunes/[^/]+$#',
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
