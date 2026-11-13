<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Deployments\Requests;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class BodyCreateOrUpdateDeploymentsV1ConvaiAgentsAgentIdDeploymentsPost extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('deployment_request', required: true)]
  public \ElevenLabs\Types\AgentDeploymentRequest $deploymentRequest;

  /**
   * @param array{
   *   deploymentRequest: \ElevenLabs\Types\AgentDeploymentRequest,
   * } $values
   */
  public function __construct(array $values)
  {
    $this->deploymentRequest = $values['deploymentRequest'];

    $this->_dirtyFields = [
      'deployment_request' => true
    ];
  }

  public function toMultipart(): array
  {
    $parts = [];
    $parts[] = [
      'name' => 'deployment_request',
      'contents' => json_encode($this->deploymentRequest),
      'headers' => ['Content-Type' => 'application/json']
    ];

    return $parts;
  }

  public function validate(): void
  {
    $this->deploymentRequest->validate();
  }
}
