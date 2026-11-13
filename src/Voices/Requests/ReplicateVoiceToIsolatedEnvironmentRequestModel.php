<?php

declare(strict_types=1);

namespace ElevenLabs\Voices\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReplicateVoiceToIsolatedEnvironmentRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * ID of the workspace to replicate the voice into. It must belong to the same consolidated billing group as the calling workspace; the target's data residency is derived from that link.
   */
  #[JsonProperty('target_workspace_id', required: true)]
  public string $targetWorkspaceId;

  /**
   * When true (default) the replicated voice keeps the same voice ID in the target residency; set to false to assign a new voice ID.
   */
  #[JsonProperty('preserve_voice_id')]
  public ?bool $preserveVoiceId;

  /**
   * @param array{
   *   targetWorkspaceId: string,
   *   preserveVoiceId?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->targetWorkspaceId = $values['targetWorkspaceId'];
    $this->preserveVoiceId = $values['preserveVoiceId'] ?? null;

    $this->_dirtyFields = [
      'target_workspace_id' => true
    ];
    if (array_key_exists('preserveVoiceId', $values)) {
      $this->_dirtyFields['preserve_voice_id'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'target_workspace_id',
      'contents' => $this->targetWorkspaceId
    ];

    if ($this->preserveVoiceId !== null) {
      $parts[] = [
        'name' => 'preserve_voice_id',
        'contents' => $this->preserveVoiceId ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
