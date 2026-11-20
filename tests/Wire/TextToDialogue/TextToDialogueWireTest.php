<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\TextToDialogue;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class TextToDialogueWireTest extends TestCase
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
          },
          "voice_segments": [
              {
                  "voice_id": "test-value",
                  "start_time_seconds": 1,
                  "end_time_seconds": 1,
                  "character_start_index": 1,
                  "character_end_index": 1,
                  "dialogue_input_index": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $outputFormat =
      \ElevenLabs\TextToDialogue\Types\ConvertWithTimestampsTextToDialogueRequestOutputFormat::Alaw8000;

    $dialogueInput = new \ElevenLabs\Types\DialogueInput([
      'text' => 'text',
      'voiceId' => 'voice_id'
    ]);

    $toDialogueSettingsResponseModel = new \ElevenLabs\Types\ToDialogueSettingsResponseModel([
      'stability' => 0.03,
      'similarity' => 0.74,
      'cloneStrength' => 0.19
    ]);

    $pronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $bodyTextToDialogueFullWithTimestampsApplyTextNormalization =
      \ElevenLabs\TextToDialogue\Types\BodyTextToDialogueFullWithTimestampsApplyTextNormalization
        ::Auto->value;

    $effectsSpecInput = new \ElevenLabs\Types\EffectsSpecInput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.89,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.33
    ]);

    $request = new \ElevenLabs\TextToDialogue\Requests\BodyTextToDialogueFullWithTimestamps([
      'outputFormat' => $outputFormat->value,
      'enableLogging' => true,
      'inputs' => [],
      'modelId' => 'eleven_v3',
      'languageCode' => 'language_code',
      'settings' => $toDialogueSettingsResponseModel,
      'pronunciationDictionaryLocators' => [],
      'seed' => 10,
      'applyTextNormalization' => $bodyTextToDialogueFullWithTimestampsApplyTextNormalization,
      'usePvcAsIvc' => false,
      'previousRequestIds' => [],
      'nextRequestIds' => [],
      'previousText' => 'previous_text',
      'futureText' => 'future_text',
      'audioEffects' => $effectsSpecInput
    ]);
    $sdk->textToDialogue->convertWithTimestamps(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/text-to-dialogue/with-timestamps$#',
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
