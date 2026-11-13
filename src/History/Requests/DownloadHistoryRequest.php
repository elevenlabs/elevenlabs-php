<?php

declare(strict_types=1);

namespace ElevenLabs\History\Requests;

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
class DownloadHistoryRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * A list of history items to download, you can get IDs of history items and other metadata using the GET https://api.elevenlabs.io/v1/history endpoint.
   */
  #[JsonProperty('history_item_ids', required: true), ArrayType(['string'])]
  public array $historyItemIds;

  /**
   * Output format to transcode the audio file, can be wav or default.
   */
  #[JsonProperty('output_format')]
  public ?string $outputFormat;

  /**
   * @param array{
   *   historyItemIds: string[],
   *   outputFormat?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->historyItemIds = $values['historyItemIds'];
    $this->outputFormat = $values['outputFormat'] ?? null;

    $this->_dirtyFields = [
      'history_item_ids' => true
    ];
    if (array_key_exists('outputFormat', $values)) {
      $this->_dirtyFields['output_format'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    foreach ($this->historyItemIds as $item) {
      $parts[] = [
        'name' => 'history_item_ids',
        'contents' => $item
      ];
    }

    if ($this->outputFormat !== null) {
      $parts[] = [
        'name' => 'output_format',
        'contents' => $this->outputFormat
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
