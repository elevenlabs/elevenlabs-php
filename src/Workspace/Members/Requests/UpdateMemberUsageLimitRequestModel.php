<?php

declare(strict_types=1);

namespace ElevenLabs\Workspace\Members\Requests;

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
class UpdateMemberUsageLimitRequestModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Monthly credit usage limit for the member. Set to null to remove the limit.
   */
  #[JsonProperty('usage_limit', required: true)]
  public ?int $usageLimit;

  /**
   * @param array{
   *   usageLimit: ?int,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->usageLimit = $values['usageLimit'];

    $this->_dirtyFields = [
      'usage_limit' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'usage_limit',
      'contents' => (string) $this->usageLimit
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateNumber($this->usageLimit, 'usage_limit', min: 0);
  }
}
