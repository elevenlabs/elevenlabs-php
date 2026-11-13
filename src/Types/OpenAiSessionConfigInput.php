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
class OpenAiSessionConfigInput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAiSessionConfigInputType>
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
  public ?\ElevenLabs\Types\OpenAiAudioConfigInput $audio;

  /**
   * @var \ElevenLabs\Types\OpenAiSessionConfigInputToolsItem[]|null
   */
  #[JsonProperty('tools'), ArrayType([\ElevenLabs\Types\OpenAiSessionConfigInputToolsItem::class])]
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
    JsonProperty('turn_detection'),
    Union(\ElevenLabs\Types\OpenAiTurnDetection::class, 'string', 'null')
  ]
  public \ElevenLabs\Types\OpenAiTurnDetection|string|null $turnDetection;

  #[
    JsonProperty('tracing'),
    Union('string', \ElevenLabs\Types\OpenAiTracingConfiguration::class, 'null')
  ]
  public string|\ElevenLabs\Types\OpenAiTracingConfiguration|null $tracing;

  /**
   * @var string[]|null
   */
  #[JsonProperty('include'), ArrayType(['string'])]
  public ?array $include;

  #[JsonProperty('parallel_tool_calls')]
  public ?bool $parallelToolCalls;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('reasoning'), ArrayType(['string' => 'mixed'])]
  public ?array $reasoning;

  #[JsonProperty('truncation')]
  public string|array|null $truncation;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('prompt'), ArrayType(['string' => 'mixed'])]
  public ?array $prompt;

  /**
   * @param array{
   *   type?: ?value-of<\ElevenLabs\Types\OpenAiSessionConfigInputType>,
   *   model?: ?value-of<\ElevenLabs\Types\RealtimeModel>,
   *   instructions?: ?string,
   *   outputModalities?: string[]|null,
   *   audio?: ?\ElevenLabs\Types\OpenAiAudioConfigInput,
   *   tools?: \ElevenLabs\Types\OpenAiSessionConfigInputToolsItem[]|null,
   *   toolChoice?: string|\ElevenLabs\Types\OpenAiToolChoiceFunction|null,
   *   temperature?: ?float,
   *   maxResponseOutputTokens?: int|string|null,
   *   maxDurationSeconds?: ?int,
   *   turnDetection?: \ElevenLabs\Types\OpenAiTurnDetection|string|null,
   *   tracing?: string|\ElevenLabs\Types\OpenAiTracingConfiguration|null,
   *   include?: string[]|null,
   *   parallelToolCalls?: ?bool,
   *   reasoning?: array<string, mixed>|null,
   *   truncation?: string|array|null,
   *   prompt?: array<string, mixed>|null,
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
    $this->turnDetection = $values['turnDetection'] ?? null;
    $this->tracing = $values['tracing'] ?? null;
    $this->include = $values['include'] ?? null;
    $this->parallelToolCalls = $values['parallelToolCalls'] ?? null;
    $this->reasoning = $values['reasoning'] ?? null;
    $this->truncation = $values['truncation'] ?? null;
    $this->prompt = $values['prompt'] ?? null;

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
    if (array_key_exists('turnDetection', $values)) {
      $this->_dirtyFields['turn_detection'] = true;
    }
    if (array_key_exists('tracing', $values)) {
      $this->_dirtyFields['tracing'] = true;
    }
    if (array_key_exists('include', $values)) {
      $this->_dirtyFields['include'] = true;
    }
    if (array_key_exists('parallelToolCalls', $values)) {
      $this->_dirtyFields['parallel_tool_calls'] = true;
    }
    if (array_key_exists('reasoning', $values)) {
      $this->_dirtyFields['reasoning'] = true;
    }
    if (array_key_exists('truncation', $values)) {
      $this->_dirtyFields['truncation'] = true;
    }
    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
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

    if ($this->turnDetection !== null) {
      $parts[] = [
        'name' => 'turn_detection',
        'contents' => json_encode($this->turnDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->tracing !== null) {
      $parts[] = [
        'name' => 'tracing',
        'contents' => json_encode($this->tracing),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->include !== null) {
      foreach ($this->include ?? [] as $item) {
        $parts[] = [
          'name' => 'include',
          'contents' => $item
        ];
      }
    }

    if ($this->parallelToolCalls !== null) {
      $parts[] = [
        'name' => 'parallel_tool_calls',
        'contents' => $this->parallelToolCalls ? 'true' : 'false'
      ];
    }

    if ($this->reasoning !== null) {
      $parts[] = [
        'name' => 'reasoning',
        'contents' => json_encode($this->reasoning),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->truncation !== null) {
      $parts[] = [
        'name' => 'truncation',
        'contents' => json_encode($this->truncation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => json_encode($this->prompt),
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
