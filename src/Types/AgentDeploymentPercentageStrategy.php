<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class AgentDeploymentPercentageStrategy extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\AgentDeploymentPercentageStrategyType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  /**
   * Traffic percentage to deploy
   */
  #[JsonProperty('traffic_percentage', required: true)]
  public float $trafficPercentage;

  /**
   * @param array{
   *   trafficPercentage: float,
   *   type?: ?value-of<\ElevenLabs\Types\AgentDeploymentPercentageStrategyType>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'percentage';
    $this->trafficPercentage = $values['trafficPercentage'];

    $this->_dirtyFields = [
      'traffic_percentage' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->type !== null) {
      $parts[] = [
        'name' => 'type',
        'contents' => $this->type
      ];
    }

    $parts[] = [
      'name' => 'traffic_percentage',
      'contents' => (string) $this->trafficPercentage
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->trafficPercentage, 'traffic_percentage', min: 0, max: 100);
  }
}
