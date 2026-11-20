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
class AgentMessagesOverrides extends JsonSerializableType
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
   * Language of the agent
   */
  #[JsonProperty('language')]
  public ?string $language;

  /**
   * @var string[]|null
   * If set, only these tools are available in the conversation, including tools on workflow nodes. Each ID must be attached to the agent.
   */
  #[JsonProperty('tool_ids'), ArrayType(['string'])]
  public ?array $toolIds;

  /**
   * @var string[]|null
   * If set, the agent uses only these native MCP servers. Each ID must be attached to the agent.
   */
  #[JsonProperty('native_mcp_server_ids'), ArrayType(['string'])]
  public ?array $nativeMcpServerIds;

  /**
   * @var string[]|null
   * If set, the agent uses only these knowledge base documents. Each ID must be attached to the agent.
   */
  #[JsonProperty('knowledge_base_ids'), ArrayType(['string'])]
  public ?array $knowledgeBaseIds;

  /**
   * @var string[]|null
   * If set, only these procedures are available to the starting agent. Each ID must be attached to that agent. An empty list disables all of that agent's procedures. Not applied after an agent transfer. Requires enable_procedure_ids_from_client.
   */
  #[JsonProperty('procedure_ids'), ArrayType(['string'])]
  public ?array $procedureIds;

  /**
   * @var array<string, mixed>|null
   * Extra fields for the request body that goes to the custom LLM.
   */
  #[JsonProperty('custom_llm_extra_body'), ArrayType(['string' => 'mixed'])]
  public ?array $customLlmExtraBody;

  /**
   * @param array{
   *   prompt?: ?string,
   *   llm?: ?value-of<\ElevenLabs\Types\Llm>,
   *   language?: ?string,
   *   toolIds?: string[]|null,
   *   nativeMcpServerIds?: string[]|null,
   *   knowledgeBaseIds?: string[]|null,
   *   procedureIds?: string[]|null,
   *   customLlmExtraBody?: array<string, mixed>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->prompt = $values['prompt'] ?? null;
    $this->llm = $values['llm'] ?? null;
    $this->language = $values['language'] ?? null;
    $this->toolIds = $values['toolIds'] ?? null;
    $this->nativeMcpServerIds = $values['nativeMcpServerIds'] ?? null;
    $this->knowledgeBaseIds = $values['knowledgeBaseIds'] ?? null;
    $this->procedureIds = $values['procedureIds'] ?? null;
    $this->customLlmExtraBody = $values['customLlmExtraBody'] ?? null;

    if (array_key_exists('prompt', $values)) {
      $this->_dirtyFields['prompt'] = true;
    }
    if (array_key_exists('llm', $values)) {
      $this->_dirtyFields['llm'] = true;
    }
    if (array_key_exists('language', $values)) {
      $this->_dirtyFields['language'] = true;
    }
    if (array_key_exists('toolIds', $values)) {
      $this->_dirtyFields['tool_ids'] = true;
    }
    if (array_key_exists('nativeMcpServerIds', $values)) {
      $this->_dirtyFields['native_mcp_server_ids'] = true;
    }
    if (array_key_exists('knowledgeBaseIds', $values)) {
      $this->_dirtyFields['knowledge_base_ids'] = true;
    }
    if (array_key_exists('procedureIds', $values)) {
      $this->_dirtyFields['procedure_ids'] = true;
    }
    if (array_key_exists('customLlmExtraBody', $values)) {
      $this->_dirtyFields['custom_llm_extra_body'] = true;
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

    if ($this->language !== null) {
      $parts[] = [
        'name' => 'language',
        'contents' => $this->language
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

    if ($this->nativeMcpServerIds !== null) {
      foreach ($this->nativeMcpServerIds ?? [] as $item) {
        $parts[] = [
          'name' => 'native_mcp_server_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->knowledgeBaseIds !== null) {
      foreach ($this->knowledgeBaseIds ?? [] as $item) {
        $parts[] = [
          'name' => 'knowledge_base_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->procedureIds !== null) {
      foreach ($this->procedureIds ?? [] as $item) {
        $parts[] = [
          'name' => 'procedure_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->customLlmExtraBody !== null) {
      $parts[] = [
        'name' => 'custom_llm_extra_body',
        'contents' => json_encode($this->customLlmExtraBody),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
