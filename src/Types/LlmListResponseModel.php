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
class LlmListResponseModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Types\LlmInfoModel[]
   * List of all available LLM models that can be used with agents.
   */
  #[JsonProperty('llms', required: true), ArrayType([\ElevenLabs\Types\LlmInfoModel::class])]
  public array $llms;

  #[JsonProperty('default_deprecation_config', required: true)]
  public \ElevenLabs\Types\LlmDeprecationConfigModel $defaultDeprecationConfig;

  /**
   * @param array{
   *   llms: \ElevenLabs\Types\LlmInfoModel[],
   *   defaultDeprecationConfig: \ElevenLabs\Types\LlmDeprecationConfigModel,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->llms = $values['llms'];
    $this->defaultDeprecationConfig = $values['defaultDeprecationConfig'];

    $this->_dirtyFields = [
      'llms' => true,
      'default_deprecation_config' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'llms',
      'contents' => json_encode($this->llms),
      'headers' => ['Content-Type' => 'application/json']
    ];

    $parts[] = [
      'name' => 'default_deprecation_config',
      'contents' => json_encode($this->defaultDeprecationConfig),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    foreach ($this->llms as $item) {
      $item->validate();
    }
    $this->defaultDeprecationConfig->validate();
  }
}
