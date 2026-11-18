<?php

declare(strict_types=1);

namespace ElevenLabs\AgentTools;

use ElevenLabs\AgentWorkflows\Wire;
use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Types\ClientToolConfigInput;
use ElevenLabs\Types\PreToolSpeechMode;
use ElevenLabs\Types\ResponseFilter;
use ElevenLabs\Types\SystemToolConfigInput;
use ElevenLabs\Types\ToolCallSoundBehavior;
use ElevenLabs\Types\ToolCallSoundType;
use ElevenLabs\Types\ToolErrorHandlingMode;
use ElevenLabs\Types\ToolExecutionMode;
use ElevenLabs\Types\ToolInterruptionMode;
use ElevenLabs\Types\ToolRequestModel;
use ElevenLabs\Types\ToolRequestModelToolConfig;
use ElevenLabs\Types\ToolResponseModel;
use ElevenLabs\Types\WebhookToolApiSchemaConfigInputContentType;
use ElevenLabs\Types\WebhookToolConfigInput;

/**
 * An agent tool, written as code. Create one with {@see Tool::webhook()}, {@see Tool::client()}
 * or a {@see SystemTool} constructor, or load one with {@see Tool::fromJson()} /
 * {@see Tool::fromResponse()}.
 *
 *     use ElevenLabs\AgentTools\Header;
 *     use ElevenLabs\AgentTools\Schema;
 *     use ElevenLabs\AgentTools\Tool;
 *
 *     $getOrder = Tool::webhook('get_order', 'Look up an order by the number the caller gives')
 *         ->get('https://api.example.com/orders/{order_id}')
 *         ->pathParam('order_id', Schema::string()->describe('The order number, e.g. A-1042'))
 *         ->header('Authorization', Header::secret('sec_orders_api'))
 *         ->options(responseTimeoutSecs: 10);
 *     $tool = $client->agents->tools->create($getOrder->build());
 *
 * Hand-written (see `.fernignore`), mirroring the tool builder in the Python/TS SDKs.
 */
abstract class Tool
{
  protected const COMMON_OPTIONS = [
    'name',
    'description',
    'responseTimeoutSecs',
    'interruptionMode',
    'preToolSpeech',
    'toolCallSound',
    'toolCallSoundBehavior',
    'toolErrorHandlingMode',
  ];

  /**
   * Problems found while chaining, reported by `build()`.
   *
   * @var list<ToolIssue>
   */
  protected array $issues = [];

  /**
   * @param array<string, mixed> $config The tool config in wire format, except the parts
   *   subclasses keep in their own fields. Use the static constructors.
   */
  protected function __construct(protected array $config)
  {
  }

  /** A tool the server runs by calling an HTTP endpoint. Set the method and URL with `get()`, `post()`… */
  public static function webhook(string $name, string $description): WebhookTool
  {
    return new WebhookTool(['name' => $name, 'description' => $description], []);
  }

  /** A tool that sends an event to the user's client. */
  public static function client(string $name, string $description): ClientTool
  {
    return new ClientTool(['name' => $name, 'description' => $description], null);
  }

  /**
   * Loads a tool stored in API format (snake_case), for example from `toJsonString()` or a CLI
   * `tool_configs/*.json` file. Accepts a JSON string, a parsed array or a generated model: a
   * tool config, or a request or response with a `tool_config` key. Returns a tool of the
   * matching kind; narrow it with `asWebhook()`, `asClient()` or `asSystem()`.
   *
   * @param string|array<string, mixed>|object $data
   */
  public static function fromJson(string|array|object $data): Tool
  {
    $parsed = ToolWire::parse($data);
    /** @var array<string, mixed> $raw */
    $raw = is_array($parsed['tool_config'] ?? null) ? $parsed['tool_config'] : $parsed;
    $type = $raw['type'] ?? null;
    if ($type !== 'webhook' && $type !== 'client' && $type !== 'system') {
      return new OtherTool($raw);
    }
    $config = $raw;
    unset($config['type']);
    if ($type === 'webhook') {
      return WebhookTool::load($config);
    }
    if ($type === 'client') {
      $parameters = $config['parameters'] ?? null;
      unset($config['parameters']);
      /** @var ObjectSchema|null $schema */
      $schema = is_array($parameters) ? Schema::fromWire($parameters, false, 'object') : null;
      return new ClientTool($config, $schema);
    }
    $params = is_array($config['params'] ?? null) ? $config['params'] : [];
    unset($config['params']);
    $systemToolType = (string) ($params['system_tool_type'] ?? '');
    unset($params['system_tool_type']);
    return new SystemTool($systemToolType, $config, $params);
  }

