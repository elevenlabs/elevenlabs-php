<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Tests\Invocations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class UpdateTestSuiteInvocationRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * New name for the test invocation. Set to null to restore the generated title.
   */
  #[JsonProperty('name', required: true)]
  public ?string $name;

  /**
   * @param array{
   *   name: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->name = $values['name'];

    $this->_dirtyFields = [
      'name' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'name',
      'contents' => $this->name
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->name, 'name', minLength: 1, maxLength: 256);
  }
}
