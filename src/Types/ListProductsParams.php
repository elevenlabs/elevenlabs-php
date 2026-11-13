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
class ListProductsParams extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var array<string, mixed>|null
   */
  #[JsonProperty('list_kwargs'), ArrayType(['string' => 'mixed'])]
  public ?array $listKwargs;

  /**
   * @var ?value-of<\ElevenLabs\Types\ListProductsParamsSmbToolType>
   */
  #[JsonProperty('smb_tool_type')]
  public ?string $smbToolType;

  /**
   * @param array{
   *   listKwargs?: array<string, mixed>|null,
   *   smbToolType?: ?value-of<\ElevenLabs\Types\ListProductsParamsSmbToolType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->listKwargs = $values['listKwargs'] ?? null;
    $this->smbToolType = $values['smbToolType'] ?? 'list_products';

    if (array_key_exists('listKwargs', $values)) {
      $this->_dirtyFields['list_kwargs'] = true;
    }
    if (array_key_exists('smbToolType', $values)) {
      $this->_dirtyFields['smb_tool_type'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->listKwargs !== null) {
      $parts[] = [
        'name' => 'list_kwargs',
        'contents' => json_encode($this->listKwargs),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->smbToolType !== null) {
      $parts[] = [
        'name' => 'smb_tool_type',
        'contents' => $this->smbToolType
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
