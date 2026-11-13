<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Tags\Requests;

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
class CreateConversationTagRequestModel extends JsonSerializableType
{
	use ReflectiveSerialization;

	/**
	 * Display title of the tag.
	 */
	#[JsonProperty('title', required: true)]
	public string $title;

	/**
	 * Optional free-text description.
	 */
	#[JsonProperty('description')]
	public ?string $description;



    /**
     * @param array{
     *   title: string,
     *   description?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
		$this->title = $values['title'];
		$this->description = $values['description'] ?? null;

		$this->_dirtyFields = [
			'title' => true
		];
		if (array_key_exists('description', $values)) {
			$this->_dirtyFields['description'] = true;
		}
    }


      public function toMultipart(): array
      {
          $parts = [];
          $parts[] = [
                  'name' => 'title',
                  'contents' => $this->title,
              ];

          if ($this->description !== null) {
              $parts[] = [
                  'name' => 'description',
                  'contents' => $this->description,
              ];
          }

          return $parts;
      }
    
    public function validate(): void
    {
        Validator::validateString($this->title, 'title', minLength: 1, maxLength: 120);
        Validator::validateString($this->description, 'description', maxLength: 1000);
    }


}
