<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\PronunciationDictionaries;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class PronunciationDictionariesWireTest extends TestCase
{
  public function testCreateFromRulesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "created_by": "test-value",
          "creation_time_unix": 1,
          "version_id": "test-value",
          "version_rules_num": 1,
          "description": "test-value",
          "permission_on_resource": "admin"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $pronunciationDictionaryAliasRuleRequestModelType =
      \ElevenLabs\Types\PronunciationDictionaryAliasRuleRequestModelType::Alias->value;

    $pronunciationDictionaryAliasRuleRequestModel = new \ElevenLabs\Types\PronunciationDictionaryAliasRuleRequestModel(
      [
        'stringToReplace' => 'string_to_replace',
        'caseSensitive' => true,
        'wordBoundaries' => true,
        'type' => $pronunciationDictionaryAliasRuleRequestModelType,
        'alias' => 'alias'
      ]
    );
    $bodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem = \ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem::alias(
      $pronunciationDictionaryAliasRuleRequestModel
    );

    $bodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess =
      \ElevenLabs\PronunciationDictionaries\Types\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess
        ::Admin->value;

    $request = new \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost(
      [
        'rules' => [],
        'name' => 'My Dictionary',
        'description' => 'description',
        'workspaceAccess' => $bodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess
      ]
    );
    $sdk->pronunciationDictionaries->createFromRules(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/add-from-rules$#',
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
          "latest_version_id": "test-value",
          "latest_version_rules_num": 1,
          "name": "test-value",
          "permission_on_resource": "admin",
          "created_by": "test-value",
          "creation_time_unix": 1,
          "archived_time_unix": 1,
          "description": "test-value",
          "rules": [
              {
                  "string_to_replace": "test-value",
                  "case_sensitive": true,
                  "word_boundaries": true,
                  "type": "alias",
                  "alias": "test-value"
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->pronunciationDictionaries->get(pronunciationDictionaryId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/[^/]+$#',
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
          "latest_version_id": "test-value",
          "latest_version_rules_num": 1,
          "name": "test-value",
          "permission_on_resource": "admin",
          "created_by": "test-value",
          "creation_time_unix": 1,
          "archived_time_unix": 1,
          "description": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\PronunciationDictionaries\Requests\BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch(
      [
        'archived' => true,
        'name' => 'My Dictionary'
      ]
    );
    $sdk->pronunciationDictionaries->update(
      request: $request,
      pronunciationDictionaryId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "pronunciation_dictionaries": [
              {
                  "id": "test-value",
                  "latest_version_id": "test-value",
                  "latest_version_rules_num": 1,
                  "name": "test-value",
                  "permission_on_resource": "admin",
                  "created_by": "test-value",
                  "creation_time_unix": 1,
                  "archived_time_unix": 1,
                  "description": "test-value"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sort =
      \ElevenLabs\PronunciationDictionaries\Types\ListPronunciationDictionariesRequestSort::CreationTimeUnix;
    $sdk->pronunciationDictionaries->list(
      request: new \ElevenLabs\PronunciationDictionaries\Requests\ListPronunciationDictionariesRequest(
        [
          'cursor' => 'cursor',
          'pageSize' => 30,
          'sort' => $sort->value,
          'sortDirection' => 'sort_direction',
          'includeArchived' => true
        ]
      )
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries$#',
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
