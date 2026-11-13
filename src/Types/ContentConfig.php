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
class ContentConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('sexual')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $sexual;

  #[JsonProperty('violence')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $violence;

  #[JsonProperty('harassment')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $harassment;

  #[JsonProperty('self_harm')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $selfHarm;

  #[JsonProperty('profanity')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $profanity;

  #[JsonProperty('religion_or_politics')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $religionOrPolitics;

  #[JsonProperty('medical_and_legal_information')]
  public ?\ElevenLabs\Types\ContentThresholdGuardrail $medicalAndLegalInformation;

  /**
   * @param array{
   *   sexual?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   violence?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   harassment?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   selfHarm?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   profanity?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   religionOrPolitics?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   *   medicalAndLegalInformation?: ?\ElevenLabs\Types\ContentThresholdGuardrail,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->sexual = $values['sexual'] ?? null;
    $this->violence = $values['violence'] ?? null;
    $this->harassment = $values['harassment'] ?? null;
    $this->selfHarm = $values['selfHarm'] ?? null;
    $this->profanity = $values['profanity'] ?? null;
    $this->religionOrPolitics = $values['religionOrPolitics'] ?? null;
    $this->medicalAndLegalInformation = $values['medicalAndLegalInformation'] ?? null;

    if (array_key_exists('sexual', $values)) {
      $this->_dirtyFields['sexual'] = true;
    }
    if (array_key_exists('violence', $values)) {
      $this->_dirtyFields['violence'] = true;
    }
    if (array_key_exists('harassment', $values)) {
      $this->_dirtyFields['harassment'] = true;
    }
    if (array_key_exists('selfHarm', $values)) {
      $this->_dirtyFields['self_harm'] = true;
    }
    if (array_key_exists('profanity', $values)) {
      $this->_dirtyFields['profanity'] = true;
    }
    if (array_key_exists('religionOrPolitics', $values)) {
      $this->_dirtyFields['religion_or_politics'] = true;
    }
    if (array_key_exists('medicalAndLegalInformation', $values)) {
      $this->_dirtyFields['medical_and_legal_information'] = true;
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

    if ($this->harassment !== null) {
      $parts[] = [
        'name' => 'harassment',
        'contents' => json_encode($this->harassment),
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

    if ($this->profanity !== null) {
      $parts[] = [
        'name' => 'profanity',
        'contents' => json_encode($this->profanity),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->religionOrPolitics !== null) {
      $parts[] = [
        'name' => 'religion_or_politics',
        'contents' => json_encode($this->religionOrPolitics),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->medicalAndLegalInformation !== null) {
      $parts[] = [
        'name' => 'medical_and_legal_information',
        'contents' => json_encode($this->medicalAndLegalInformation),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->sexual?->validate();
    $this->violence?->validate();
    $this->harassment?->validate();
    $this->selfHarm?->validate();
    $this->profanity?->validate();
    $this->religionOrPolitics?->validate();
    $this->medicalAndLegalInformation?->validate();
  }
}
