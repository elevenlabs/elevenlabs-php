<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A template the caller can run, and its runnable versions.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateSummary extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Pass as `template_id` on `POST /v1/flows/templates/{template_id}/runs`.
   */
  #[JsonProperty('id', required: true)]
  public string $id;

  /**
   * The template's name.
   */
  #[JsonProperty('name', required: true)]
  public string $name;

  /**
   * The template's description, if it has one.
   */
  #[JsonProperty('description')]
  public ?string $description;

  /**
   * @var \ElevenLabs\Types\TemplateVersion[]
   * The published versions this caller can run, newest first. A version whose graph uses a model that is not available to you through the API is left out, as is one whose stored snapshot is gone; either way the list can be empty while the template still has versions the ElevenLabs app can run.
   */
  #[JsonProperty('versions', required: true), ArrayType([\ElevenLabs\Types\TemplateVersion::class])]
  public array $versions;

  /**
   * Whether this template has further published versions beyond the `versions_per_template` returned here. Fetch `GET /v1/flows/templates/{template_id}` with a larger `versions_per_template` to see more of them.
   */
  #[JsonProperty('has_more_versions', required: true)]
  public bool $hasMoreVersions;

  /**
   * @param array{
   *   id: string,
   *   name: string,
   *   versions: \ElevenLabs\Types\TemplateVersion[],
   *   hasMoreVersions: bool,
   *   description?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->id = $values['id'];
    $this->name = $values['name'];
    $this->description = $values['description'] ?? null;
    $this->versions = $values['versions'];
    $this->hasMoreVersions = $values['hasMoreVersions'];

    $this->_dirtyFields = [
      'id' => true,
      'name' => true,
      'versions' => true,
      'has_more_versions' => true
    ];
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'id',
      'contents' => $this->id
    ];

    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    $parts[] = [
      'name' => 'versions',
      'contents' => json_encode($this->versions),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'has_more_versions',
      'contents' => $this->hasMoreVersions ? 'true' : 'false'
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->versions as $item) {
      $item->validate();
    }
  }
}
