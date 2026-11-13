<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class FeaturesUsageCommonModel extends JsonSerializableType
{
  use ReflectiveSerialization;

  #[JsonProperty('language_detection')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $languageDetection;

  #[JsonProperty('transfer_to_agent')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $transferToAgent;

  #[JsonProperty('transfer_to_number')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $transferToNumber;

  #[JsonProperty('multivoice')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $multivoice;

  #[JsonProperty('dtmf_tones')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $dtmfTones;

  #[JsonProperty('external_mcp_servers')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $externalMcpServers;

  #[JsonProperty('pii_zrm_workspace')]
  public ?bool $piiZrmWorkspace;

  #[JsonProperty('pii_zrm_agent')]
  public ?bool $piiZrmAgent;

  #[JsonProperty('tool_dynamic_variable_updates')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $toolDynamicVariableUpdates;

  #[JsonProperty('is_livekit')]
  public ?bool $isLivekit;

  #[JsonProperty('voicemail_detection')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $voicemailDetection;

  #[JsonProperty('dtmf_input')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $dtmfInput;

  #[JsonProperty('workflow')]
  public ?\ElevenLabs\Types\WorkflowFeaturesUsageCommonModel $workflow;

  #[JsonProperty('agent_testing')]
  public ?\ElevenLabs\Types\TestsFeatureUsageCommonModel $agentTesting;

  #[JsonProperty('versioning')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $versioning;

  #[JsonProperty('file_input')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $fileInput;

  #[JsonProperty('freeform_procedure')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $freeformProcedure;

  #[JsonProperty('structured_procedure')]
  public ?\ElevenLabs\Types\FeatureStatusCommonModel $structuredProcedure;

  /**
   * @param array{
   *   languageDetection?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   transferToAgent?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   transferToNumber?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   multivoice?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   dtmfTones?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   externalMcpServers?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   piiZrmWorkspace?: ?bool,
   *   piiZrmAgent?: ?bool,
   *   toolDynamicVariableUpdates?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   isLivekit?: ?bool,
   *   voicemailDetection?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   dtmfInput?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   workflow?: ?\ElevenLabs\Types\WorkflowFeaturesUsageCommonModel,
   *   agentTesting?: ?\ElevenLabs\Types\TestsFeatureUsageCommonModel,
   *   versioning?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   fileInput?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   freeformProcedure?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   *   structuredProcedure?: ?\ElevenLabs\Types\FeatureStatusCommonModel,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->languageDetection = $values['languageDetection'] ?? null;
    $this->transferToAgent = $values['transferToAgent'] ?? null;
    $this->transferToNumber = $values['transferToNumber'] ?? null;
    $this->multivoice = $values['multivoice'] ?? null;
    $this->dtmfTones = $values['dtmfTones'] ?? null;
    $this->externalMcpServers = $values['externalMcpServers'] ?? null;
    $this->piiZrmWorkspace = $values['piiZrmWorkspace'] ?? null;
    $this->piiZrmAgent = $values['piiZrmAgent'] ?? null;
    $this->toolDynamicVariableUpdates = $values['toolDynamicVariableUpdates'] ?? null;
    $this->isLivekit = $values['isLivekit'] ?? null;
    $this->voicemailDetection = $values['voicemailDetection'] ?? null;
    $this->dtmfInput = $values['dtmfInput'] ?? null;
    $this->workflow = $values['workflow'] ?? null;
    $this->agentTesting = $values['agentTesting'] ?? null;
    $this->versioning = $values['versioning'] ?? null;
    $this->fileInput = $values['fileInput'] ?? null;
    $this->freeformProcedure = $values['freeformProcedure'] ?? null;
    $this->structuredProcedure = $values['structuredProcedure'] ?? null;

    if (array_key_exists('languageDetection', $values)) {
      $this->_dirtyFields['language_detection'] = true;
    }
    if (array_key_exists('transferToAgent', $values)) {
      $this->_dirtyFields['transfer_to_agent'] = true;
    }
    if (array_key_exists('transferToNumber', $values)) {
      $this->_dirtyFields['transfer_to_number'] = true;
    }
    if (array_key_exists('multivoice', $values)) {
      $this->_dirtyFields['multivoice'] = true;
    }
    if (array_key_exists('dtmfTones', $values)) {
      $this->_dirtyFields['dtmf_tones'] = true;
    }
    if (array_key_exists('externalMcpServers', $values)) {
      $this->_dirtyFields['external_mcp_servers'] = true;
    }
    if (array_key_exists('piiZrmWorkspace', $values)) {
      $this->_dirtyFields['pii_zrm_workspace'] = true;
    }
    if (array_key_exists('piiZrmAgent', $values)) {
      $this->_dirtyFields['pii_zrm_agent'] = true;
    }
    if (array_key_exists('toolDynamicVariableUpdates', $values)) {
      $this->_dirtyFields['tool_dynamic_variable_updates'] = true;
    }
    if (array_key_exists('isLivekit', $values)) {
      $this->_dirtyFields['is_livekit'] = true;
    }
    if (array_key_exists('voicemailDetection', $values)) {
      $this->_dirtyFields['voicemail_detection'] = true;
    }
    if (array_key_exists('dtmfInput', $values)) {
      $this->_dirtyFields['dtmf_input'] = true;
    }
    if (array_key_exists('workflow', $values)) {
      $this->_dirtyFields['workflow'] = true;
    }
    if (array_key_exists('agentTesting', $values)) {
      $this->_dirtyFields['agent_testing'] = true;
    }
    if (array_key_exists('versioning', $values)) {
      $this->_dirtyFields['versioning'] = true;
    }
    if (array_key_exists('fileInput', $values)) {
      $this->_dirtyFields['file_input'] = true;
    }
    if (array_key_exists('freeformProcedure', $values)) {
      $this->_dirtyFields['freeform_procedure'] = true;
    }
    if (array_key_exists('structuredProcedure', $values)) {
      $this->_dirtyFields['structured_procedure'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->languageDetection !== null) {
      $parts[] = [
        'name' => 'language_detection',
        'contents' => json_encode($this->languageDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transferToAgent !== null) {
      $parts[] = [
        'name' => 'transfer_to_agent',
        'contents' => json_encode($this->transferToAgent),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->transferToNumber !== null) {
      $parts[] = [
        'name' => 'transfer_to_number',
        'contents' => json_encode($this->transferToNumber),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->multivoice !== null) {
      $parts[] = [
        'name' => 'multivoice',
        'contents' => json_encode($this->multivoice),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dtmfTones !== null) {
      $parts[] = [
        'name' => 'dtmf_tones',
        'contents' => json_encode($this->dtmfTones),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->externalMcpServers !== null) {
      $parts[] = [
        'name' => 'external_mcp_servers',
        'contents' => json_encode($this->externalMcpServers),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->piiZrmWorkspace !== null) {
      $parts[] = [
        'name' => 'pii_zrm_workspace',
        'contents' => $this->piiZrmWorkspace ? 'true' : 'false'
      ];
    }

    if ($this->piiZrmAgent !== null) {
      $parts[] = [
        'name' => 'pii_zrm_agent',
        'contents' => $this->piiZrmAgent ? 'true' : 'false'
      ];
    }

    if ($this->toolDynamicVariableUpdates !== null) {
      $parts[] = [
        'name' => 'tool_dynamic_variable_updates',
        'contents' => json_encode($this->toolDynamicVariableUpdates),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->isLivekit !== null) {
      $parts[] = [
        'name' => 'is_livekit',
        'contents' => $this->isLivekit ? 'true' : 'false'
      ];
    }

    if ($this->voicemailDetection !== null) {
      $parts[] = [
        'name' => 'voicemail_detection',
        'contents' => json_encode($this->voicemailDetection),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->dtmfInput !== null) {
      $parts[] = [
        'name' => 'dtmf_input',
        'contents' => json_encode($this->dtmfInput),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->workflow !== null) {
      $parts[] = [
        'name' => 'workflow',
        'contents' => json_encode($this->workflow),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->agentTesting !== null) {
      $parts[] = [
        'name' => 'agent_testing',
        'contents' => json_encode($this->agentTesting),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->versioning !== null) {
      $parts[] = [
        'name' => 'versioning',
        'contents' => json_encode($this->versioning),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->fileInput !== null) {
      $parts[] = [
        'name' => 'file_input',
        'contents' => json_encode($this->fileInput),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->freeformProcedure !== null) {
      $parts[] = [
        'name' => 'freeform_procedure',
        'contents' => json_encode($this->freeformProcedure),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->structuredProcedure !== null) {
      $parts[] = [
        'name' => 'structured_procedure',
        'contents' => json_encode($this->structuredProcedure),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->languageDetection?->validate();
    $this->transferToAgent?->validate();
    $this->transferToNumber?->validate();
    $this->multivoice?->validate();
    $this->dtmfTones?->validate();
    $this->externalMcpServers?->validate();
    $this->toolDynamicVariableUpdates?->validate();
    $this->voicemailDetection?->validate();
    $this->dtmfInput?->validate();
    $this->workflow?->validate();
    $this->agentTesting?->validate();
    $this->versioning?->validate();
    $this->fileInput?->validate();
    $this->freeformProcedure?->validate();
    $this->structuredProcedure?->validate();
  }
}
