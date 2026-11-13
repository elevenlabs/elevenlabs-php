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
class AuthSettings extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * If set to true, starting a conversation with an agent will require a signed token
   */
  #[JsonProperty('enable_auth')]
  public ?bool $enableAuth;

  /**
   * @var \ElevenLabs\Types\AllowlistItem[]|null
   * A list of hosts that are allowed to start conversations with the agent
   */
  #[JsonProperty('allowlist'), ArrayType([\ElevenLabs\Types\AllowlistItem::class])]
  public ?array $allowlist;

  /**
   * When enabled, connections with no origin header will be rejected. If the allowlist is empty, this option has no effect.
   */
  #[JsonProperty('require_origin_header')]
  public ?bool $requireOriginHeader;

  /**
   * A shareable token that can be used to start a conversation with the agent
   */
  #[JsonProperty('shareable_token')]
  public ?string $shareableToken;

  /**
   * @param array{
   *   enableAuth?: ?bool,
   *   allowlist?: \ElevenLabs\Types\AllowlistItem[]|null,
   *   requireOriginHeader?: ?bool,
   *   shareableToken?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->enableAuth = $values['enableAuth'] ?? null;
    $this->allowlist = $values['allowlist'] ?? null;
    $this->requireOriginHeader = $values['requireOriginHeader'] ?? null;
    $this->shareableToken = $values['shareableToken'] ?? null;

    if (array_key_exists('enableAuth', $values)) {
      $this->_dirtyFields['enable_auth'] = true;
    }
    if (array_key_exists('allowlist', $values)) {
      $this->_dirtyFields['allowlist'] = true;
    }
    if (array_key_exists('requireOriginHeader', $values)) {
      $this->_dirtyFields['require_origin_header'] = true;
    }
    if (array_key_exists('shareableToken', $values)) {
      $this->_dirtyFields['shareable_token'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->enableAuth !== null) {
      $parts[] = [
        'name' => 'enable_auth',
        'contents' => $this->enableAuth ? 'true' : 'false'
      ];
    }

    if ($this->allowlist !== null) {
      $parts[] = [
        'name' => 'allowlist',
        'contents' => json_encode($this->allowlist),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->requireOriginHeader !== null) {
      $parts[] = [
        'name' => 'require_origin_header',
        'contents' => $this->requireOriginHeader ? 'true' : 'false'
      ];
    }

    if ($this->shareableToken !== null) {
      $parts[] = [
        'name' => 'shareable_token',
        'contents' => $this->shareableToken
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->allowlist ?? [] as $item) {
      $item->validate();
    }
  }
}
