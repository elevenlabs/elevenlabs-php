<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class TicketSearchMatchResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TicketSearchMatchField>
   */
  #[JsonProperty('field', required: true)]
  public string $field;

  /**
   * Whitespace-collapsed excerpt around the match, with an ellipsis where it was cut.
   */
  #[JsonProperty('snippet', required: true)]
  public string $snippet;

  /**
   * Offset of the match in `snippet`.
   */
  #[JsonProperty('highlight_start', required: true)]
  public int $highlightStart;

  /**
   * Exclusive end offset of the match in `snippet`.
   */
  #[JsonProperty('highlight_end', required: true)]
  public int $highlightEnd;

  /**
   * The commented turn, set when `field` is 'turn_comment'.
   */
  #[JsonProperty('turn_index')]
  public ?int $turnIndex;

  /**
   * @param array{
   *   field: value-of<\ElevenLabs\Types\TicketSearchMatchField>,
   *   snippet: string,
   *   highlightStart: int,
   *   highlightEnd: int,
   *   turnIndex?: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->field = $values['field'];
    $this->snippet = $values['snippet'];
    $this->highlightStart = $values['highlightStart'];
    $this->highlightEnd = $values['highlightEnd'];
    $this->turnIndex = $values['turnIndex'] ?? null;

    $this->_dirtyFields = [
      'field' => true,
      'snippet' => true,
      'highlight_start' => true,
      'highlight_end' => true
    ];
    if (array_key_exists('turnIndex', $values)) {
      $this->_dirtyFields['turn_index'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'field',
      'contents' => $this->field
    ];

    $parts[] = [
      'name' => 'snippet',
      'contents' => $this->snippet
    ];

    $parts[] = [
      'name' => 'highlight_start',
      'contents' => (string) $this->highlightStart
    ];

    $parts[] = [
      'name' => 'highlight_end',
      'contents' => (string) $this->highlightEnd
    ];

    if ($this->turnIndex !== null) {
      $parts[] = [
        'name' => 'turn_index',
        'contents' => (string) $this->turnIndex
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
