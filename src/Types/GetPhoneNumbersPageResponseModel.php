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
class GetPhoneNumbersPageResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\GetPhoneNumbersPageResponseModelPhoneNumbersItem[]
   * The phone numbers on this page
   */
  #[
    JsonProperty('phone_numbers', required: true),
    ArrayType([\ElevenLabs\Types\GetPhoneNumbersPageResponseModelPhoneNumbersItem::class])
  ]
  public array $phoneNumbers;

  /**
   * Pass this value as `cursor` to fetch the next page. Null when there are no more results.
   */
  #[JsonProperty('next_cursor')]
  public ?string $nextCursor;

  /**
   * Whether there are more results available
   */
  #[JsonProperty('has_more')]
  public ?bool $hasMore;

  /**
   * @param array{
   *   phoneNumbers: \ElevenLabs\Types\GetPhoneNumbersPageResponseModelPhoneNumbersItem[],
   *   nextCursor?: ?string,
   *   hasMore?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->phoneNumbers = $values['phoneNumbers'];
    $this->nextCursor = $values['nextCursor'] ?? null;
    $this->hasMore = $values['hasMore'] ?? null;

    $this->_dirtyFields = [
      'phone_numbers' => true
    ];
    if (array_key_exists('nextCursor', $values)) {
      $this->_dirtyFields['next_cursor'] = true;
    }
    if (array_key_exists('hasMore', $values)) {
      $this->_dirtyFields['has_more'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'phone_numbers',
      'contents' => json_encode($this->phoneNumbers),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->nextCursor !== null) {
      $parts[] = [
        'name' => 'next_cursor',
        'contents' => $this->nextCursor
      ];
    }

    if ($this->hasMore !== null) {
      $parts[] = [
        'name' => 'has_more',
        'contents' => $this->hasMore ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
