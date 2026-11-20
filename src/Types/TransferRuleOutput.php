<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

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
class TransferRuleOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\TransferRuleOutputProviderConfigsItem[]
   * At most one transfer configuration per telephony provider. A provider without an entry cannot use this transfer rule.
   */
  #[
    JsonProperty('provider_configs', required: true),
    ArrayType([\ElevenLabs\Types\TransferRuleOutputProviderConfigsItem::class])
  ]
  public array $providerConfigs;

  /**
   * When the agent should pick this transfer. Supports dynamic variables.
   */
  #[JsonProperty('condition', required: true)]
  public string $condition;

  /**
   * @param array{
   *   providerConfigs: \ElevenLabs\Types\TransferRuleOutputProviderConfigsItem[],
   *   condition: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->providerConfigs = $values['providerConfigs'];
    $this->condition = $values['condition'];

    $this->_dirtyFields = [
      'provider_configs' => true,
      'condition' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'provider_configs',
      'contents' => json_encode($this->providerConfigs),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'condition',
      'contents' => $this->condition
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
