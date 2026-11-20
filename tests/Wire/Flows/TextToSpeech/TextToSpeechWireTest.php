<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Flows\TextToSpeech;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TextToSpeechWireTest extends TestCase
{
  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "generations": [
              {
                  "id": "test-value",
                  "status": "pending"
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $status = \ElevenLabs\Flows\TextToSpeech\Types\ListTextToSpeechRequestStatus::Pending;
    $sdk->flows->textToSpeech->list(
      request: new \ElevenLabs\Flows\TextToSpeech\Requests\ListTextToSpeechRequest([
        'cursor' => 'cursor',
        'pageSize' => 30,
        'status' => $status->value,
        'modelId' => 'model_id'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/text-to-speech$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "status": "pending"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $webhookTargetAllType = \ElevenLabs\Types\WebhookTargetAllType::All->value;

    $webhookTargetAll = new \ElevenLabs\Types\WebhookTargetAll([
      'type' => $webhookTargetAllType
    ]);
    $webhookTarget = \ElevenLabs\Types\WebhookTarget::all($webhookTargetAll);

    $elevenFlashV25RequestOutputFormat =
      \ElevenLabs\Types\ElevenFlashV25RequestOutputFormat::Mp32205032->value;

    $pronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $elevenFlashV25RequestModelId =
      \ElevenLabs\Types\ElevenFlashV25RequestModelId::ElevenFlashV25->value;

    $elevenFlashV25VoiceSettings = new \ElevenLabs\Types\ElevenFlashV25VoiceSettings([
      'stability' => 0.84,
      'similarityBoost' => 0.91,
      'speed' => 1.01
    ]);

    $request = new \ElevenLabs\Types\ElevenFlashV25Request([
      'webhook' => $webhookTarget,
      'text' => 'The first move is what sets everything in motion.',
      'voice' => 'JBFqnCBsd6RMkjVDRZzb',
      'outputFormat' => $elevenFlashV25RequestOutputFormat,
      'pronunciationDictionaryLocators' => [],
      'modelId' => $elevenFlashV25RequestModelId,
      'languageCode' => 'language_code',
      'voiceSettings' => $elevenFlashV25VoiceSettings
    ]);
    $sdk->flows->textToSpeech->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/text-to-speech$#',
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
          "status": "pending"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->flows->textToSpeech->get(generationId: 'generation_id');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/flows/text-to-speech/[^/]+$#',
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
