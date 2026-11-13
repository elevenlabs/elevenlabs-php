<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Tags\Requests;

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
class AssignConversationTagsRequestModel extends JsonSerializableType
{
	use ReflectiveSerialization;

	/**
	 * @var string[]
	 * Tag IDs to add to the conversation. Re-assigning an existing tag is a no-op.
	 */
	#[JsonProperty('tag_ids', required: true), ArrayType(['string'])]
	public array $tagIds;



    /**
     * @param array{
     *   tagIds: string[],
     * } $values
     */
    public function __construct(
        array $values,
    ) {
		$this->tagIds = $values['tagIds'];

		$this->_dirtyFields = [
			'tag_ids' => true
		];
    }


      public function toMultipart(): array
      {
          $parts = [];
          foreach ($this->tagIds as $item) {
              $parts[] = [
                  'name' => 'tag_ids',
                  'contents' => $item,
              ];
          }

          return $parts;
      }
    
    public function validate(): void
    {
        Validator::validateArray($this->tagIds, 'tag_ids', minItems: 1, maxItems: 50);
    }


}
