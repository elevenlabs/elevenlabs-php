<?php

declare(strict_types=1);

namespace ElevenLabs\Flows\Templates\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;

class GetTemplatesRequest extends JsonSerializableType
{
  /**
   * @var ?int $versionsPerTemplate How many of each template's published versions to return, newest first. `has_more_versions` tells you when a template has more.
   */
  public ?int $versionsPerTemplate;

  /**
   * @param array{
   *   versionsPerTemplate?: ?int,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->versionsPerTemplate = $values['versionsPerTemplate'] ?? null;
  }

  /**
   * @param array<string, mixed> $data
   * @return self
   */
  public static function fromArray(array $data): self
  {
    return new self([
      'versionsPerTemplate' => $data['versions_per_template'] ?? null
    ]);
  }

  /**
   * @return array<string, mixed>
   */
  public function jsonSerialize(): array
  {
    $result = [];
    if ($this->versionsPerTemplate !== null) {
      $result['versions_per_template'] = $this->versionsPerTemplate;
    }
    return $result;
  }
}
