<?php

declare(strict_types=1);

namespace ElevenLabs\Reception\Receptionists\TransferRules\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Utils\Validator;

/**
 * Request model for creating a new transfer rule.
 *
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class ReceptionCreateTransferRuleRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The customer workspace a reseller's API key acts on.
   */
  public string $xiWorkspaceId;

  #[JsonProperty('label', required: true)]
  public string $label;

  #[JsonProperty('phone_number', required: true)]
  public string $phoneNumber;

  #[JsonProperty('condition', required: true)]
  public string $condition;

  /**
   * DTMF digits automatically played after the transfer destination picks up (e.g. '1' to answer a 'press 1 to accept' screen, or 'www1234' to key an extension after a pause). Valid characters are 0-9, *, #, w (0.5s pause) and W (1s pause). Twilio transfers only.
   */
  #[JsonProperty('post_dial_digits')]
  public ?string $postDialDigits;

  /**
   * @param array{
   *   xiWorkspaceId: string,
   *   label: string,
   *   phoneNumber: string,
   *   condition: string,
   *   postDialDigits?: ?string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->xiWorkspaceId = $values['xiWorkspaceId'];
    $this->label = $values['label'];
    $this->phoneNumber = $values['phoneNumber'];
    $this->condition = $values['condition'];
    $this->postDialDigits = $values['postDialDigits'] ?? null;

    $this->_dirtyFields = [
      'label' => true,
      'phone_number' => true,
      'condition' => true
    ];
    if (array_key_exists('postDialDigits', $values)) {
      $this->_dirtyFields['post_dial_digits'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'label',
      'contents' => $this->label
    ];

    $parts[] = [
      'name' => 'phone_number',
      'contents' => $this->phoneNumber
    ];

    $parts[] = [
      'name' => 'condition',
      'contents' => $this->condition
    ];

    if ($this->postDialDigits !== null) {
      $parts[] = [
        'name' => 'post_dial_digits',
        'contents' => $this->postDialDigits
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString(
      $this->postDialDigits,
      'post_dial_digits',
      minLength: 1,
      maxLength: 50,
      pattern: '^[0-9*#wW]*$'
    );
  }
}
