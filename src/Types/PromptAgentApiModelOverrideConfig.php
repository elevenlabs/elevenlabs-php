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
class PromptAgentApiModelOverrideConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Whether to allow overriding the prompt field.
   */
  #[JsonProperty('prompt')]
  public ?bool $prompt;

  /**
   * Whether to allow overriding the llm field.
   */
  #[JsonProperty('llm')]
  public ?bool $llm;

  /**
   * Whether to allow overriding the reasoning_effort field.
   */
  #[JsonProperty('reasoning_effort')]
  public ?bool $reasoningEffort;

  /**
   * Whether to allow overriding the tool_ids field.
   */
  #[JsonProperty('tool_ids')]
  public ?bool $toolIds;

  /**
   * Whether to allow overriding the tool_ids_strict field.
   */
  #[JsonProperty('tool_ids_strict')]
  public ?bool $toolIdsStrict;

  /**
   * Whether to allow overriding the native_mcp_server_ids field.
   */
  #[JsonProperty('native_mcp_server_ids')]
  public ?bool $nativeMcpServerIds;

  /**
   * Whether to allow overriding the knowledge_base field.
   */
  #[JsonProperty('knowledge_base')]
  public ?bool $knowledgeBase;

  /**
   * @param array{
   *   prompt?: ?bool,
   *   llm?: ?bool,
   *   reasoningEffort?: ?bool,
   *   toolIds?: ?bool,
   *   toolIdsStrict?: ?bool,
   *   nativeMcpServerIds?: ?bool,
   *   knowledgeBase?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->prompt = $values['prompt'] ?? null;
    $this->llm = $values['llm'] ?? null;
    $this->reasoningEffort = $values['reasoningEffort'] ?? null;
    $this->toolIds = $values['toolIds'] ?? null;
    $this->toolIdsStrict = $values['toolIdsStrict'] ?? null;
    $this->nativeMcpServerIds = $values['nativeMcpServerIds'] ?? null;
    $this->knowledgeBase = $values['knowledgeBase'] ?? null;

    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('reasoningEffort', $values)) {
      $this->_dirtyFields['reasoning_effort'] = true;
    }
    if (array_key_exists('toolIds', $values)) {
      $this->_dirtyFields['tool_ids'] = true;
    }
    if (array_key_exists('toolIdsStrict', $values)) {
      $this->_dirtyFields['tool_ids_strict'] = true;
    }
    if (array_key_exists('nativeMcpServerIds', $values)) {
      $this->_dirtyFields['native_mcp_server_ids'] = true;
    }
    if (array_key_exists('knowledgeBase', $values)) {
      $this->_dirtyFields['knowledge_base'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->prompt !== null) {
      $parts[] = [
        'name' => 'prompt',
        'contents' => $this->prompt ? 'true' : 'false'
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm ? 'true' : 'false'
      ];
    }

    if ($this->reasoningEffort !== null) {
      $parts[] = [
        'name' => 'reasoning_effort',
        'contents' => $this->reasoningEffort ? 'true' : 'false'
      ];
    }

    if ($this->toolIds !== null) {
      $parts[] = [
        'name' => 'tool_ids',
        'contents' => $this->toolIds ? 'true' : 'false'
      ];
    }

    if ($this->toolIdsStrict !== null) {
      $parts[] = [
        'name' => 'tool_ids_strict',
        'contents' => $this->toolIdsStrict ? 'true' : 'false'
      ];
    }

    if ($this->nativeMcpServerIds !== null) {
      $parts[] = [
        'name' => 'native_mcp_server_ids',
        'contents' => $this->nativeMcpServerIds ? 'true' : 'false'
      ];
    }

    if ($this->knowledgeBase !== null) {
      $parts[] = [
        'name' => 'knowledge_base',
        'contents' => $this->knowledgeBase ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
