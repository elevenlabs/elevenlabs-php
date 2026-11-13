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
class ConvAiStoredSecretDependencies extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ConvAiStoredSecretDependenciesToolsItem[]
   */
  #[
    JsonProperty('tools', required: true),
    ArrayType([\ElevenLabs\Types\ConvAiStoredSecretDependenciesToolsItem::class])
  ]
  public array $tools;

  /**
   * Whether there are more tool dependents beyond the returned preview
   */
  #[JsonProperty('tools_has_more')]
  public ?bool $toolsHasMore;

  /**
   * @var \ElevenLabs\Types\ConvAiStoredSecretDependenciesAgentsItem[]
   */
  #[
    JsonProperty('agents', required: true),
    ArrayType([\ElevenLabs\Types\ConvAiStoredSecretDependenciesAgentsItem::class])
  ]
  public array $agents;

  /**
   * Whether there are more agent dependents beyond the returned preview
   */
  #[JsonProperty('agents_has_more')]
  public ?bool $agentsHasMore;

  /**
   * @var \ElevenLabs\Types\DependentPhoneNumberIdentifier[]|null
   */
  #[
    JsonProperty('phone_numbers'),
    ArrayType([\ElevenLabs\Types\DependentPhoneNumberIdentifier::class])
  ]
  public ?array $phoneNumbers;

  /**
   * Whether there are more phone number dependents beyond the returned preview
   */
  #[JsonProperty('phone_numbers_has_more')]
  public ?bool $phoneNumbersHasMore;

  /**
   * @var \ElevenLabs\Types\ConvAiStoredSecretDependenciesMcpServersItem[]|null
   */
  #[
    JsonProperty('mcp_servers'),
    ArrayType([\ElevenLabs\Types\ConvAiStoredSecretDependenciesMcpServersItem::class])
  ]
  public ?array $mcpServers;

  /**
   * @var array<value-of<\ElevenLabs\Types\SecretDependencyType>>
   */
  #[JsonProperty('others', required: true), ArrayType(['string'])]
  public array $others;

  /**
   * @param array{
   *   tools: \ElevenLabs\Types\ConvAiStoredSecretDependenciesToolsItem[],
   *   agents: \ElevenLabs\Types\ConvAiStoredSecretDependenciesAgentsItem[],
   *   others: array<value-of<\ElevenLabs\Types\SecretDependencyType>>,
   *   toolsHasMore?: ?bool,
   *   agentsHasMore?: ?bool,
   *   phoneNumbers?: \ElevenLabs\Types\DependentPhoneNumberIdentifier[]|null,
   *   phoneNumbersHasMore?: ?bool,
   *   mcpServers?: \ElevenLabs\Types\ConvAiStoredSecretDependenciesMcpServersItem[]|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->tools = $values['tools'];
    $this->toolsHasMore = $values['toolsHasMore'] ?? null;
    $this->agents = $values['agents'];
    $this->agentsHasMore = $values['agentsHasMore'] ?? null;
    $this->phoneNumbers = $values['phoneNumbers'] ?? null;
    $this->phoneNumbersHasMore = $values['phoneNumbersHasMore'] ?? null;
    $this->mcpServers = $values['mcpServers'] ?? null;
    $this->others = $values['others'];

    $this->_dirtyFields = [
      'tools' => true,
      'agents' => true,
      'others' => true
    ];
    if (array_key_exists('toolsHasMore', $values)) {
      $this->_dirtyFields['tools_has_more'] = true;
    }
    if (array_key_exists('agentsHasMore', $values)) {
      $this->_dirtyFields['agents_has_more'] = true;
    }
    if (array_key_exists('phoneNumbers', $values)) {
      $this->_dirtyFields['phone_numbers'] = true;
    }
    if (array_key_exists('phoneNumbersHasMore', $values)) {
      $this->_dirtyFields['phone_numbers_has_more'] = true;
    }
    if (array_key_exists('mcpServers', $values)) {
      $this->_dirtyFields['mcp_servers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'tools',
      'contents' => json_encode($this->tools),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->toolsHasMore !== null) {
      $parts[] = [
        'name' => 'tools_has_more',
        'contents' => $this->toolsHasMore ? 'true' : 'false'
      ];
    }

    $parts[] = [
      'name' => 'agents',
      'contents' => json_encode($this->agents),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->agentsHasMore !== null) {
      $parts[] = [
        'name' => 'agents_has_more',
        'contents' => $this->agentsHasMore ? 'true' : 'false'
      ];
    }

    if ($this->phoneNumbers !== null) {
      $parts[] = [
        'name' => 'phone_numbers',
        'contents' => json_encode($this->phoneNumbers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->phoneNumbersHasMore !== null) {
      $parts[] = [
        'name' => 'phone_numbers_has_more',
        'contents' => $this->phoneNumbersHasMore ? 'true' : 'false'
      ];
    }

    if ($this->mcpServers !== null) {
      $parts[] = [
        'name' => 'mcp_servers',
        'contents' => json_encode($this->mcpServers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    foreach ($this->others as $item) {
      $parts[] = [
        'name' => 'others',
        'contents' => $item
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->phoneNumbers ?? [] as $item) {
      $item->validate();
    }
  }
}
