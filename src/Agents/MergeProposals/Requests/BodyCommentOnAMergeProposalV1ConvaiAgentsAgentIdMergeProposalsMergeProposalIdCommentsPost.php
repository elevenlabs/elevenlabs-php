<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\MergeProposals\Requests;

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
class BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost
  extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * The comment text. Markdown is supported.
   */
  #[JsonProperty('body', required: true)]
  public string $body;

  /**
   * @param array{
   *   body: string,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->body = $values['body'];

    $this->_dirtyFields = [
      'body' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'body',
      'contents' => $this->body
    ];

    return $parts;
  }

  public function validate(): void
  {
    Validator::validateString($this->body, 'body', minLength: 1, maxLength: 4096);
  }
}
