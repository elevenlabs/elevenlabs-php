<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\AnalysisItems\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateAnalysisItemAttachmentsRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\AnalysisItemSource>
   */
  #[JsonProperty('source', required: true)]
  public string $source;

  /**
   * @var \ElevenLabs\Types\AnalysisItemAttachmentDestination[]|null
   */
  #[JsonProperty('attach'), ArrayType([\ElevenLabs\Types\AnalysisItemAttachmentDestination::class])]
  public ?array $attach;

  /**
   * @var \ElevenLabs\Types\AnalysisItemAttachmentDestination[]|null
   */
  #[JsonProperty('detach'), ArrayType([\ElevenLabs\Types\AnalysisItemAttachmentDestination::class])]
  public ?array $detach;

  /**
   * @param array{
   *   source: value-of<\ElevenLabs\Types\AnalysisItemSource>,
   *   attach?: \ElevenLabs\Types\AnalysisItemAttachmentDestination[]|null,
   *   detach?: \ElevenLabs\Types\AnalysisItemAttachmentDestination[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->source = $values['source'];
    $this->attach = $values['attach'] ?? null;
    $this->detach = $values['detach'] ?? null;

    $this->_dirtyFields = [
      'source' => true
    ];
    if (array_key_exists('attach', $values)) {
      $this->_dirtyFields['attach'] = true;
    }
    if (array_key_exists('detach', $values)) {
      $this->_dirtyFields['detach'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'source',
      'contents' => $this->source
    ];

    if ($this->attach !== null) {
      $parts[] = [
        'name' => 'attach',
        'contents' => json_encode($this->attach),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->detach !== null) {
      $parts[] = [
        'name' => 'detach',
        'contents' => json_encode($this->detach),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->attach ?? [] as $item) {
      $item->validate();
    }
    foreach ($this->detach ?? [] as $item) {
      $item->validate();
    }
  }
}
