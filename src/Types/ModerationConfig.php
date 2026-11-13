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
class ModerationConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('sexual')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $sexual;

  #[JsonProperty('violence')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $violence;

  #[JsonProperty('violence_graphic')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $violenceGraphic;

  #[JsonProperty('harassment')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $harassment;

  #[JsonProperty('harassment_threatening')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $harassmentThreatening;

  #[JsonProperty('hate')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $hate;

  #[JsonProperty('hate_threatening')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $hateThreatening;

  #[JsonProperty('self_harm_instructions')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $selfHarmInstructions;

  #[JsonProperty('self_harm')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $selfHarm;

  #[JsonProperty('self_harm_intent')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $selfHarmIntent;

  #[JsonProperty('sexual_minors')]
  public ?\ElevenLabs\Types\ThresholdGuardrail $sexualMinors;

  /**
   * @param array{
   *   sexual?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   violence?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   violenceGraphic?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   harassment?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   harassmentThreatening?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   hate?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   hateThreatening?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   selfHarmInstructions?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   selfHarm?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   selfHarmIntent?: ?\ElevenLabs\Types\ThresholdGuardrail,
   *   sexualMinors?: ?\ElevenLabs\Types\ThresholdGuardrail,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sexual = $values['sexual'] ?? null;
    $this->violence = $values['violence'] ?? null;
    $this->violenceGraphic = $values['violenceGraphic'] ?? null;
    $this->harassment = $values['harassment'] ?? null;
    $this->harassmentThreatening = $values['harassmentThreatening'] ?? null;
    $this->hate = $values['hate'] ?? null;
    $this->hateThreatening = $values['hateThreatening'] ?? null;
    $this->selfHarmInstructions = $values['selfHarmInstructions'] ?? null;
    $this->selfHarm = $values['selfHarm'] ?? null;
    $this->selfHarmIntent = $values['selfHarmIntent'] ?? null;
    $this->sexualMinors = $values['sexualMinors'] ?? null;

    if (array_key_exists('sexual', $values)) {
      $this->_dirtyFields['sexual'] = true;
    }
    if (array_key_exists('violence', $values)) {
      $this->_dirtyFields['violence'] = true;
    }
    if (array_key_exists('violenceGraphic', $values)) {
      $this->_dirtyFields['violence_graphic'] = true;
    }
    if (array_key_exists('harassment', $values)) {
      $this->_dirtyFields['harassment'] = true;
    }
    if (array_key_exists('harassmentThreatening', $values)) {
      $this->_dirtyFields['harassment_threatening'] = true;
    }
    if (array_key_exists('hate', $values)) {
      $this->_dirtyFields['hate'] = true;
    }
    if (array_key_exists('hateThreatening', $values)) {
      $this->_dirtyFields['hate_threatening'] = true;
    }
    if (array_key_exists('selfHarmInstructions', $values)) {
      $this->_dirtyFields['self_harm_instructions'] = true;
    }
    if (array_key_exists('selfHarm', $values)) {
      $this->_dirtyFields['self_harm'] = true;
    }
    if (array_key_exists('selfHarmIntent', $values)) {
      $this->_dirtyFields['self_harm_intent'] = true;
    }
    if (array_key_exists('sexualMinors', $values)) {
      $this->_dirtyFields['sexual_minors'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->sexual !== null) {
      $parts[] = [
        'name' => 'sexual',
        'contents' => json_encode($this->sexual),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->violence !== null) {
      $parts[] = [
        'name' => 'violence',
        'contents' => json_encode($this->violence),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->violenceGraphic !== null) {
      $parts[] = [
        'name' => 'violence_graphic',
        'contents' => json_encode($this->violenceGraphic),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->harassment !== null) {
      $parts[] = [
        'name' => 'harassment',
        'contents' => json_encode($this->harassment),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->harassmentThreatening !== null) {
      $parts[] = [
        'name' => 'harassment_threatening',
        'contents' => json_encode($this->harassmentThreatening),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->hate !== null) {
      $parts[] = [
        'name' => 'hate',
        'contents' => json_encode($this->hate),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->hateThreatening !== null) {
      $parts[] = [
        'name' => 'hate_threatening',
        'contents' => json_encode($this->hateThreatening),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->selfHarmInstructions !== null) {
      $parts[] = [
        'name' => 'self_harm_instructions',
        'contents' => json_encode($this->selfHarmInstructions),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->selfHarm !== null) {
      $parts[] = [
        'name' => 'self_harm',
        'contents' => json_encode($this->selfHarm),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->selfHarmIntent !== null) {
      $parts[] = [
        'name' => 'self_harm_intent',
        'contents' => json_encode($this->selfHarmIntent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->sexualMinors !== null) {
      $parts[] = [
        'name' => 'sexual_minors',
        'contents' => json_encode($this->sexualMinors),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sexual?->validate();
    $this->violence?->validate();
    $this->violenceGraphic?->validate();
    $this->harassment?->validate();
    $this->harassmentThreatening?->validate();
    $this->hate?->validate();
    $this->hateThreatening?->validate();
    $this->selfHarmInstructions?->validate();
    $this->selfHarm?->validate();
    $this->selfHarmIntent?->validate();
    $this->sexualMinors?->validate();
  }
}
