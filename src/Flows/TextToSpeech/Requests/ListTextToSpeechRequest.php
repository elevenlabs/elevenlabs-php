<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\TextToSpeech\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Flows\TextToSpeech\Types\ListTextToSpeechRequestStatus;

class ListTextToSpeechRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize How many generations to return per page.
   */
  public ?int $pageSize;

  /**
   * @var ?value-of<ListTextToSpeechRequestStatus> $status Only return generations with this lifecycle status.
   */
  public ?string $status;

  /**
   * @var ?string $modelId Only return generations of this model.
   */
  public ?string $modelId;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   status?: ?value-of<ListTextToSpeechRequestStatus>,
   *   modelId?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->status = $values['status'] ?? null;
    $this->modelId = $values['modelId'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'cursor' => $data['cursor'] ?? null,
      'pageSize' => $data['page_size'] ?? null,
      'status' => $data['status'] ?? null,
      'modelId' => $data['model_id'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->cursor !== null) {
      $result['cursor'] = $this->cursor;
    }
    if ($this->pageSize !== null) {
      $result['page_size'] = $this->pageSize;
    }
    if ($this->status !== null) {
      $result['status'] = $this->status;
    }
    if ($this->modelId !== null) {
      $result['model_id'] = $this->modelId;
    }
    return $result;
  }
}
