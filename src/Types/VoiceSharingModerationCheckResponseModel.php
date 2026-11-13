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
class VoiceSharingModerationCheckResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The date the moderation check was made in Unix time.
   */
  #[JsonProperty('date_checked_unix')]
  public ?int $dateCheckedUnix;

  /**
   * The name value of the voice.
   */
  #[JsonProperty('name_value')]
  public ?string $nameValue;

  /**
   * Whether the name check was successful.
   */
  #[JsonProperty('name_check')]
  public ?bool $nameCheck;

  /**
   * The description value of the voice.
   */
  #[JsonProperty('description_value')]
  public ?string $descriptionValue;

  /**
   * Whether the description check was successful.
   */
  #[JsonProperty('description_check')]
  public ?bool $descriptionCheck;

  /**
   * @var string[]|null
   * A list of sample IDs.
   */
  #[JsonProperty('sample_ids'), ArrayType(['string'])]
  public ?array $sampleIds;

  /**
   * @var float[]|null
   * A list of sample checks.
   */
  #[JsonProperty('sample_checks'), ArrayType(['float'])]
  public ?array $sampleChecks;

  /**
   * @var string[]|null
   * A list of captcha IDs.
   */
  #[JsonProperty('captcha_ids'), ArrayType(['string'])]
  public ?array $captchaIds;

  /**
   * @var float[]|null
   * A list of CAPTCHA check values.
   */
  #[JsonProperty('captcha_checks'), ArrayType(['float'])]
  public ?array $captchaChecks;

  /**
   * @param array{
   *   dateCheckedUnix?: ?int,
   *   nameValue?: ?string,
   *   nameCheck?: ?bool,
   *   descriptionValue?: ?string,
   *   descriptionCheck?: ?bool,
   *   sampleIds?: string[]|null,
   *   sampleChecks?: float[]|null,
   *   captchaIds?: string[]|null,
   *   captchaChecks?: float[]|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->dateCheckedUnix = $values['dateCheckedUnix'] ?? null;
    $this->nameValue = $values['nameValue'] ?? null;
    $this->nameCheck = $values['nameCheck'] ?? null;
    $this->descriptionValue = $values['descriptionValue'] ?? null;
    $this->descriptionCheck = $values['descriptionCheck'] ?? null;
    $this->sampleIds = $values['sampleIds'] ?? null;
    $this->sampleChecks = $values['sampleChecks'] ?? null;
    $this->captchaIds = $values['captchaIds'] ?? null;
    $this->captchaChecks = $values['captchaChecks'] ?? null;

    if (array_key_exists('dateCheckedUnix', $values)) {
      $this->_dirtyFields['date_checked_unix'] = true;
    }
    if (array_key_exists('nameValue', $values)) {
      $this->_dirtyFields['name_value'] = true;
    }
    if (array_key_exists('nameCheck', $values)) {
      $this->_dirtyFields['name_check'] = true;
    }
    if (array_key_exists('descriptionValue', $values)) {
      $this->_dirtyFields['description_value'] = true;
    }
    if (array_key_exists('descriptionCheck', $values)) {
      $this->_dirtyFields['description_check'] = true;
    }
    if (array_key_exists('sampleIds', $values)) {
      $this->_dirtyFields['sample_ids'] = true;
    }
    if (array_key_exists('sampleChecks', $values)) {
      $this->_dirtyFields['sample_checks'] = true;
    }
    if (array_key_exists('captchaIds', $values)) {
      $this->_dirtyFields['captcha_ids'] = true;
    }
    if (array_key_exists('captchaChecks', $values)) {
      $this->_dirtyFields['captcha_checks'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->dateCheckedUnix !== null) {
      $parts[] = [
        'name' => 'date_checked_unix',
        'contents' => (string) $this->dateCheckedUnix
      ];
    }

    if ($this->nameValue !== null) {
      $parts[] = [
        'name' => 'name_value',
        'contents' => $this->nameValue
      ];
    }

    if ($this->nameCheck !== null) {
      $parts[] = [
        'name' => 'name_check',
        'contents' => $this->nameCheck ? 'true' : 'false'
      ];
    }

    if ($this->descriptionValue !== null) {
      $parts[] = [
        'name' => 'description_value',
        'contents' => $this->descriptionValue
      ];
    }

    if ($this->descriptionCheck !== null) {
      $parts[] = [
        'name' => 'description_check',
        'contents' => $this->descriptionCheck ? 'true' : 'false'
      ];
    }

    if ($this->sampleIds !== null) {
      foreach ($this->sampleIds ?? [] as $item) {
        $parts[] = [
          'name' => 'sample_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->sampleChecks !== null) {
      foreach ($this->sampleChecks ?? [] as $item) {
        $parts[] = [
          'name' => 'sample_checks',
          'contents' => (string) $item
        ];
      }
    }

    if ($this->captchaIds !== null) {
      foreach ($this->captchaIds ?? [] as $item) {
        $parts[] = [
          'name' => 'captcha_ids',
          'contents' => $item
        ];
      }
    }

    if ($this->captchaChecks !== null) {
      foreach ($this->captchaChecks ?? [] as $item) {
        $parts[] = [
          'name' => 'captcha_checks',
          'contents' => (string) $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
