<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\PronunciationDictionaries\Rules;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class RulesWireTest extends TestCase
{
  public function testSetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "version_id": "test-value",
          "version_rules_num": 1
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
    $bodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPostRulesItem = \ElevenLabs\PronunciationDictionaries\Rules\Types\BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPostRulesItem::alias(
      $pronunciationDictionaryAliasRuleRequestModel
    );

    $request = new \ElevenLabs\PronunciationDictionaries\Rules\Requests\BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPost(
      [
        'rules' => []
      ]
    );
    $sdk->pronunciationDictionaries->rules->set(
      request: $request,
      pronunciationDictionaryId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/[^/]+/set-rules$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testAddSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "version_id": "test-value",
          "version_rules_num": 1
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
    $pronunciationDictionaryRule = \ElevenLabs\PronunciationDictionaries\Rules\Types\PronunciationDictionaryRule::alias(
      $pronunciationDictionaryAliasRuleRequestModel
    );

    $request = new \ElevenLabs\PronunciationDictionaries\Rules\Requests\PronunciationDictionary([
      'rules' => []
    ]);
    $sdk->pronunciationDictionaries->rules->add(
      request: $request,
      pronunciationDictionaryId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/[^/]+/add-rules$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRemoveSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "version_id": "test-value",
          "version_rules_num": 1
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\PronunciationDictionaries\Rules\Requests\RemovePronunciationDictionaryRulesRequest(
      [
        'ruleStrings' => []
      ]
    );
    $sdk->pronunciationDictionaries->rules->remove(
      request: $request,
      pronunciationDictionaryId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/pronunciation-dictionaries/[^/]+/remove-rules$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
