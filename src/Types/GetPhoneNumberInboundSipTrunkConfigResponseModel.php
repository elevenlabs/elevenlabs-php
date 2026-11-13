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
class GetPhoneNumberInboundSipTrunkConfigResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var string[]
   * List of IP addresses that are allowed to use the trunk. Each item in the list can be an individual IP address or a Classless Inter-Domain Routing notation representing a CIDR block.
   */
  #[JsonProperty('allowed_addresses', required: true), ArrayType(['string'])]
  public array $allowedAddresses;

  /**
   * @var string[]|null
   * List of phone numbers that are allowed to use the trunk.
   */
  #[JsonProperty('allowed_numbers', required: true), ArrayType(['string'])]
  public ?array $allowedNumbers;

  /**
   * @var value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>
   */
  #[JsonProperty('media_encryption', required: true)]
  public string $mediaEncryption;

  /**
   * Whether authentication credentials are configured
   */
  #[JsonProperty('has_auth_credentials', required: true)]
  public bool $hasAuthCredentials;

  /**
   * SIP trunk username (if available)
   */
  #[JsonProperty('username')]
  public ?string $username;

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
   *   allowedAddresses: string[],
   *   allowedNumbers: string[]|null,
   *   mediaEncryption: value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>,
   *   hasAuthCredentials: bool,
   *   username?: ?string,
   *   remoteDomains?: string[]|null,
   *   attributesToHeaders?: array<string, string>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->allowedAddresses = $values['allowedAddresses'];
    $this->allowedNumbers = $values['allowedNumbers'];
    $this->mediaEncryption = $values['mediaEncryption'];
    $this->hasAuthCredentials = $values['hasAuthCredentials'];
    $this->username = $values['username'] ?? null;
    $this->remoteDomains = $values['remoteDomains'] ?? null;
    $this->attributesToHeaders = $values['attributesToHeaders'] ?? null;

    $this->_dirtyFields = [
      'allowed_addresses' => true,
      'allowed_numbers' => true,
      'media_encryption' => true,
      'has_auth_credentials' => true
    ];
    if (array_key_exists('username', $values)) {
      $this->_dirtyFields['username'] = true;
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
    foreach ($this->allowedAddresses as $item) {
      $parts[] = [
        'name' => 'allowed_addresses',
        'contents' => $item
      ];
    }

    foreach ($this->allowedNumbers ?? [] as $item) {
      $parts[] = [
        'name' => 'allowed_numbers',
        'contents' => $item
      ];
    }

    $parts[] = [
      'name' => 'media_encryption',
      'contents' => $this->mediaEncryption
    ];

    $parts[] = [
      'name' => 'has_auth_credentials',
      'contents' => $this->hasAuthCredentials ? 'true' : 'false'
    ];

    if ($this->username !== null) {
      $parts[] = [
        'name' => 'username',
        'contents' => $this->username
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
  }
}
