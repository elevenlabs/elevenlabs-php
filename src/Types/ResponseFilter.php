<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Configuration for filtering tool responses before they are visible to the agent.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ResponseFilter extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResponseFilterMode>
   * Controls how tool responses are filtered before being visible to the agent.
   */
  #[JsonProperty('mode')]
  public ?string $mode;

  /**
   * @var string[]|null
   * Dot notation paths to include when mode is 'allow' (e.g., ['ticket.id', 'ticket.status']).
   */
  #[JsonProperty('filters'), ArrayType(['string'])]
  public ?array $filters;

  /**
   * @var ?value-of<\ElevenLabs\Types\ResponseFilterContentType>
   * Content type for response filtering. Only 'application/json' responses are filtered.
   */
  #[JsonProperty('content_type')]
  public ?string $contentType;

  /**
   * @param array{
   *   mode?: ?value-of<\ElevenLabs\Types\ResponseFilterMode>,
   *   filters?: string[]|null,
   *   contentType?: ?value-of<\ElevenLabs\Types\ResponseFilterContentType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mode = $values['mode'] ?? null;
    $this->filters = $values['filters'] ?? null;
    $this->contentType = $values['contentType'] ?? 'application/json';

    if (array_key_exists('mode', $values)) {
      $this->_dirtyFields['mode'] = true;
    }
    if (array_key_exists('filters', $values)) {
      $this->_dirtyFields['filters'] = true;
    }
    if (array_key_exists('contentType', $values)) {
      $this->_dirtyFields['content_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mode !== null) {
      $parts[] = [
        'name' => 'mode',
        'contents' => $this->mode
      ];
    }

    if ($this->filters !== null) {
      foreach ($this->filters ?? [] as $item) {
        $parts[] = [
          'name' => 'filters',
          'contents' => $item
        ];
      }
    }

    if ($this->contentType !== null) {
      $parts[] = [
        'name' => 'content_type',
        'contents' => $this->contentType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
