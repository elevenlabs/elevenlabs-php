<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Tags\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class ListTagsRequest extends JsonSerializableType
{
    /**
     * @var ?int $pageSize How many conversation tags to return. Can not exceed 100.
     */
    public ?int $pageSize;

    /**
     * @var ?string $cursor Used for fetching next page. Cursor is returned in the response.
     */
    public ?string $cursor;

    /**
     * @param array{
     *   pageSize?: ?int,
     *   cursor?: ?string,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->pageSize = $values['pageSize'] ?? null;
        $this->cursor = $values['cursor'] ?? null;
    }

    /**
     * @param array<string, mixed> $data
     * @return self
     */
    public static function fromArray(array $data): self
    {
        return new self([
            'pageSize' => $data['page_size'] ?? null,
            'cursor' => $data['cursor'] ?? null,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $result = [];
        if ($this->pageSize !== null) {
            $result['page_size'] = $this->pageSize;
        }
        if ($this->cursor !== null) {
            $result['cursor'] = $this->cursor;
        }
        return $result;
    }
}
