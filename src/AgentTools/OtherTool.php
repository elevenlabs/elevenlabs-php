<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\ToolRequestModelToolConfig;

/**
 * A loaded tool of a type the builder has no constructor for, such as `mcp`. Kept exactly as
 * loaded: it round-trips through `toJson()`, but can't be edited. Its kind is `"other"`.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class OtherTool extends Tool
{
  /**
   * @internal Use {@see Tool::fromJson()}.
   * @param array<string, mixed> $raw The whole tool config in wire format, `type` included.
   */
  public function __construct(array $raw)
  {
    parent::__construct($raw);
  }

  public function kind(): string
  {
    return 'other';
  }

  /** The loaded `type`, e.g. `"mcp"`. */
  public function type(): string
  {
    $type = $this->config['type'] ?? '';
    return is_string($type) ? $type : '';
  }

  /**
   * Validates the tool and returns its config as the generated union model.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError
   */
  public function buildConfig(?callable $onWarning = null): ToolRequestModelToolConfig
  {
    /** @var ToolRequestModelToolConfig */
    return parent::buildConfig($onWarning);
  }

  protected function configModel(array $wire): JsonSerializableType
  {
    return ToolRequestModelToolConfig::fromJson((string) json_encode($wire));
  }

  protected function allowedOptions(): array
  {
    return [];
  }

  protected function validate(): array
  {
    return [
      new ToolIssue(
        'unknown_tool_type',
        'warning',
        "Tool \"{$this->name()}\" has type \"{$this->type()}\", which this SDK can't edit. It round-trips "
          . "through toJson(), but build()'s output may be rejected by tools->create() and tools->update()"
      ),
    ];
  }

  protected function toWire(): array
  {
    return $this->config;
  }
}
