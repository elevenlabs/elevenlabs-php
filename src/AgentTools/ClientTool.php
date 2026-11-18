<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\ClientToolConfigInput;

/**
 * A tool that sends an event to the user's client. Create one with {@see Tool::client()}.
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
final class ClientTool extends Tool
{
  private const OPTIONS = [...self::COMMON_OPTIONS, 'dynamicVariablePlaceholders', 'executionMode', 'expectsResponse'];

  /**
   * @internal Use {@see Tool::client()} or {@see Tool::fromJson()}.
   * @param array<string, mixed> $config
   */
  public function __construct(array $config, private ?ObjectSchema $parameters)
  {
    parent::__construct($config);
  }

  public function kind(): string
  {
    return 'client';
  }

  /** Sets the param `$name`. Required unless the schema is `optional()`. Any kind of schema. */
  public function param(string $name, Schema $schema): self
  {
    $this->parameters = ($this->parameters ?? Schema::object())->property($name, $schema);
    return $this;
  }

  /** Removes the param `$name`. Removing one that doesn't exist does nothing. */
  public function removeParam(string $name): self
  {
    $this->parameters = $this->parameters?->without($name);
    return $this;
  }

  /** The params, as an object schema, for reading. */
  public function parametersSchema(): ?ObjectSchema
  {
    return $this->parameters;
  }

  /**
   * Validates the tool and returns only its config. See {@see Tool::buildConfig()}.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError
   */
  public function buildConfig(?callable $onWarning = null): ClientToolConfigInput
  {
    /** @var ClientToolConfigInput */
    return parent::buildConfig($onWarning);
  }

  protected function configModel(array $wire): JsonSerializableType
  {
    $model = ClientToolConfigInput::fromJson((string) json_encode($wire));
    // The generated deserializer reads nested schemas as literals; build them as the right models.
    if (is_array($wire['parameters'] ?? null)) {
      $model->parameters = ToolWire::objectModel($wire['parameters']);
    }
    return $model;
  }

  protected function allowedOptions(): array
  {
    return self::OPTIONS;
  }

  protected function validate(): array
  {
    $issues = [];
    // Checks the params object's own requireAnyOf()/requireAllOf() and every param under it.
    $this->parameters?->check('params', false, $issues);
    $timeout = $this->config['response_timeout_secs'] ?? null;
    if ((is_int($timeout) || is_float($timeout)) && $timeout != -1 && ($timeout < 1 || $timeout > 120)) {
      $issues[] = ToolIssue::error('invalid_option', 'responseTimeoutSecs', "A client tool's responseTimeoutSecs must be 1–120, or -1");
    }
    if ((is_int($timeout) || is_float($timeout)) && $timeout == -1 && ($this->config['expects_response'] ?? null) !== true) {
      $issues[] = ToolIssue::error('invalid_option', 'responseTimeoutSecs', 'responseTimeoutSecs: -1 needs expectsResponse: true');
    }
    return $issues;
  }

  protected function toWire(): array
  {
    $wire = $this->config;
    $wire['type'] = 'client';
    if ($this->parameters !== null) {
      $wire['parameters'] = $this->parameters->toWire();
    }
    return $wire;
  }
}
