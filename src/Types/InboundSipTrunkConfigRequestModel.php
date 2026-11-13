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
class InboundSipTrunkConfigRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]|null
   * List of IP addresses that are allowed to use the trunk. Each item in the list can be an individual IP address or a Classless Inter-Domain Routing notation representing a CIDR block.
   */
  #[JsonProperty('allowed_addresses'), ArrayType(['string'])]
  public ?array $allowedAddresses;

  /**
   * @var string[]|null
   * List of phone numbers that are allowed to use the trunk.
   */
  #[JsonProperty('allowed_numbers'), ArrayType(['string'])]
  public ?array $allowedNumbers;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>
   */
  #[JsonProperty('media_encryption')]
  public ?string $mediaEncryption;

  /**
   * Optional digest authentication credentials (username/password).
   */
  #[JsonProperty('credentials')]
  public ?\ElevenLabs\Types\SipTrunkCredentialsRequestModel $credentials;

  /**
   * @var string[]|null
   * Domains of remote SIP servers used to validate TLS certificates.
   */
  #[JsonProperty('remote_domains'), ArrayType(['string'])]
  public ?array $remoteDomains;

  /**
   * @var array<string, string>|null
   * Map of dynamic variable name to header name for attributes_to_headers
   */
  #[JsonProperty('attributes_to_headers'), ArrayType(['string' => 'string'])]
  public ?array $attributesToHeaders;

  /**
   * @param array{
   *   allowedAddresses?: string[]|null,
   *   allowedNumbers?: string[]|null,
   *   mediaEncryption?: ?value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>,
   *   credentials?: ?\ElevenLabs\Types\SipTrunkCredentialsRequestModel,
   *   remoteDomains?: string[]|null,
   *   attributesToHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->allowedAddresses = $values['allowedAddresses'] ?? null;
    $this->allowedNumbers = $values['allowedNumbers'] ?? null;
    $this->mediaEncryption = $values['mediaEncryption'] ?? null;
    $this->credentials = $values['credentials'] ?? null;
    $this->remoteDomains = $values['remoteDomains'] ?? null;
    $this->attributesToHeaders = $values['attributesToHeaders'] ?? null;

    if (array_key_exists('allowedAddresses', $values)) {
      $this->_dirtyFields['allowed_addresses'] = true;
    }
    if (array_key_exists('allowedNumbers', $values)) {
      $this->_dirtyFields['allowed_numbers'] = true;
    }
    if (array_key_exists('mediaEncryption', $values)) {
      $this->_dirtyFields['media_encryption'] = true;
    }
    if (array_key_exists('credentials', $values)) {
      $this->_dirtyFields['credentials'] = true;
    }
    if (array_key_exists('remoteDomains', $values)) {
      $this->_dirtyFields['remote_domains'] = true;
    }
    if (array_key_exists('attributesToHeaders', $values)) {
      $this->_dirtyFields['attributes_to_headers'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->allowedAddresses !== null) {
      foreach ($this->allowedAddresses ?? [] as $item) {
        $parts[] = [
          'name' => 'allowed_addresses',
          'contents' => $item
        ];
      }
    }

    if ($this->allowedNumbers !== null) {
      foreach ($this->allowedNumbers ?? [] as $item) {
        $parts[] = [
          'name' => 'allowed_numbers',
          'contents' => $item
        ];
      }
    }

    if ($this->mediaEncryption !== null) {
      $parts[] = [
        'name' => 'media_encryption',
        'contents' => $this->mediaEncryption
      ];
    }

    if ($this->credentials !== null) {
      $parts[] = [
        'name' => 'credentials',
        'contents' => json_encode($this->credentials),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->remoteDomains !== null) {
      foreach ($this->remoteDomains ?? [] as $item) {
        $parts[] = [
          'name' => 'remote_domains',
          'contents' => $item
        ];
      }
    }

    if ($this->attributesToHeaders !== null) {
      $parts[] = [
        'name' => 'attributes_to_headers',
        'contents' => json_encode($this->attributesToHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->credentials?->validate();
  }
}
