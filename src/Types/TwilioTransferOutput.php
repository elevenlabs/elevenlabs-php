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
class TwilioTransferOutput extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var value-of<\ElevenLabs\Types\TwilioTransferOutputType>
   */
  #[JsonProperty('type', required: true)]
  public string $type;

  #[JsonProperty('config', required: true)]
  public \ElevenLabs\Types\TwilioTransferOutputConfig $config;

  /**
   * @param array{
   *   type: value-of<\ElevenLabs\Types\TwilioTransferOutputType>,
   *   config: \ElevenLabs\Types\TwilioTransferOutputConfig,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->type = $values['type'];
    $this->config = $values['config'];

    $this->_dirtyFields = [
      'type' => true,
      'config' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'type',
      'contents' => $this->type
    ];

    $parts[] = [
      'name' => 'config',
      'contents' => json_encode($this->config),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
  }
}
