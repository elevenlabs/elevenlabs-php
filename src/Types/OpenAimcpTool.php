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
class OpenAimcpTool extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAimcpToolType>
   */
  #[JsonProperty('type')]
  public ?string $type;

  #[JsonProperty('server_label', required: true)]
  public string $serverLabel;

  #[JsonProperty('server_url', required: true)]
  public string $serverUrl;

  #[JsonProperty('authorization')]
  public ?string $authorization;

  /**
   * @var string[]|null
   */
  #[JsonProperty('allowed_tools'), ArrayType(['string'])]
  public ?array $allowedTools;

  /**
   * @var ?value-of<\ElevenLabs\Types\OpenAimcpToolRequireApproval>
   */
  #[JsonProperty('require_approval')]
  public ?string $requireApproval;

  /**
   * @param array{
   *   serverLabel: string,
   *   serverUrl: string,
   *   type?: ?value-of<\ElevenLabs\Types\OpenAimcpToolType>,
   *   authorization?: ?string,
   *   allowedTools?: string[]|null,
   *   requireApproval?: ?value-of<\ElevenLabs\Types\OpenAimcpToolRequireApproval>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'] ?? 'mcp';
    $this->serverLabel = $values['serverLabel'];
    $this->serverUrl = $values['serverUrl'];
    $this->authorization = $values['authorization'] ?? null;
    $this->allowedTools = $values['allowedTools'] ?? null;
    $this->requireApproval = $values['requireApproval'] ?? null;

    $this->_dirtyFields = [
      'server_label' => true,
      'server_url' => true
    ];
    if (array_key_exists('type', $values)) {
      $this->_dirtyFields['type'] = true;
    }
    if (array_key_exists('authorization', $values)) {
      $this->_dirtyFields['authorization'] = true;
    }
    if (array_key_exists('allowedTools', $values)) {
      $this->_dirtyFields['allowed_tools'] = true;
    }
    if (array_key_exists('requireApproval', $values)) {
      $this->_dirtyFields['require_approval'] = true;
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
      'name' => 'server_label',
      'contents' => $this->serverLabel
    ];

    $parts[] = [
      'name' => 'server_url',
      'contents' => $this->serverUrl
    ];

    if ($this->authorization !== null) {
      $parts[] = [
        'name' => 'authorization',
        'contents' => $this->authorization
      ];
    }

    if ($this->allowedTools !== null) {
      foreach ($this->allowedTools ?? [] as $item) {
        $parts[] = [
          'name' => 'allowed_tools',
          'contents' => $item
        ];
      }
    }

    if ($this->requireApproval !== null) {
      $parts[] = [
        'name' => 'require_approval',
        'contents' => $this->requireApproval
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
