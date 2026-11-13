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
class ConversationVoiceRewardModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('voice_id', required: true)]
  public string $voiceId;

  #[JsonProperty('reward_usd_cents', required: true)]
  public float $rewardUsdCents;

  /**
   * @param array{
   *   voiceId: string,
   *   rewardUsdCents: float,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->voiceId = $values['voiceId'];
    $this->rewardUsdCents = $values['rewardUsdCents'];

    $this->_dirtyFields = [
      'voice_id' => true,
      'reward_usd_cents' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'voice_id',
      'contents' => $this->voiceId
    ];

    $parts[] = [
      'name' => 'reward_usd_cents',
      'contents' => (string) $this->rewardUsdCents
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
