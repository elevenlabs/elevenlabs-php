<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;
use ElevenLabs\Utils\Validator;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class SendConversationMessageRequest extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var \ElevenLabs\Agents\Conversations\Types\SendConversationMessageRequestInputItem[]
   * Either one `user_message`, which starts a new turn, or `client_tool_result` items, which answer the `required_actions` of the waiting turn and continue it. Calls that they leave out stay pending. Client tools wait with no timeout. While calls are pending, a `user_message` is rejected. A `user_message` can come with `contextual_update` items, at most one per `context_id`. `client_tool_result` items that answer every pending call can come with `end` updates.
   */
  #[
    JsonProperty('input', required: true),
    ArrayType([
      \ElevenLabs\Agents\Conversations\Types\SendConversationMessageRequestInputItem::class
    ])
  ]
  public array $input;

  /**
   * If true, return a 202 handle after the turn is admitted instead of waiting for generation to finish.
   */
  #[JsonProperty('background')]
  public ?bool $background;

  /**
   * @param array{
   *   input: \ElevenLabs\Agents\Conversations\Types\SendConversationMessageRequestInputItem[],
   *   background?: ?bool,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->input = $values['input'];
    $this->background = $values['background'] ?? null;

    $this->_dirtyFields = [
      'input' => true
    ];
    if (array_key_exists('background', $values)) {
      $this->_dirtyFields['background'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'input',
      'contents' => json_encode($this->input),
      'headers' => ['Content-Type' => 'application/json']
    ];

    if ($this->background !== null) {
      $parts[] = [
        'name' => 'background',
        'contents' => $this->background ? 'true' : 'false'
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateArray($this->input, 'input', minItems: 1);
  }
}
