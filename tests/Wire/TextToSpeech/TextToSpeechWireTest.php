<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\TextToSpeech;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TextToSpeechWireTest extends TestCase
{
  public function testConvertWithTimestampsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "audio_base64": "test-value",
          "alignment": {
              "characters": [
                  "test-value"
              ],
              "character_start_times_seconds": [
                  1
              ],
              "character_end_times_seconds": [
                  1
              ]
          },
          "normalized_alignment": {
              "characters": [
                  "test-value"
              ],
              "character_start_times_seconds": [
                  1
              ],
              "character_end_times_seconds": [
                  1
              ]
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $outputFormat =
      \ElevenLabs\TextToSpeech\Types\ConvertWithTimestampsTextToSpeechRequestOutputFormat::Alaw8000;

    $voiceSettings = new \ElevenLabs\Types\VoiceSettings([
      'stability' => 0.62,
      'useSpeakerBoost' => true,
      'similarityBoost' => 0.18,
      'style' => 2.67,
      'speed' => 5.4,
      'cloneStrength' => 0.53
    ]);

    $pronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $bodyTextToSpeechFullWithTimestampsApplyTextNormalization =
      \ElevenLabs\TextToSpeech\Types\BodyTextToSpeechFullWithTimestampsApplyTextNormalization::Auto
        ->value;

    $effectsSpecInput = new \ElevenLabs\Types\EffectsSpecInput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.89,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.33
    ]);

    $request = new \ElevenLabs\TextToSpeech\Requests\BodyTextToSpeechFullWithTimestamps([
      'enableLogging' => true,
      'optimizeStreamingLatency' => 6,
      'outputFormat' => $outputFormat->value,
      'text' => 'This is a test for the API of ElevenLabs.',
      'modelId' => 'eleven_multilingual_v2',
      'languageCode' => 'language_code',
      'voiceSettings' => $voiceSettings,
      'pronunciationDictionaryLocators' => [],
      'seed' => 7,
      'previousText' => 'previous_text',
      'nextText' => 'next_text',
      'previousRequestIds' => [],
      'nextRequestIds' => [],
      'usePvcAsIvc' => true,
      'applyTextNormalization' => $bodyTextToSpeechFullWithTimestampsApplyTextNormalization,
      'applyLanguageTextNormalization' => true,
      'audioEffects' => $effectsSpecInput
    ]);
    $sdk->textToSpeech->convertWithTimestamps(request: $request, voiceId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/text-to-speech/[^/]+/with-timestamps$#',
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
