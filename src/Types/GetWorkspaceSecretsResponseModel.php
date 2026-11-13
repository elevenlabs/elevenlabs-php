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
class GetWorkspaceSecretsResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\ConvAiWorkspaceStoredSecretConfig[]
   */
  #[
    JsonProperty('secrets', required: true),
    ArrayType([\ElevenLabs\Types\ConvAiWorkspaceStoredSecretConfig::class])
  ]
  public array $secrets;

  /**
   * Cursor for fetching the next page of secrets
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * @param array{
   *   secrets: \ElevenLabs\Types\ConvAiWorkspaceStoredSecretConfig[],
   *   nextCursor?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->secrets = $values['secrets'];
    $this->nextCursor = $values['nextCursor'] ?? null;

    $this->_dirtyFields = [
      'secrets' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'secrets',
      'contents' => json_encode($this->secrets),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->secrets as $item) {
      $item->validate();
    }
  }
}
