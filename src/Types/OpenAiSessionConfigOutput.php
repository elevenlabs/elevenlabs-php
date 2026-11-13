<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Union;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class OpenAiSessionConfigOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAiSessionConfigOutputType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * @var ?value-of<\ElevenLabs\Types\RealtimeModel>
   */
  #[JsonProperty('model')]
  public ?string $model;

  #[JsonProperty('instructions')]
  public ?string $instructions;

  /**
   * @var string[]|null
   */
  #[JsonProperty('output_modalities'), ArrayType(['string'])]
  public ?array $outputModalities;

  #[JsonProperty('audio')]
  public ?\ElevenLabs\Types\OpenAiAudioConfigOutput $audio;

  /**
   * @var \ElevenLabs\Types\OpenAiSessionConfigOutputToolsItem[]|null
   */
  #[JsonProperty('tools'), ArrayType([\ElevenLabs\Types\OpenAiSessionConfigOutputToolsItem::class])]
  public ?array $tools;

  #[
    JsonProperty('tool_choice'),
    Union('string', \ElevenLabs\Types\OpenAiToolChoiceFunction::class, 'null')
  ]
  public string|\ElevenLabs\Types\OpenAiToolChoiceFunction|null $toolChoice;

  #[JsonProperty('temperature')]
  public ?float $temperature;

  #[JsonProperty('max_response_output_tokens'), Union('integer', 'string', 'null')]
  public int|string|null $maxResponseOutputTokens;

  /**
   * Maximum wall-clock duration of the session in seconds. The session is closed with code 1000 once it is exceeded.
   */
  #[JsonProperty('max_duration_seconds')]
  public ?int $maxDurationSeconds;

  #[
    JsonProperty('tracing'),
    Union('string', \ElevenLabs\Types\OpenAiTracingConfiguration::class, 'null')
  ]
  public string|\ElevenLabs\Types\OpenAiTracingConfiguration|null $tracing;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\OpenAiSessionConfigOutputType>,
   *   model?: ?value-of<\ElevenLabs\Types\RealtimeModel>,
   *   instructions?: ?string,
   *   outputModalities?: string[]|null,
   *   audio?: ?\ElevenLabs\Types\OpenAiAudioConfigOutput,
   *   tools?: \ElevenLabs\Types\OpenAiSessionConfigOutputToolsItem[]|null,
   *   toolChoice?: string|\ElevenLabs\Types\OpenAiToolChoiceFunction|null,
   *   temperature?: ?float,
   *   maxResponseOutputTokens?: int|string|null,
   *   maxDurationSeconds?: ?int,
   *   tracing?: string|\ElevenLabs\Types\OpenAiTracingConfiguration|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->type = $values['type'] ?? 'realtime';
    $this->model = $values['model'] ?? null;
    $this->instructions = $values['instructions'] ?? null;
    $this->outputModalities = $values['outputModalities'] ?? null;
    $this->audio = $values['audio'] ?? null;
    $this->tools = $values['tools'] ?? null;
    $this->toolChoice = $values['toolChoice'] ?? null;
    $this->temperature = $values['temperature'] ?? null;
    $this->maxResponseOutputTokens = $values['maxResponseOutputTokens'] ?? null;
    $this->maxDurationSeconds = $values['maxDurationSeconds'] ?? null;
    $this->tracing = $values['tracing'] ?? null;

    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('model', $values)) {
      $this->_dirtyFields['model'] = true;
    }
    if (array_key_exists('instructions', $values)) {
      $this->_dirtyFields['instructions'] = true;
    }
    if (array_key_exists('outputModalities', $values)) {
      $this->_dirtyFields['output_modalities'] = true;
    }
    if (array_key_exists('audio', $values)) {
      $this->_dirtyFields['audio'] = true;
    }
    if (array_key_exists('tools', $values)) {
      $this->_dirtyFields['tools'] = true;
    }
    if (array_key_exists('toolChoice', $values)) {
      $this->_dirtyFields['tool_choice'] = true;
    }
    if (array_key_exists('temperature', $values)) {
      $this->_dirtyFields['temperature'] = true;
    }
    if (array_key_exists('maxResponseOutputTokens', $values)) {
      $this->_dirtyFields['max_response_output_tokens'] = true;
    }
    if (array_key_exists('maxDurationSeconds', $values)) {
      $this->_dirtyFields['max_duration_seconds'] = true;
    }
    if (array_key_exists('tracing', $values)) {
      $this->_dirtyFields['tracing'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    if ($this->model !== null) {
      $parts[] = [
        'name' => 'model',
        'contents' => $this->model
      ];
    }

    if ($this->instructions !== null) {
      $parts[] = [
        'name' => 'instructions',
        'contents' => $this->instructions
      ];
    }

    if ($this->outputModalities !== null) {
      foreach ($this->outputModalities ?? [] as $item) {
        $parts[] = [
          'name' => 'output_modalities',
          'contents' => $item
        ];
      }
    }

    if ($this->audio !== null) {
      $parts[] = [
        'name' => 'audio',
        'contents' => json_encode($this->audio),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->tools !== null) {
      $parts[] = [
        'name' => 'tools',
        'contents' => json_encode($this->tools),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->toolChoice !== null) {
      $parts[] = [
        'name' => 'tool_choice',
        'contents' => json_encode($this->toolChoice),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->temperature !== null) {
      $parts[] = [
        'name' => 'temperature',
        'contents' => (string) $this->temperature
      ];
    }

    if ($this->maxResponseOutputTokens !== null) {
      $parts[] = [
        'name' => 'max_response_output_tokens',
        'contents' => json_encode($this->maxResponseOutputTokens),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->maxDurationSeconds !== null) {
      $parts[] = [
        'name' => 'max_duration_seconds',
        'contents' => (string) $this->maxDurationSeconds
      ];
    }

    if ($this->tracing !== null) {
      $parts[] = [
        'name' => 'tracing',
        'contents' => json_encode($this->tracing),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->audio?->validate();
    Validator::validateNumber(
      $this->maxDurationSeconds,
      'max_duration_seconds',
      min: 60,
      max: 7200
    );
  }
}
