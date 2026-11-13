<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * A published snapshot of a template, and the ports it runs with.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TemplateVersion extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Pass as `version_id` on `POST /v1/flows/templates/{template_id}/runs` to pin a run to this snapshot.
   */
  #[JsonProperty('version_id', required: true)]
  public string $versionId;

  /**
   * When this version was published, as a Unix timestamp in seconds.
   */
  #[JsonProperty('published_at_unix', required: true)]
  public int $publishedAtUnix;

  /**
   * Whether this is the version a run gets when `version_id` is omitted or set to `latest`.
   */
  #[JsonProperty('is_latest', required: true)]
  public bool $isLatest;

  /**
   * @var \ElevenLabs\Types\TemplatePort[]
   * The inputs this version accepts, in canvas order. Every input is required on a run.
   */
  #[JsonProperty('inputs', required: true), ArrayType([\ElevenLabs\Types\TemplatePort::class])]
  public array $inputs;

  /**
   * @var \ElevenLabs\Types\TemplatePort[]
   * The outputs this version produces, in canvas order.
   */
  #[JsonProperty('outputs', required: true), ArrayType([\ElevenLabs\Types\TemplatePort::class])]
  public array $outputs;

  /**
   * @param array{
   *   versionId: string,
   *   publishedAtUnix: int,
   *   isLatest: bool,
   *   inputs: \ElevenLabs\Types\TemplatePort[],
   *   outputs: \ElevenLabs\Types\TemplatePort[],
   * } $values
   */
  public function __construct(array $values)
  {
    $this->versionId = $values['versionId'];
    $this->publishedAtUnix = $values['publishedAtUnix'];
    $this->isLatest = $values['isLatest'];
    $this->inputs = $values['inputs'];
    $this->outputs = $values['outputs'];

    $this->_dirtyFields = [
      'version_id' => true,
      'published_at_unix' => true,
      'is_latest' => true,
      'inputs' => true,
      'outputs' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'version_id',
      'contents' => $this->versionId
    ];

    $parts[] = [
      'name' => 'published_at_unix',
      'contents' => (string) $this->publishedAtUnix
    ];

    $parts[] = [
      'name' => 'is_latest',
      'contents' => $this->isLatest ? 'true' : 'false'
    ];

    $parts[] = [
      'name' => 'inputs',
      'contents' => json_encode($this->inputs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'outputs',
      'contents' => json_encode($this->outputs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->inputs as $item) {
      $item->validate();
    }
    foreach ($this->outputs as $item) {
      $item->validate();
    }
  }
}
