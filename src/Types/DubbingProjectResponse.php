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
class DubbingProjectResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Unique identifier of the dubbing project.
   */
  #[JsonProperty('project_id', required: true)]
  public string $projectId;

  /**
   * @var value-of<\ElevenLabs\Types\DubbingProjectResponseStatus>
   * Lifecycle status of the project: `queued` before the source is picked up, `preparing` while it is transcribed, `ready` once transcription is done and language targets can start, or `failed`. A project is never reported as `processing` — that value belongs to language targets.
   */
  #[JsonProperty('status', required: true)]
  public string $status;

  /**
   * The free-form string you supplied as `reference` when creating the project, or null if you supplied none.
   */
  #[JsonProperty('reference')]
  public ?string $reference;

  /**
   * BCP-47 language tag of the source media (null if auto-detected).
   */
  #[JsonProperty('source_language')]
  public ?string $sourceLanguage;

  /**
   * Dubbing model every language target of this project is dubbed with. Fixed at create time and not selectable per language.
   */
  #[JsonProperty('model_id')]
  public ?string $modelId;

  /**
   * Source media metadata, populated once the source has been fetched and decoded (shortly after create, before the project is `ready`); null until then.
   */
  #[JsonProperty('media')]
  public ?\ElevenLabs\Types\DubbingSourceMediaInfo $media;

  /**
   * @var string[]|null
   * Identifiers of the language targets under this project. Populated when a single project is fetched, and on create when `target_language` creates one. Always empty in list responses — list the project's language targets instead.
   */
  #[JsonProperty('language_ids'), ArrayType(['string'])]
  public ?array $languageIds;

  /**
   * @var string[]|null
   * IDs of the workspace webhooks notified as this project and its languages reach `ready`, `completed`, or `failed`.
   */
  #[JsonProperty('webhook_ids'), ArrayType(['string'])]
  public ?array $webhookIds;

  /**
   * Monotonic counter incremented whenever the source transcript is edited (segment add/edit/delete).
   */
  #[JsonProperty('revision', required: true)]
  public int $revision;

  /**
   * Why the project failed; null unless `status` is `failed`. Also null for the few projects that failed before failure reporting was introduced.
   */
  #[JsonProperty('error')]
  public ?\ElevenLabs\Types\DubbingErrorResponse $error;

  /**
   * @var \ElevenLabs\Types\VoicesNotPermittedWarning[]|null
   * Non-fatal conditions raised while preparing the source, empty when there are none. Reflects the latest preparation. Conditions raised while dubbing a particular language are reported on that language instead.
   */
  #[JsonProperty('warnings'), ArrayType([\ElevenLabs\Types\VoicesNotPermittedWarning::class])]
  public ?array $warnings;

  /**
   * When the project was created.
   */
  #[JsonProperty('created_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $createdAt;

  /**
   * When the project was last updated.
   */
  #[JsonProperty('updated_at', required: true), Date(Date::TYPE_DATETIME)]
  public DateTime $updatedAt;

  /**
   * @param array{
   *   projectId: string,
   *   status: value-of<\ElevenLabs\Types\DubbingProjectResponseStatus>,
   *   revision: int,
   *   createdAt: DateTime,
   *   updatedAt: DateTime,
   *   reference?: ?string,
   *   sourceLanguage?: ?string,
   *   modelId?: ?string,
   *   media?: ?\ElevenLabs\Types\DubbingSourceMediaInfo,
   *   languageIds?: string[]|null,
   *   webhookIds?: string[]|null,
   *   error?: ?\ElevenLabs\Types\DubbingErrorResponse,
   *   warnings?: \ElevenLabs\Types\VoicesNotPermittedWarning[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->projectId = $values['projectId'];
    $this->status = $values['status'];
    $this->reference = $values['reference'] ?? null;
    $this->sourceLanguage = $values['sourceLanguage'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
    $this->media = $values['media'] ?? null;
    $this->languageIds = $values['languageIds'] ?? null;
    $this->webhookIds = $values['webhookIds'] ?? null;
    $this->revision = $values['revision'];
    $this->error = $values['error'] ?? null;
    $this->warnings = $values['warnings'] ?? null;
    $this->createdAt = $values['createdAt'];
    $this->updatedAt = $values['updatedAt'];

    $this->_dirtyFields = [
      'project_id' => true,
      'status' => true,
      'revision' => true,
      'created_at' => true,
      'updated_at' => true
    ];
    if (array_key_exists('reference', $values)) {
      $this->_dirtyFields['reference'] = true;
    }
    if (array_key_exists('sourceLanguage', $values)) {
      $this->_dirtyFields['source_language'] = true;
    }
    if (array_key_exists('modelId', $values)) {
      $this->_dirtyFields['model_id'] = true;
    }
    if (array_key_exists('media', $values)) {
      $this->_dirtyFields['media'] = true;
    }
    if (array_key_exists('languageIds', $values)) {
      $this->_dirtyFields['language_ids'] = true;
    }
    if (array_key_exists('webhookIds', $values)) {
      $this->_dirtyFields['webhook_ids'] = true;
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
      'name' => 'project_id',
      'contents' => $this->projectId
    ];

    $parts[] = [
      'name' => 'status',
      'contents' => $this->status
    ];

    if ($this->reference !== null) {
      $parts[] = [
        'name' => 'reference',
        'contents' => $this->reference
      ];
    }

    if ($this->sourceLanguage !== null) {
      $parts[] = [
        'name' => 'source_language',
        'contents' => $this->sourceLanguage
      ];
    }

    if ($this->modelId !== null) {
      $parts[] = [
        'name' => 'model_id',
        'contents' => $this->modelId
      ];
    }

    if ($this->media !== null) {
      $parts[] = [
        'name' => 'media',
        'contents' => json_encode($this->media),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->languageIds !== null) {
      foreach ($this->languageIds ?? [] as $item) {
        $parts[] = [
          'name' => 'language_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->webhookIds !== null) {
      foreach ($this->webhookIds ?? [] as $item) {
        $parts[] = [
          'name' => 'webhook_ids',
          'contents' => $item
        ];
      }
    }

    $parts[] = [
      'name' => 'revision',
      'contents' => (string) $this->revision
    ];

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
    $this->media?->validate();
    $this->error?->validate();
    foreach ($this->warnings ?? [] as $item) {
      $item->validate();
    }
  }
}
