<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Core\Types\Date;
use DateTime;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class DubbingLanguageResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Unique identifier of the language target.
   */
  #[JsonProperty('language_id', required: true)]
  public string $languageId;

  /**
   * Identifier of the parent dubbing project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * BCP-47 language tag this target is dubbed into.
   */
  #[JsonProperty('target_language', required: true)]
  public string $targetLanguage;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingLanguageResponseStatus>
   * Lifecycle status: `queued` (waiting on the project to be ready, or on a worker), `processing` while it is being dubbed, `completed` once its output is available, `stale` when the transcript changed after the output was produced, or `failed`.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * Dubbing model this target is dubbed with, inherited from the project and not selectable per language.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Voice settings applied to every speaker in this language, or null if the defaults apply.
   */
  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\VoiceSettings $voiceSettings;

  /**
   * Signed output URLs; null until the target has produced an output (present once `completed`, and kept while `stale` — compare `output_revision` against `revision` to tell whether the output is up to date).
   */
  #[JsonProperty('outputs')]
  public ?\ElevenLabs\Types\DubbingLanguageOutputs $outputs;

  /**
   * Monotonic counter incremented whenever this target's transcript changes (a source edit affecting it, or an edit to its translation).
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * The `revision` the current dubbed output was generated from; equal to `revision` when up to date, and lower when `stale`. This is null until a generation has completed.
   */
  #[JsonProperty('output_revision')]
  public ?int $outputRevision;

  /**
   * Why this language failed; null unless `status` is `failed`, and also null for the few languages that failed before failure reporting was introduced. A code of `project_failed` means the parent project failed, so read the project for the underlying cause.
   */
  #[JsonProperty('error')]
  public ?\ElevenLabs\Types\DubbingErrorResponse $error;

  /**
   * @var \ElevenLabs\Types\VoicesNotPermittedWarning[]|null
   * Non-fatal conditions raised while dubbing this language, empty when there are none. Reflects the latest generation. Conditions raised while preparing the source are reported on the project instead.
   */
  #[JsonProperty('warnings'), ArrayType([\ElevenLabs\Types\VoicesNotPermittedWarning::class])]
  public ?array $warnings;

  /**
   * When the language target was created.
   */
  #[JsonProperty('created_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $createdAt;

  /**
   * When the language target was last updated.
   */
  #[JsonProperty('updated_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $updatedAt;

  /**
   * @param array{
   *   languageId: string,
   *   projectId: string,
   *   targetLanguage: string,
   *   status: value-of<\ElevenLabs\Types\DubbingLanguageResponseStatus>,
   *   revision: int,
   *   createdAt: DateTime,
   *   updatedAt: DateTime,
   *   modelId?: ?string,
   *   voiceSettings?: ?\ElevenLabs\Types\VoiceSettings,
   *   outputs?: ?\ElevenLabs\Types\DubbingLanguageOutputs,
   *   outputRevision?: ?int,
   *   error?: ?\ElevenLabs\Types\DubbingErrorResponse,
   *   warnings?: \ElevenLabs\Types\VoicesNotPermittedWarning[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->languageId = $values['languageId'];
    $this->projectId = $values['projectId'];
    $this->targetLanguage = $values['targetLanguage'];
    $this->status = $values['status'];
    $this->modelId = $values['modelId'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->outputs = $values['outputs'] ?? null;
    $this->revision = $values['revision'];
    $this->outputRevision = $values['outputRevision'] ?? null;
    $this->error = $values['error'] ?? null;
    $this->warnings = $values['warnings'] ?? null;
    $this->createdAt = $values['createdAt'];
    $this->updatedAt = $values['updatedAt'];

    $this->_dirtyFields = [
      'language_id' => true,
      'project_id' => true,
      'target_language' => true,
      'status' => true,
      'revision' => true,
      'created_at' => true,
      'updated_at' => true
    ];
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('outputs', $values)) {
      $this->_dirtyFields['outputs'] = true;
    }
    if (array_key_exists('outputRevision', $values)) {
      $this->_dirtyFields['output_revision'] = true;
    }
    if (array_key_exists('error', $values)) {
      $this->_dirtyFields['error'] = true;
    }
    if (array_key_exists('warnings', $values)) {
      $this->_dirtyFields['warnings'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'language_id',
      'contents' => $this->languageId
    ];

    $parts[] = [
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'target_language',
      'contents' => $this->targetLanguage
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => json_encode($this->voiceSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->outputs !== null) {
      $parts[] = [
        'name' => 'outputs',
        'contents' => json_encode($this->outputs),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'revision',
      'contents' => (string) $this->revision
    ];

    if ($this->outputRevision !== null) {
      $parts[] = [
        'name' => 'output_revision',
        'contents' => (string) $this->outputRevision
      ];
    }

    if ($this->error !== null) {
      $parts[] = [
        'name' => 'error',
        'contents' => json_encode($this->error),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->warnings !== null) {
      $parts[] = [
        'name' => 'warnings',
        'contents' => json_encode($this->warnings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    $parts[] = [
      'name' => 'created_at',
      'contents' => $this->createdAt
    ];

    $parts[] = [
      'name' => 'updated_at',
      'contents' => $this->updatedAt
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->voiceSettings?->validate();
    $this->outputs?->validate();
    $this->error?->validate();
    foreach ($this->warnings ?? [] as $item) {
      $item->validate();
    }
  }
}
