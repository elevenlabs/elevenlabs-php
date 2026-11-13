<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * User-to-User Information envelope for SIP REFER transfers (RFC 7433).
 *
 * Outbound payloads are hex-encoded (the only encoding RFC 7433 defines). The
 * protocol discriminator axis lets per-platform formats (Talkdesk, Genesys, ...)
 * be expressed by configuration rather than scattered transfer flags. Further
 * axes (ASCII encoding, header name, purpose/content parameters) can be added
 * here without touching the transfer model.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UuiTransferConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * UUI payload to send on SIP REFER transfers. Supports inline dynamic variables and is hex-encoded at transfer time.
   */
  #[JsonProperty('data', required: true)]
  public string $data;

  /**
   * Optional one-octet protocol discriminator (two hex digits, e.g. '00'). Required by platforms such as Genesys Cloud, which otherwise strip the first octet of the payload. Leave unset for platforms like Talkdesk that expect a bare hex payload.
   */
  #[JsonProperty('protocol_discriminator')]
  public ?string $protocolDiscriminator;

  /**
   * @var ?value-of<\ElevenLabs\Types\UuiTransferConfigProtocolDiscriminatorMode>
   * How to attach protocol_discriminator. 'prefix' prepends the octet to the hex payload (User-to-User=XX<hex>;encoding=hex). 'pd_parameter' sends it as a separate parameter (User-to-User=<hex>;pd=XX;encoding=hex). Ignored when protocol_discriminator is unset.
   */
  #[JsonProperty('protocol_discriminator_mode')]
  public ?string $protocolDiscriminatorMode;

  /**
   * @param array{
   *   data: string,
   *   protocolDiscriminator?: ?string,
   *   protocolDiscriminatorMode?: ?value-of<\ElevenLabs\Types\UuiTransferConfigProtocolDiscriminatorMode>,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->data = $values['data'];
    $this->protocolDiscriminator = $values['protocolDiscriminator'] ?? null;
    $this->protocolDiscriminatorMode = $values['protocolDiscriminatorMode'] ?? null;

    $this->_dirtyFields = [
      'data' => true
    ];
    if (array_key_exists('protocolDiscriminator', $values)) {
      $this->_dirtyFields['protocol_discriminator'] = true;
    }
    if (array_key_exists('protocolDiscriminatorMode', $values)) {
      $this->_dirtyFields['protocol_discriminator_mode'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'data',
      'contents' => $this->data
    ];

    if ($this->protocolDiscriminator !== null) {
      $parts[] = [
        'name' => 'protocol_discriminator',
        'contents' => $this->protocolDiscriminator
      ];
    }

    if ($this->protocolDiscriminatorMode !== null) {
      $parts[] = [
        'name' => 'protocol_discriminator_mode',
        'contents' => $this->protocolDiscriminatorMode
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->data, 'data', maxLength: 8192);
    Validator::validateString(
      $this->protocolDiscriminator,
      'protocol_discriminator',
      pattern: '^[0-9A-Fa-f]{2}$'
    );
  }
}
