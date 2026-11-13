<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * SIP Trunk configuration details for a phone number
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class GetPhoneNumberOutboundSipTrunkConfigResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Hostname or IP the SIP INVITE is sent to
   */
  #[JsonProperty('address', required: true)]
  public string $address;

  /**
   * @var value-of<\ElevenLabs\Types\SipTrunkTransportEnum>
   */
  #[JsonProperty('transport', required: true)]
  public string $transport;

  /**
   * @var value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>
   */
  #[JsonProperty('media_encryption', required: true)]
  public string $mediaEncryption;

  /**
   * @var array<string, string>|null
   * SIP headers for INVITE request
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
   * Whether a LiveKit SIP outbound trunk is configured
   */
  #[JsonProperty('has_outbound_trunk')]
  public ?bool $hasOutboundTrunk;

  /**
   * @var array<value-of<\ElevenLabs\Types\MediaCodec>>|null
   * Media codecs that are offered in the SDP for outbound calls. If empty, all supported codecs are offered.
   */
  #[JsonProperty('enabled_codecs'), ArrayType(['string'])]
  public ?array $enabledCodecs;

  /**
   * @param array{
   *   address: string,
   *   transport: value-of<\ElevenLabs\Types\SipTrunkTransportEnum>,
   *   mediaEncryption: value-of<\ElevenLabs\Types\SipMediaEncryptionEnum>,
   *   hasAuthCredentials: bool,
   *   headers?: array<string, string>|null,
   *   attributesToHeaders?: array<string, string>|null,
   *   username?: ?string,
   *   hasOutboundTrunk?: ?bool,
   *   enabledCodecs?: array<value-of<\ElevenLabs\Types\MediaCodec>>|null,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->address = $values['address'];
    $this->transport = $values['transport'];
    $this->mediaEncryption = $values['mediaEncryption'];
    $this->headers = $values['headers'] ?? null;
    $this->attributesToHeaders = $values['attributesToHeaders'] ?? null;
    $this->hasAuthCredentials = $values['hasAuthCredentials'];
    $this->username = $values['username'] ?? null;
    $this->hasOutboundTrunk = $values['hasOutboundTrunk'] ?? null;
    $this->enabledCodecs = $values['enabledCodecs'] ?? null;

    $this->_dirtyFields = [
      'address' => true,
      'transport' => true,
      'media_encryption' => true,
      'has_auth_credentials' => true
    ];
    if (array_key_exists('headers', $values)) {
      $this->_dirtyFields['headers'] = true;
    }
    if (array_key_exists('attributesToHeaders', $values)) {
      $this->_dirtyFields['attributes_to_headers'] = true;
    }
    if (array_key_exists('username', $values)) {
      $this->_dirtyFields['username'] = true;
    }
    if (array_key_exists('hasOutboundTrunk', $values)) {
      $this->_dirtyFields['has_outbound_trunk'] = true;
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

    $parts[] = [
      'name' => 'transport',
      'contents' => $this->transport
    ];

    $parts[] = [
      'name' => 'media_encryption',
      'contents' => $this->mediaEncryption
    ];

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

    if ($this->hasOutboundTrunk !== null) {
      $parts[] = [
        'name' => 'has_outbound_trunk',
        'contents' => $this->hasOutboundTrunk ? 'true' : 'false'
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
  }
}