  /** Loads the result of `tools->get()`. */
  public static function fromResponse(ToolResponseModel $response): Tool
  {
    return self::fromJson(Wire::toWire($response->toolConfig));
  }

  /** `"webhook"`, `"client"`, `"system"`, or `"other"` for a loaded tool of a type this SDK can't edit. */
  abstract public function kind(): string;

  /** The tool's name, as the LLM sees it. */
  public function name(): string
  {
    $name = $this->config['name'] ?? '';
    return is_string($name) ? $name : '';
  }

  /**
   * Sets options for this kind of tool. Options left as null are unchanged; `build()` reports one
   * that doesn't apply (`invalid_option`).
   *
   * All tools: `name`, `description`, `responseTimeoutSecs`, `interruptionMode`, `preToolSpeech`,
   * `toolCallSound`, `toolCallSoundBehavior`, `toolErrorHandlingMode`. Webhook tools also take
   * `dynamicVariablePlaceholders`, `executionMode`, `contentType`, `responseFilter`,
   * `followRedirects` and `followRedirectsAllowedDomains`; client tools `dynamicVariablePlaceholders`,
   * `executionMode` and `expectsResponse` (wait for the client to respond, and pass its response
   * to the LLM).
   *
   * @param array<string, mixed>|null $dynamicVariablePlaceholders
   * @param ResponseFilter|array<string, mixed>|null $responseFilter
   * @param list<string>|null $followRedirectsAllowedDomains
   */
  public function options(
    ?string $name = null,
    ?string $description = null,
    ?int $responseTimeoutSecs = null,
    ToolInterruptionMode|string|null $interruptionMode = null,
    PreToolSpeechMode|string|null $preToolSpeech = null,
    ToolCallSoundType|string|null $toolCallSound = null,
    ToolCallSoundBehavior|string|null $toolCallSoundBehavior = null,
    ToolErrorHandlingMode|string|null $toolErrorHandlingMode = null,
    ?array $dynamicVariablePlaceholders = null,
    ToolExecutionMode|string|null $executionMode = null,
    WebhookToolApiSchemaConfigInputContentType|string|null $contentType = null,
    ResponseFilter|array|null $responseFilter = null,
    ?bool $followRedirects = null,
    ?array $followRedirectsAllowedDomains = null,
    ?bool $expectsResponse = null,
  ): static {
    $given = [
      'name' => $name,
      'description' => $description,
      'responseTimeoutSecs' => $responseTimeoutSecs,
      'interruptionMode' => $interruptionMode,
      'preToolSpeech' => $preToolSpeech,
      'toolCallSound' => $toolCallSound,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariablePlaceholders' => $dynamicVariablePlaceholders,
      'executionMode' => $executionMode,
      'contentType' => $contentType,
      'responseFilter' => $responseFilter,
      'followRedirects' => $followRedirects,
      'followRedirectsAllowedDomains' => $followRedirectsAllowedDomains,
      'expectsResponse' => $expectsResponse,
    ];
    foreach ($given as $key => $value) {
      if ($value === null) {
        continue;
      }
      if (!in_array($key, $this->allowedOptions(), true)) {
        $this->issues[] = ToolIssue::error('invalid_option', $key, "Option \"{$key}\" doesn't apply to {$this->kind()} tools");
        continue;
      }
      if ($key === 'dynamicVariablePlaceholders' && $value === []) {
        $value = new \stdClass();
      }
      $this->setOption(self::snake($key), Wire::toWire($value));
    }
    return $this;
  }

  /** This tool as a {@see WebhookTool}, or null if it's another kind. */
  public function asWebhook(): ?WebhookTool
  {
    return $this instanceof WebhookTool ? $this : null;
  }

  /** This tool as a {@see ClientTool}, or null if it's another kind. */
  public function asClient(): ?ClientTool
  {
    return $this instanceof ClientTool ? $this : null;
  }

