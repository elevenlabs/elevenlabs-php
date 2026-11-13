<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost extends
  JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * `true` forces every key in the workspace to be disable-able by its holder; `false` forbids it for every key; `null` clears the override (per-key values and the plan default apply).
   */
  #[JsonProperty('third_party_disable_allowed')]
  public ?bool $thirdPartyDisableAllowed;

  /**
   * @param array{
   *   thirdPartyDisableAllowed?: ?bool,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->thirdPartyDisableAllowed = $values['thirdPartyDisableAllowed'] ?? null;

    if (array_key_exists('thirdPartyDisableAllowed', $values)) {
      $this->_dirtyFields['third_party_disable_allowed'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->thirdPartyDisableAllowed !== null) {
      $parts[] = [
        'name' => 'third_party_disable_allowed',
        'contents' => $this->thirdPartyDisableAllowed ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
