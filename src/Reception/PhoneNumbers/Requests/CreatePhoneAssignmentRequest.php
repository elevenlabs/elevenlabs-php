<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\PhoneNumbers\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * Body for giving a receptionist a phone number.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class CreatePhoneAssignmentRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  /**
   * The receptionist that answers calls to the number.
   */
  #[JsonProperty('customer_facing_agent_id', required: true)]
  public string $customerFacingAgentId;

  /**
   * @var string[]|null
   * Preferred US or Canadian area codes, e.g. `["415", "628"]`. Codes outside the business's country are ignored, and any number is given when none of these is available.
   */
  #[JsonProperty('area_codes'), ArrayType(['string'])]
  public ?array $areaCodes;

  /**
   * @var ?value-of<\ElevenLabs\Types\ApplicationNumberType>
   * Local or mobile, in a country that requires paperwork before a number takes calls. Leave unset to try mobile first. Ignored in the US and Canada.
   */
  #[JsonProperty('number_type')]
  public ?string $numberType;

  /**
   * Client-generated key that makes a retry safe. The same key and body within 24 hours returns the first result without running again. While that first request is still running, a retry gets 409 `idempotency_key_in_progress`; a different body with the same key gets 400 `idempotency_key_reused`. A request that fails is not saved, so it can be retried with the same key.
   */
  #[JsonProperty('idempotency_key')]
  public ?string $idempotencyKey;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   customerFacingAgentId: string,
   *   areaCodes?: string[]|null,
   *   numberType?: ?value-of<\ElevenLabs\Types\ApplicationNumberType>,
   *   idempotencyKey?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->customerFacingAgentId = $values['customerFacingAgentId'];
    $this->areaCodes = $values['areaCodes'] ?? null;
    $this->numberType = $values['numberType'] ?? null;
    $this->idempotencyKey = $values['idempotencyKey'] ?? null;

    $this->_dirtyFields = [
      'customer_facing_agent_id' => true
    ];
    if (array_key_exists('areaCodes', $values)) {
      $this->_dirtyFields['area_codes'] = true;
    }
    if (array_key_exists('numberType', $values)) {
      $this->_dirtyFields['number_type'] = true;
    }
    if (array_key_exists('idempotencyKey', $values)) {
      $this->_dirtyFields['idempotency_key'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'customer_facing_agent_id',
      'contents' => $this->customerFacingAgentId
    ];

    if ($this->areaCodes !== null) {
      foreach ($this->areaCodes ?? [] as $item) {
        $parts[] = [
          'name' => 'area_codes',
          'contents' => $item
        ];
      }
    }

    if ($this->numberType !== null) {
      $parts[] = [
        'name' => 'number_type',
        'contents' => $this->numberType
      ];
    }

    if ($this->idempotencyKey !== null) {
      $parts[] = [
        'name' => 'idempotency_key',
        'contents' => $this->idempotencyKey
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->idempotencyKey, 'idempotency_key', maxLength: 255);
  }
}
