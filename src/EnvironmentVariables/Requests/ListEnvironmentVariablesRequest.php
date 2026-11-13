<?php

declare(strict_types=1);

namespace ElevenLabs\EnvironmentVariables\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\EnvironmentVariables\Types\ListEnvironmentVariablesRequestType;

class ListEnvironmentVariablesRequest extends JsonSerializableType
{
  /**
   * @var ?string $cursor Pagination cursor from previous response
   */
  public ?string $cursor;

  /**
   * @var ?int $pageSize Number of items to return (1-100)
   */
  public ?int $pageSize;

  /**
   * @var ?string $label Filter by exact label match
   */
  public ?string $label;

  /**
   * @var ?string $environment Filter to only return variables that have this environment. When specified, the values dict in the response will only contain this environment.
   */
  public ?string $environment;

  /**
   * @var ?value-of<ListEnvironmentVariablesRequestType> $type Filter by variable type
   */
  public ?string $type;

  /**
   * @param array{
   *   cursor?: ?string,
   *   pageSize?: ?int,
   *   label?: ?string,
   *   environment?: ?string,
   *   type?: ?value-of<ListEnvironmentVariablesRequestType>,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->cursor = $values['cursor'] ?? null;
    $this->pageSize = $values['pageSize'] ?? null;
    $this->label = $values['label'] ?? null;
    $this->environment = $values['environment'] ?? null;
    $this->type = $values['type'] ?? null;
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
      'label' => $data['label'] ?? null,
      'environment' => $data['environment'] ?? null,
      'type' => $data['type'] ?? null
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
    if ($this->label !== null) {
      $result['label'] = $this->label;
    }
    if ($this->environment !== null) {
      $result['environment'] = $this->environment;
    }
    if ($this->type !== null) {
      $result['type'] = $this->type;
    }
    return $result;
  }
}
