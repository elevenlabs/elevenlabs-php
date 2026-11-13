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
class WorkspaceWebhookUsageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\WebhookUsageType>
   */
  #[JsonProperty('usage_type', required: true)]
  public string $usageType;

  /**
   * @param array{
   *   usageType: value-of<\ElevenLabs\Types\WebhookUsageType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->usageType = $values['usageType'];

    $this->_dirtyFields = [
      'usage_type' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'usage_type',
      'contents' => $this->usageType
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
