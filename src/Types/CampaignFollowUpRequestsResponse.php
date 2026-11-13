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
class CampaignFollowUpRequestsResponse extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('callbacks', required: true)]
  public \ElevenLabs\Types\FollowUpRequestCounts $callbacks;

  #[JsonProperty('redirects', required: true)]
  public \ElevenLabs\Types\FollowUpRequestCounts $redirects;

  /**
   * @param array{
   *   callbacks: \ElevenLabs\Types\FollowUpRequestCounts,
   *   redirects: \ElevenLabs\Types\FollowUpRequestCounts,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->callbacks = $values['callbacks'];
    $this->redirects = $values['redirects'];

    $this->_dirtyFields = [
      'callbacks' => true,
      'redirects' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'callbacks',
      'contents' => json_encode($this->callbacks),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'redirects',
      'contents' => json_encode($this->redirects),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->callbacks->validate();
    $this->redirects->validate();
  }
}
