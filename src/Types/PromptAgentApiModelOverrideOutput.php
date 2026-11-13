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
class PromptAgentApiModelOverrideOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The prompt for the agent
   */
  #[JsonProperty('prompt')]
  public ?string $prompt;

  /**
   * @var ?value-of<\ElevenLabs\Types\Llm>
   * The LLM to query with the prompt and the chat history. If using data residency, the LLM must be supported in the data residency environment
   */
  #[JsonProperty('llm')]
  public ?string $llm;

  /**
   * @var ?value-of<\ElevenLabs\Types\LlmReasoningEffort>
   * Reasoning effort of the model. Only available for some models.
   */
  #[JsonProperty('reasoning_effort')]
  public ?string $reasoningEffort;

  /**
   * @var string[]|null
   * A list of IDs of tools used by the agent
   */
  #[JsonProperty('tool_ids'), ArrayType(['string'])]
  public ?array $toolIds;

  /**
   * Only applies as a conversation override, allowed whenever tool_ids may be overridden. When true, the overridden tool_ids is the full list of tools allowed in the conversation, including tools on workflow nodes. Ignored when set on the agent.
   */
  #[JsonProperty('tool_ids_strict')]
  public ?bool $toolIdsStrict;

  /**
   * @var string[]|null
   * A list of Native MCP server ids to be used by the agent
   */
  #[JsonProperty('native_mcp_server_ids'), ArrayType(['string'])]
  public ?array $nativeMcpServerIds;

  /**
   * @var \ElevenLabs\Types\KnowledgeBaseLocator[]|null
   * A list of knowledge bases to be used by the agent
   */
  #[JsonProperty('knowledge_base'), ArrayType([\ElevenLabs\Types\KnowledgeBaseLocator::class])]
  public ?array $knowledgeBase;

  /**
   * @param array{
   *   prompt?: ?string,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   reasoningEffort?: ?value-of<\ElevenLabs\Types\LlmReasoningEffort>,
   *   toolIds?: string[]|null,
   *   toolIdsStrict?: ?bool,
   *   nativeMcpServerIds?: string[]|null,
   *   knowledgeBase?: \ElevenLabs\Types\KnowledgeBaseLocator[]|null,
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
        'contents' => $this->prompt
      ];
    }

    if ($this->llm !== null) {
      $parts[] = [
        'name' => 'llm',
        'contents' => $this->llm
      ];
    }

    if ($this->reasoningEffort !== null) {
      $parts[] = [
        'name' => 'reasoning_effort',
        'contents' => $this->reasoningEffort
      ];
    }

    if ($this->toolIds !== null) {
      foreach ($this->toolIds ?? [] as $item) {
        $parts[] = [
          'name' => 'tool_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->toolIdsStrict !== null) {
      $parts[] = [
        'name' => 'tool_ids_strict',
        'contents' => $this->toolIdsStrict ? 'true' : 'false'
      ];
    }

    if ($this->nativeMcpServerIds !== null) {
      foreach ($this->nativeMcpServerIds ?? [] as $item) {
        $parts[] = [
          'name' => 'native_mcp_server_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->knowledgeBase !== null) {
      $parts[] = [
        'name' => 'knowledge_base',
        'contents' => json_encode($this->knowledgeBase),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->knowledgeBase ?? [] as $item) {
      $item->validate();
    }
  }
}
