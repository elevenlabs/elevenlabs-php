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
class OutboundSipTrunkConfigRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Hostname or IP the SIP INVITE is sent to.
   */
  #[JsonProperty('address', required: true)]
  public string $address;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipTrunkTransportEnum>
   */
  #[JsonProperty('transport')]
  public ?string $transport;

  /**
   * @var ?value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>
   */
  #[JsonProperty('media_encryption')]
  public ?string $mediaEncryption;

  /**
   * @var array<string, string>|null
   * SIP X-* headers for INVITE request. These headers are sent as-is and may help identify this call.
   */
  #[JsonProperty('headers'), ArrayType(['string' => 'string'])]
  public ?array $headers;

  /**
   * @var array<string, string>|null
   * Map of dynamic variable name to header name for attributes_to_headers
   */
  #[JsonProperty('attributes_to_headers'), ArrayType(['string' => 'string'])]
  public ?array $attributesToHeaders;

  /**
   * Optional digest authentication credentials (username/password). If not provided, ACL authentication is assumed.
   */
  #[JsonProperty('credentials')]
  public ?\ElevenLabs\Types\SipTrunkCredentialsRequestModel $credentials;

  /**
   * @var array<value-of<\ElevenLabs\Types\MediaCodec>>|null
   * Media codecs that should be offered in the SDP for outbound calls. If empty, all supported codecs are offered.
   */
  #[JsonProperty('enabled_codecs'), ArrayType(['string'])]
  public ?array $enabledCodecs;

  /**
   * @param array{
   *   address: string,
   *   transport?: ?value-of<\ElevenLabs\Types\SipTrunkTransportEnum>,
   *   mediaEncryption?: ?value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>,
   *   headers?: array<string, string>|null,
   *   attributesToHeaders?: array<string, string>|null,
   *   credentials?: ?\ElevenLabs\Types\SipTrunkCredentialsRequestModel,
   *   enabledCodecs?: array<value-of<\ElevenLabs\Types\MediaCodec>>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->address = $values['address'];
    $this->transport = $values['transport'] ?? null;
    $this->mediaEncryption = $values['mediaEncryption'] ?? null;
    $this->headers = $values['headers'] ?? null;
    $this->attributesToHeaders = $values['attributesToHeaders'] ?? null;
    $this->credentials = $values['credentials'] ?? null;
    $this->enabledCodecs = $values['enabledCodecs'] ?? null;

    $this->_dirtyFields = [
      'address' => true
    ];
    if (array_key_exists('transport', $values)) {
      $this->_dirtyFields['transport'] = true;
    }
    if (array_key_exists('mediaEncryption', $values)) {
      $this->_dirtyFields['media_encryption'] = true;
    }
    if (array_key_exists('headers', $values)) {
      $this->_dirtyFields['headers'] = true;
    }
    if (array_key_exists('attributesToHeaders', $values)) {
      $this->_dirtyFields['attributes_to_headers'] = true;
    }
    if (array_key_exists('credentials', $values)) {
      $this->_dirtyFields['credentials'] = true;
    }
    if (array_key_exists('enabledCodecs', $values)) {
      $this->_dirtyFields['enabled_codecs'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'address',
      'contents' => $this->address
    ];

    if ($this->transport !== null) {
      $parts[] = [
        'name' => 'transport',
        'contents' => $this->transport
      ];
    }

    if ($this->mediaEncryption !== null) {
      $parts[] = [
        'name' => 'media_encryption',
        'contents' => $this->mediaEncryption
      ];
    }

    if ($this->headers !== null) {
      $parts[] = [
        'name' => 'headers',
        'contents' => json_encode($this->headers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->attributesToHeaders !== null) {
      $parts[] = [
        'name' => 'attributes_to_headers',
        'contents' => json_encode($this->attributesToHeaders),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->credentials !== null) {
      $parts[] = [
        'name' => 'credentials',
        'contents' => json_encode($this->credentials),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->enabledCodecs !== null) {
      foreach ($this->enabledCodecs ?? [] as $item) {
        $parts[] = [
          'name' => 'enabled_codecs',
          'contents' => $item
        ];
      }
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->credentials?->validate();
  }
}