  /** This tool as a {@see SystemTool}, or null if it's another kind. */
  public function asSystem(): ?SystemTool
  {
    return $this instanceof SystemTool ? $this : null;
  }

  /**
   * Validates the tool and returns it as the model `tools->create()` and `tools->update()`
   * accept. `$onWarning` is called for each non-fatal problem.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError listing every problem, if the tool is invalid
   */
  public function build(?callable $onWarning = null): ToolRequestModel
  {
    $config = $this->buildConfig($onWarning);
    $toolConfig = match (true) {
      $config instanceof WebhookToolConfigInput => ToolRequestModelToolConfig::webhook($config),
      $config instanceof ClientToolConfigInput => ToolRequestModelToolConfig::client($config),
      $config instanceof SystemToolConfigInput => ToolRequestModelToolConfig::system($config),
      $config instanceof ToolRequestModelToolConfig => $config,
      default => throw new \LogicException('Unexpected tool config model ' . get_class($config)),
    };
    return new ToolRequestModel(['toolConfig' => $toolConfig]);
  }

  /**
   * Validates the tool and returns only its config: the generated `WebhookToolConfigInput` or
   * `ClientToolConfigInput`, or for a system tool the `SystemToolConfigInput` that goes in the
   * agent's `prompt.builtInTools`. Create webhook and client tools with
   * `tools->create($tool->build())` and attach them by id in `prompt.toolIds`; the inline
   * `prompt.tools` field is deprecated, can't be combined with `toolIds`, and replaces
   * `builtInTools` with the system tools it contains.
   *
   * @param null|callable(ToolIssue): mixed $onWarning
   * @throws ToolValidationError listing every problem, if the tool is invalid
   */
  public function buildConfig(?callable $onWarning = null): JsonSerializableType
  {
    return $this->configModel($this->checkedWire($onWarning));
  }

  /**
   * The tool config in API format (snake_case keys, sorted at every level), the shape of a CLI
   * `tool_configs/*.json` file. Validates like `build()`.
   *
   * @return array<string, mixed>
   * @throws ToolValidationError
   */
  public function toJson(): array
  {
    /** @var array<string, mixed> $canonical */
    $canonical = Wire::canonical($this->checkedWire(null));
    return $canonical;
  }

  /**
   * `toJson()` as a string with 2-space indentation and a trailing newline: the canonical file format.
   *
   * @throws ToolValidationError
   */
  public function toJsonString(): string
  {
    return Wire::encode($this->toJson());
  }

  /** @return list<string> */
  abstract protected function allowedOptions(): array;

  /**
   * Problems that need the finished tool.
   *
   * @return list<ToolIssue>
   */
  abstract protected function validate(): array;

  /**
   * The whole tool config in wire format.
   *
   * @return array<string, mixed>
   */
  abstract protected function toWire(): array;

  /**
   * The generated config model for a validated wire-format config.
   *
   * @param array<string, mixed> $wire
   */
  abstract protected function configModel(array $wire): JsonSerializableType;

  protected function setOption(string $key, mixed $value): void
  {
    if ($key === 'dynamic_variable_placeholders') {
      $existing = is_array($this->config['dynamic_variables'] ?? null) ? $this->config['dynamic_variables'] : [];
      $existing['dynamic_variable_placeholders'] = $value;
      $this->config['dynamic_variables'] = $existing;
      return;
    }
    $this->config[$key] = $value;
  }

  /**
   * @param null|callable(ToolIssue): mixed $onWarning
   * @return array<string, mixed>
   */
  private function checkedWire(?callable $onWarning): array
  {
    $issues = array_merge($this->issues, $this->validate());
    $errors = array_values(array_filter($issues, static fn(ToolIssue $i): bool => $i->severity === 'error'));
    if ($errors !== []) {
      throw new ToolValidationError($this->name(), $errors);
    }
    if ($onWarning !== null) {
      foreach ($issues as $issue) {
        if ($issue->severity === 'warning') {
          $onWarning($issue);
        }
      }
    }
    /** @var array<string, mixed> $copy */
    $copy = Wire::deepCopy($this->toWire());
    return $copy;
  }

  protected static function snake(string $camel): string
  {
    return strtolower((string) preg_replace('/[A-Z]/', '_$0', $camel));
  }
}
