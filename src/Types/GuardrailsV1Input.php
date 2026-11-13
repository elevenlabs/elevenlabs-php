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
class GuardrailsV1Input extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\GuardrailsV1InputVersion>
   */
  #[JsonProperty('version')]
  public ?string $version;

  #[JsonProperty('focus')]
  public ?\ElevenLabs\Types\FocusGuardrail $focus;

  #[JsonProperty('prompt_injection')]
  public ?\ElevenLabs\Types\PromptInjectionGuardrail $promptInjection;

  #[JsonProperty('content')]
  public ?\ElevenLabs\Types\ContentGuardrailInput $content;

  /**
   * Container for custom guardrails, matching ModerationGuardrail pattern
   */
  #[JsonProperty('custom')]
  public ?\ElevenLabs\Types\CustomGuardrailInput $custom;

  /**
   * @param array{
   *   version?: ?value-of<\ElevenLabs\Types\GuardrailsV1InputVersion>,
   *   focus?: ?\ElevenLabs\Types\FocusGuardrail,
   *   promptInjection?: ?\ElevenLabs\Types\PromptInjectionGuardrail,
   *   content?: ?\ElevenLabs\Types\ContentGuardrailInput,
   *   custom?: ?\ElevenLabs\Types\CustomGuardrailInput,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->version = $values['version'] ?? '1';
    $this->focus = $values['focus'] ?? null;
    $this->promptInjection = $values['promptInjection'] ?? null;
    $this->content = $values['content'] ?? null;
    $this->custom = $values['custom'] ?? null;

    if (array_key_exists('version', $values)) {
      $this->_dirtyFields['version'] = true;
    }
    if (array_key_exists('focus', $values)) {
      $this->_dirtyFields['focus'] = true;
    }
    if (array_key_exists('promptInjection', $values)) {
      $this->_dirtyFields['prompt_injection'] = true;
    }
    if (array_key_exists('content', $values)) {
      $this->_dirtyFields['content'] = true;
    }
    if (array_key_exists('custom', $values)) {
      $this->_dirtyFields['custom'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->version !== null) {
      $parts[] = [
        'name' => 'version',
        'contents' => $this->version
      ];
    }

    if ($this->focus !== null) {
      $parts[] = [
        'name' => 'focus',
        'contents' => json_encode($this->focus),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->promptInjection !== null) {
      $parts[] = [
        'name' => 'prompt_injection',
        'contents' => json_encode($this->promptInjection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->content !== null) {
      $parts[] = [
        'name' => 'content',
        'contents' => json_encode($this->content),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->custom !== null) {
      $parts[] = [
        'name' => 'custom',
        'contents' => json_encode($this->custom),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->focus?->validate();
    $this->promptInjection?->validate();
    $this->content?->validate();
    $this->custom?->validate();
  }
}
