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
class TextToDialogueClientMessage extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\TextToDialogueClientMessageInputsItem[]|null
   */
  #[
    JsonProperty('inputs'),
    ArrayType([\ElevenLabs\Types\TextToDialogueClientMessageInputsItem::class])
  ]
  public ?array $inputs;

  #[JsonProperty('flush')]
  public ?bool $flush;

  #[JsonProperty('close_socket')]
  public ?bool $closeSocket;

  #[JsonProperty('keep_alive')]
  public ?bool $keepAlive;

  #[JsonProperty('xi_api_key')]
  public ?string $xiApiKey;

  #[JsonProperty('authorization')]
  public ?string $authorization;

  #[JsonProperty('single_use_token')]
  public ?string $singleUseToken;

  /**
   * @var string[]|null
   * List of voice IDs to register for the connection.
   */
  #[JsonProperty('voices'), ArrayType(['string'])]
  public ?array $voices;

  /**
   * Voice settings for the connection.
   */
  #[JsonProperty('voice_settings')]
  public ?\ElevenLabs\Types\TextToDialogueClientMessageVoiceSettings $voiceSettings;

  /**
   * @var \ElevenLabs\Types\TextToDialogueClientMessagePronunciationDictionaryLocatorsItem[]|null
   */
  #[
    JsonProperty('pronunciation_dictionary_locators'),
    ArrayType([
      \ElevenLabs\Types\TextToDialogueClientMessagePronunciationDictionaryLocatorsItem::class
    ])
  ]
  public ?array $pronunciationDictionaryLocators;

  /**
   * @param array{
   *   inputs?: \ElevenLabs\Types\TextToDialogueClientMessageInputsItem[]|null,
   *   flush?: ?bool,
   *   closeSocket?: ?bool,
   *   keepAlive?: ?bool,
   *   xiApiKey?: ?string,
   *   authorization?: ?string,
   *   singleUseToken?: ?string,
   *   voices?: string[]|null,
   *   voiceSettings?: ?\ElevenLabs\Types\TextToDialogueClientMessageVoiceSettings,
   *   pronunciationDictionaryLocators?: \ElevenLabs\Types\TextToDialogueClientMessagePronunciationDictionaryLocatorsItem[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->inputs = $values['inputs'] ?? null;
    $this->flush = $values['flush'] ?? null;
    $this->closeSocket = $values['closeSocket'] ?? null;
    $this->keepAlive = $values['keepAlive'] ?? null;
    $this->xiApiKey = $values['xiApiKey'] ?? null;
    $this->authorization = $values['authorization'] ?? null;
    $this->singleUseToken = $values['singleUseToken'] ?? null;
    $this->voices = $values['voices'] ?? null;
    $this->voiceSettings = $values['voiceSettings'] ?? null;
    $this->pronunciationDictionaryLocators = $values['pronunciationDictionaryLocators'] ?? null;

    if (array_key_exists('inputs', $values)) {
      $this->_dirtyFields['inputs'] = true;
    }
    if (array_key_exists('flush', $values)) {
      $this->_dirtyFields['flush'] = true;
    }
    if (array_key_exists('closeSocket', $values)) {
      $this->_dirtyFields['close_socket'] = true;
    }
    if (array_key_exists('keepAlive', $values)) {
      $this->_dirtyFields['keep_alive'] = true;
    }
    if (array_key_exists('xiApiKey', $values)) {
      $this->_dirtyFields['xi_api_key'] = true;
    }
    if (array_key_exists('authorization', $values)) {
      $this->_dirtyFields['authorization'] = true;
    }
    if (array_key_exists('singleUseToken', $values)) {
      $this->_dirtyFields['single_use_token'] = true;
    }
    if (array_key_exists('voices', $values)) {
      $this->_dirtyFields['voices'] = true;
    }
    if (array_key_exists('voiceSettings', $values)) {
      $this->_dirtyFields['voice_settings'] = true;
    }
    if (array_key_exists('pronunciationDictionaryLocators', $values)) {
      $this->_dirtyFields['pronunciation_dictionary_locators'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->inputs !== null) {
      $parts[] = [
        'name' => 'inputs',
        'contents' => json_encode($this->inputs),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->flush !== null) {
      $parts[] = [
        'name' => 'flush',
        'contents' => $this->flush ? 'true' : 'false'
      ];
    }

    if ($this->closeSocket !== null) {
      $parts[] = [
        'name' => 'close_socket',
        'contents' => $this->closeSocket ? 'true' : 'false'
      ];
    }

    if ($this->keepAlive !== null) {
      $parts[] = [
        'name' => 'keep_alive',
        'contents' => $this->keepAlive ? 'true' : 'false'
      ];
    }

    if ($this->xiApiKey !== null) {
      $parts[] = [
        'name' => 'xi_api_key',
        'contents' => $this->xiApiKey
      ];
    }

    if ($this->authorization !== null) {
      $parts[] = [
        'name' => 'authorization',
        'contents' => $this->authorization
      ];
    }

    if ($this->singleUseToken !== null) {
      $parts[] = [
        'name' => 'single_use_token',
        'contents' => $this->singleUseToken
      ];
    }

    if ($this->voices !== null) {
      foreach ($this->voices ?? [] as $item) {
        $parts[] = [
          'name' => 'voices',
          'contents' => $item
        ];
      }
    }

    if ($this->voiceSettings !== null) {
      $parts[] = [
        'name' => 'voice_settings',
        'contents' => json_encode($this->voiceSettings),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->pronunciationDictionaryLocators !== null) {
      $parts[] = [
        'name' => 'pronunciation_dictionary_locators',
        'contents' => json_encode($this->pronunciationDictionaryLocators),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->inputs ?? [] as $item) {
      $item->validate();
    }
    $this->voiceSettings?->validate();
    foreach ($this->pronunciationDictionaryLocators ?? [] as $item) {
      $item->validate();
    }
  }
}
