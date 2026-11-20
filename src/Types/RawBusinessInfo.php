<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * Business profile data extracted from a single page.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class RawBusinessInfo extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('company_name')]
  public ?string $companyName;

  #[JsonProperty('description')]
  public ?string $description;

  #[JsonProperty('business_phone')]
  public ?string $businessPhone;

  /**
   * @var \ElevenLabs\Types\RawLocationInfo[]|null
   */
  #[JsonProperty('locations'), ArrayType([\ElevenLabs\Types\RawLocationInfo::class])]
  public ?array $locations;

  #[JsonProperty('business_country')]
  public ?string $businessCountry;

  #[JsonProperty('business_state')]
  public ?string $businessState;

  #[JsonProperty('suggested_currency')]
  public ?string $suggestedCurrency;

  #[JsonProperty('suggested_language')]
  public ?string $suggestedLanguage;

  /**
   * @param array{
   *   companyName?: ?string,
   *   description?: ?string,
   *   businessPhone?: ?string,
   *   locations?: \ElevenLabs\Types\RawLocationInfo[]|null,
   *   businessCountry?: ?string,
   *   businessState?: ?string,
   *   suggestedCurrency?: ?string,
   *   suggestedLanguage?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->companyName = $values['companyName'] ?? null;
    $this->description = $values['description'] ?? null;
    $this->businessPhone = $values['businessPhone'] ?? null;
    $this->locations = $values['locations'] ?? null;
    $this->businessCountry = $values['businessCountry'] ?? null;
    $this->businessState = $values['businessState'] ?? null;
    $this->suggestedCurrency = $values['suggestedCurrency'] ?? null;
    $this->suggestedLanguage = $values['suggestedLanguage'] ?? null;

    if (array_key_exists('companyName', $values)) {
      $this->_dirtyFields['company_name'] = true;
    }
    if (array_key_exists('description', $values)) {
      $this->_dirtyFields['description'] = true;
    }
    if (array_key_exists('businessPhone', $values)) {
      $this->_dirtyFields['business_phone'] = true;
    }
    if (array_key_exists('locations', $values)) {
      $this->_dirtyFields['locations'] = true;
    }
    if (array_key_exists('businessCountry', $values)) {
      $this->_dirtyFields['business_country'] = true;
    }
    if (array_key_exists('businessState', $values)) {
      $this->_dirtyFields['business_state'] = true;
    }
    if (array_key_exists('suggestedCurrency', $values)) {
      $this->_dirtyFields['suggested_currency'] = true;
    }
    if (array_key_exists('suggestedLanguage', $values)) {
      $this->_dirtyFields['suggested_language'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->companyName !== null) {
      $parts[] = [
        'name' => 'company_name',
        'contents' => $this->companyName
      ];
    }

    if ($this->description !== null) {
      $parts[] = [
        'name' => 'description',
        'contents' => $this->description
      ];
    }

    if ($this->businessPhone !== null) {
      $parts[] = [
        'name' => 'business_phone',
        'contents' => $this->businessPhone
      ];
    }

    if ($this->locations !== null) {
      $parts[] = [
        'name' => 'locations',
        'contents' => json_encode($this->locations),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->businessCountry !== null) {
      $parts[] = [
        'name' => 'business_country',
        'contents' => $this->businessCountry
      ];
    }

    if ($this->businessState !== null) {
      $parts[] = [
        'name' => 'business_state',
        'contents' => $this->businessState
      ];
    }

    if ($this->suggestedCurrency !== null) {
      $parts[] = [
        'name' => 'suggested_currency',
        'contents' => $this->suggestedCurrency
      ];
    }

    if ($this->suggestedLanguage !== null) {
      $parts[] = [
        'name' => 'suggested_language',
        'contents' => $this->suggestedLanguage
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->locations ?? [] as $item) {
      $item->validate();
    }
  }
}
