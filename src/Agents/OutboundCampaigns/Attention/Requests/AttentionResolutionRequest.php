<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\OutboundCampaigns\Attention\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class AttentionResolutionRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * How the item was handled.
   */
  #[JsonProperty('resolution', required: true)]
  public string $resolution;

  /**
   * @param array{
   *   resolution: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->resolution = $values['resolution'];

    $this->_dirtyFields = [
      'resolution' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'resolution',
      'contents' => $this->resolution
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->resolution, 'resolution', minLength: 1, maxLength: 1000);
  }
}
