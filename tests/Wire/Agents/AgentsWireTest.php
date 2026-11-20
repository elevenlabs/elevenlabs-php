<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class AgentsWireTest extends TestCase
{
  public function testCreateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $asrQuality = \ElevenLabs\Types\AsrQuality::High->value;

    $asrProvider = \ElevenLabs\Types\AsrProvider::Elevenlabs->value;

    $asrInputFormat = \ElevenLabs\Types\AsrInputFormat::Pcm8000->value;

    $asrConversationalConfig = new \ElevenLabs\Types\AsrConversationalConfig([
      'quality' => $asrQuality,
      'provider' => $asrProvider,
      'userInputAudioFormat' => $asrInputFormat,
      'keywords' => []
    ]);

    $turnEagerness = \ElevenLabs\Types\TurnEagerness::Patient->value;

    $spellingPatience = \ElevenLabs\Types\SpellingPatience::Auto->value;

    $turnModel = \ElevenLabs\Types\TurnModel::TurnV2->value;

    $softTimeoutConfig = new \ElevenLabs\Types\SoftTimeoutConfig([
      'timeoutSeconds' => -1,
      'message' => 'Hhmmmm...yeah.',
      'additionalSoftTimeoutMessages' => [],
      'useLlmGeneratedMessage' => true,
      'randomizeFillers' => false,
      'maxSoftTimeoutsPerGeneration' => 1,
      'llmGeneratedMessagePromptOverride' => 'llm_generated_message_prompt_override',
      'disableUntilFirstUserMessage' => false
    ]);

    $turnConfig = new \ElevenLabs\Types\TurnConfig([
      'turnTimeout' => 7,
      'initialWaitTime' => 0.63,
      'silenceEndCallTimeout' => -1,
      'turnEagerness' => $turnEagerness,
      'spellingPatience' => $spellingPatience,
      'speculativeTurn' => false,
      'retranscribeOnTurnTimeout' => true,
      'turnModel' => $turnModel,
      'interruptionIgnoreTerms' => [],
      'interruptionIgnoreTermLanguages' => [],
      'mergeWithDefaultIgnoreTerms' => false,
      'transcribeOnDisabledInterruptions' => true,
      'softTimeoutConfig' => $softTimeoutConfig,
      'noisyEnvironmentDetection' => true,
      'noisyEnvironmentMessage' =>
        "Uhh ... sorry, I\'m picking up some noise in the background. Could you move somewhere quieter?"
    ]);

    $ttsConversationalModel = \ElevenLabs\Types\TtsConversationalModel::ElevenTurboV2->value;

    $ttsModelFamily = \ElevenLabs\Types\TtsModelFamily::Turbo->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $supportedVoice = new \ElevenLabs\Types\SupportedVoice([
      'label' => 'label',
      'voiceId' => 'voice_id',
      'description' => 'description',
      'language' => 'language',
      'modelFamily' => $ttsModelFamily,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.42,
      'speed' => 0.78,
      'similarityBoost' => 0.33,
      'cloneStrength' => 0.41
    ]);

    $suggestedAudioTag = new \ElevenLabs\Types\SuggestedAudioTag([
      'tag' => 'tag',
      'description' => 'description'
    ]);

    $ttsOutputFormat = \ElevenLabs\Types\TtsOutputFormat::Pcm8000->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $textNormalisationType = \ElevenLabs\Types\TextNormalisationType::SystemPrompt->value;

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $effectsSpecOutput = new \ElevenLabs\Types\EffectsSpecOutput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.38,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.59
    ]);

    $ttsConversationalConfigOutput = new \ElevenLabs\Types\TtsConversationalConfigOutput([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'cjVigY5qzO86Huf0OWal',
      'supportedVoices' => [],
      'expressiveMode' => true,
      'suggestedAudioTags' => [],
      'agentOutputAudioFormat' => $ttsOutputFormat,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.5,
      'speed' => 1,
      'similarityBoost' => 0.8,
      'cloneStrength' => 0.91,
      'textNormalisationType' => $textNormalisationType,
      'pronunciationDictionaryLocators' => [],
      'enablePhonemeTags' => true,
      'audioEffects' => $effectsSpecOutput
    ]);

    $clientEvent = \ElevenLabs\Types\ClientEvent::ConversationInitiationMetadata->value;

    $fileInputConfig = new \ElevenLabs\Types\FileInputConfig([
      'enabled' => true,
      'maxFilesInMemory' => 10,
      'maxFilesPerConversation' => 10
    ]);

    $dtmfInputConfig = new \ElevenLabs\Types\DtmfInputConfig([
      'dtmfInputTimeout' => 2,
      'hashTerminator' => true,
      'redactInput' => false
    ]);

    $backgroundSoundSourceType = \ElevenLabs\Types\BackgroundSoundSourceType::Preset->value;

    $backgroundSoundPresetId = \ElevenLabs\Types\BackgroundSoundPresetId::Office2->value;

    $backgroundSoundConfig = new \ElevenLabs\Types\BackgroundSoundConfig([
      'sourceType' => $backgroundSoundSourceType,
      'sourceId' => $backgroundSoundPresetId,
      'volume' => 0.15,
      'crossfadeLoop' => true
    ]);

    $conversationConfigOutput = new \ElevenLabs\Types\ConversationConfigOutput([
      'textOnly' => false,
      'maxDurationSeconds' => 600,
      'clientEvents' => [],
      'fileInput' => $fileInputConfig,
      'monitoringEnabled' => true,
      'monitoringEvents' => [],
      'dtmfInputSettings' => $dtmfInputConfig,
      'backgroundSound' => $backgroundSoundConfig,
      'sourceAttribution' => false
    ]);

    $asrConversationalConfigOverride = new \ElevenLabs\Types\AsrConversationalConfigOverride([
      'keywords' => []
    ]);

    $softTimeoutConfigOverride = new \ElevenLabs\Types\SoftTimeoutConfigOverride([
      'message' => 'message',
      'additionalSoftTimeoutMessages' => []
    ]);

    $turnConfigOverride = new \ElevenLabs\Types\TurnConfigOverride([
      'softTimeoutConfig' => $softTimeoutConfigOverride,
      'noisyEnvironmentMessage' => 'noisy_environment_message'
    ]);

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 6.57,
      'speed' => 1.8,
      'similarityBoost' => 6.48,
      'cloneStrength' => 1.49,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => false,
      'maxDurationSeconds' => 5
    ]);

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $llmReasoningEffort = \ElevenLabs\Types\LlmReasoningEffort::None->value;

    $knowledgeBaseDocumentType = \ElevenLabs\Types\KnowledgeBaseDocumentType::File->value;

    $documentUsageModeEnum = \ElevenLabs\Types\DocumentUsageModeEnum::Prompt->value;

    $knowledgeBaseLocator = new \ElevenLabs\Types\KnowledgeBaseLocator([
      'type' => $knowledgeBaseDocumentType,
      'name' => 'name',
      'id' => 'id',
      'usageMode' => $documentUsageModeEnum
    ]);

    $promptAgentApiModelOverrideOutput = new \ElevenLabs\Types\PromptAgentApiModelOverrideOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideOutput = new \ElevenLabs\Types\AgentConfigOverrideOutput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideOutput
    ]);

    $conversationConfigClientOverrideOutput = new \ElevenLabs\Types\ConversationConfigClientOverrideOutput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideOutput
      ]
    );

    $languagePresetTranslation = new \ElevenLabs\Types\LanguagePresetTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $languagePresetOutput = new \ElevenLabs\Types\LanguagePresetOutput([
      'overrides' => $conversationConfigClientOverrideOutput,
      'firstMessageTranslation' => $languagePresetTranslation,
      'softTimeoutTranslation' => $languagePresetTranslation,
      'noisyEnvironmentMessageTranslation' => $languagePresetTranslation
    ]);

    $vadConfig = new \ElevenLabs\Types\VadConfig();

    $verbosity = \ElevenLabs\Types\Verbosity::Auto->value;

    $outputFormat = \ElevenLabs\Types\OutputFormat::Mp32205032->value;

    $interactionBudget = \ElevenLabs\Types\InteractionBudget::Realtime->value;

    $behaviorOverride = new \ElevenLabs\Types\BehaviorOverride([
      'verbosity' => $verbosity,
      'outputFormat' => $outputFormat,
      'interactionBudget' => $interactionBudget
    ]);

    $subAgentOutputExecutionMode = \ElevenLabs\Types\SubAgentOutputExecutionMode::Immediate->value;

    $objectJsonSchemaPropertyOutputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType::Object->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = []; // TODO: populate with required fields

    $objectJsonSchemaPropertyOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyOutput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput([
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => false,
      'type' => $objectJsonSchemaPropertyOutputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $subAgentOutput = new \ElevenLabs\Types\SubAgentOutput([
      'executionMode' => $subAgentOutputExecutionMode,
      'timeoutSecs' => 60,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'description' => 'description',
      'parameters' => $objectJsonSchemaPropertyOutput
    ]);

    $selfSubagentExecutionMode = \ElevenLabs\Types\SelfSubagentExecutionMode::Immediate->value;

    $selfSubagent = new \ElevenLabs\Types\SelfSubagent([
      'executionMode' => $selfSubagentExecutionMode,
      'timeoutSecs' => 60,
      'description' => 'description'
    ]);

    $subagentConfigOutput = new \ElevenLabs\Types\SubagentConfigOutput([
      'agents' => [],
      'selfSubagent' => $selfSubagent
    ]);

    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $systemToolConfigOutputType = \ElevenLabs\Types\SystemToolConfigOutputType::System->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $endCallToolConfigSystemToolType =
      \ElevenLabs\Types\EndCallToolConfigSystemToolType::EndCall->value;

    $endCallToolConfig = new \ElevenLabs\Types\EndCallToolConfig([
      'systemToolType' => $endCallToolConfigSystemToolType
    ]);
    $systemToolConfigOutputParams = \ElevenLabs\Types\SystemToolConfigOutputParams::endCall(
      $endCallToolConfig
    );

    $systemToolConfigOutput = new \ElevenLabs\Types\SystemToolConfigOutput([
      'type' => $systemToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'params' => $systemToolConfigOutputParams
    ]);

    $builtInToolsOutput = new \ElevenLabs\Types\BuiltInToolsOutput([
      'transferToAgent' => $systemToolConfigOutput,
      'endCall' => $systemToolConfigOutput,
      'languageDetection' => $systemToolConfigOutput,
      'transferToNumber' => $systemToolConfigOutput,
      'skipTurn' => $systemToolConfigOutput,
      'playKeypadTouchTone' => $systemToolConfigOutput,
      'voicemailDetection' => $systemToolConfigOutput
    ]);

    $customLlmApiKey = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $customLlmRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmapiType = \ElevenLabs\Types\CustomLlmapiType::ChatCompletions->value;

    $customLlm = new \ElevenLabs\Types\CustomLlm([
      'url' => 'url',
      'modelId' => 'model_id',
      'apiKey' => $customLlmApiKey,
      'authConnection' => $customLlmAuthConnection,
      'requestHeaders' => [],
      'apiVersion' => 'api_version',
      'apiType' => $customLlmapiType
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $searchStrategy = \ElevenLabs\Types\SearchStrategy::Cat->value;

    $knowledgeBaseToolInfo = new \ElevenLabs\Types\KnowledgeBaseToolInfo([
      'enabledStrategies' => []
    ]);

    $ragConfigOutput = new \ElevenLabs\Types\RagConfigOutput([
      'enabled' => true,
      'embeddingModel' => $embeddingModelEnum,
      'maxVectorDistance' => 0.5,
      'maxDocumentsLength' => 50000,
      'maxRetrievedRagChunksCount' => 5,
      'numCandidates' => 8647,
      'queryRewritePromptOverride' => 'query_rewrite_prompt_override',
      'knowledgeBaseToolInfo' => $knowledgeBaseToolInfo
    ]);

    $backupLlmDefaultPreference = \ElevenLabs\Types\BackupLlmDefaultPreference::Default_->value;

    $backupLlmDefault = new \ElevenLabs\Types\BackupLlmDefault([
      'preference' => $backupLlmDefaultPreference
    ]);
    $promptAgentApiModelOutputBackupLlmConfig = \ElevenLabs\Types\PromptAgentApiModelOutputBackupLlmConfig::default(
      $backupLlmDefault
    );

    $webhookToolConfigOutputType = \ElevenLabs\Types\WebhookToolConfigOutputType::Webhook->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigOutputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigOutputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputMethod::Get->value;

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutput = new \ElevenLabs\Types\QueryParamsJsonSchemaOutput([
      'properties' => [],
      'required' => []
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigOutputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigOutputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigOutput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigOutput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigOutputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaOutput,
      'requestBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigOutputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigOutputAuthConnection
    ]);

    $webhookToolConfigOutput = new \ElevenLabs\Types\WebhookToolConfigOutput([
      'type' => $webhookToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigOutput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $promptAgentApiModelOutputToolsItem = \ElevenLabs\Types\PromptAgentApiModelOutputToolsItem::webhook(
      $webhookToolConfigOutput
    );

    $promptAgentApiModelOutput = new \ElevenLabs\Types\PromptAgentApiModelOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'serviceTier' => $llmServiceTier,
      'thinkingBudget' => 3,
      'enableReasoningSummary' => true,
      'temperature' => 6.3,
      'maxTokens' => -1,
      'toolIds' => [],
      'toolIdsStrict' => false,
      'builtInTools' => $builtInToolsOutput,
      'enableParallelToolCalls' => true,
      'mcpServerIds' => [],
      'nativeMcpServerIds' => [],
      'knowledgeBase' => [],
      'customLlm' => $customLlm,
      'ignoreDefaultPersonality' => true,
      'rag' => $ragConfigOutput,
      'timezone' => 'timezone',
      'backupLlmConfig' => $promptAgentApiModelOutputBackupLlmConfig,
      'cascadeTimeoutSeconds' => 4,
      'tools' => []
    ]);

    $agentConfig = new \ElevenLabs\Types\AgentConfig([
      'firstMessage' => 'first_message',
      'language' => 'en',
      'hinglishMode' => false,
      'dynamicVariables' => [],
      'disableFirstMessageInterruptions' => false,
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'textBehaviorOverrides' => [],
      'subagentConfig' => $subagentConfigOutput,
      'prompt' => $promptAgentApiModelOutput
    ]);

    $conversationalConfig = new \ElevenLabs\Types\ConversationalConfig([
      'asr' => $asrConversationalConfig,
      'turn' => $turnConfig,
      'tts' => $ttsConversationalConfigOutput,
      'conversation' => $conversationConfigOutput,
      'languagePresets' => [],
      'vad' => $vadConfig,
      'agent' => $agentConfig
    ]);

    $promptEvaluationCriteriaType = \ElevenLabs\Types\PromptEvaluationCriteriaType::Prompt->value;

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $criteriaScoringMode = \ElevenLabs\Types\CriteriaScoringMode::Binary->value;

    $promptEvaluationCriteria = new \ElevenLabs\Types\PromptEvaluationCriteria([
      'id' => 'id',
      'name' => 'name',
      'type' => $promptEvaluationCriteriaType,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scope' => $analysisScope,
      'llm' => $llm,
      'scoringMode' => $criteriaScoringMode,
      'maxScore' => 100,
      'scoreInstructions' => 'score_instructions'
    ]);

    $evaluationSettingsInput = new \ElevenLabs\Types\EvaluationSettingsInput([
      'criteria' => []
    ]);

    $embedVariant = \ElevenLabs\Types\EmbedVariant::Tiny->value;

    $widgetPlacement = \ElevenLabs\Types\WidgetPlacement::TopLeft->value;

    $widgetExpandable = \ElevenLabs\Types\WidgetExpandable::Never->value;

    $orbAvatarType = \ElevenLabs\Types\OrbAvatarType::Orb->value;

    $orbAvatar = new \ElevenLabs\Types\OrbAvatar([
      'type' => $orbAvatarType,
      'color1' => '#2792dc',
      'color2' => '#9ce6e6'
    ]);
    $widgetConfigAvatar = \ElevenLabs\Types\WidgetConfigAvatar::orb($orbAvatar);

    $widgetFeedbackMode = \ElevenLabs\Types\WidgetFeedbackMode::None->value;

    $widgetEndFeedbackType = \ElevenLabs\Types\WidgetEndFeedbackType::Rating->value;

    $widgetEndFeedbackConfig = new \ElevenLabs\Types\WidgetEndFeedbackConfig([
      'type' => $widgetEndFeedbackType
    ]);

    $allowlistItem = new \ElevenLabs\Types\AllowlistItem([
      'hostname' => 'hostname'
    ]);

    $widgetConfigSyntaxHighlightTheme =
      \ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme::Light->value;

    $widgetTextContents = new \ElevenLabs\Types\WidgetTextContents([
      'mainLabel' => 'main_label',
      'startCall' => 'start_call',
      'startChat' => 'start_chat',
      'newCall' => 'new_call',
      'endCall' => 'end_call',
      'muteMicrophone' => 'mute_microphone',
      'changeLanguage' => 'change_language',
      'collapse' => 'collapse',
      'expand' => 'expand',
      'copied' => 'copied',
      'acceptTerms' => 'accept_terms',
      'dismissTerms' => 'dismiss_terms',
      'listeningStatus' => 'listening_status',
      'speakingStatus' => 'speaking_status',
      'connectingStatus' => 'connecting_status',
      'chattingStatus' => 'chatting_status',
      'queueWaitingStatus' => 'queue_waiting_status',
      'queueWaitingStatusShort' => 'queue_waiting_status_short',
      'inputLabel' => 'input_label',
      'inputPlaceholder' => 'input_placeholder',
      'inputPlaceholderTextOnly' => 'input_placeholder_text_only',
      'inputPlaceholderNewConversation' => 'input_placeholder_new_conversation',
      'userEndedConversation' => 'user_ended_conversation',
      'agentEndedConversation' => 'agent_ended_conversation',
      'conversationId' => 'conversation_id',
      'errorOccurred' => 'error_occurred',
      'queueTimedOut' => 'queue_timed_out',
      'copyId' => 'copy_id',
      'initiateFeedback' => 'initiate_feedback',
      'requestFollowUpFeedback' => 'request_follow_up_feedback',
      'thanksForFeedback' => 'thanks_for_feedback',
      'thanksForFeedbackDetails' => 'thanks_for_feedback_details',
      'followUpFeedbackPlaceholder' => 'follow_up_feedback_placeholder',
      'submit' => 'submit',
      'goBack' => 'go_back',
      'sendMessage' => 'send_message',
      'textMode' => 'text_mode',
      'voiceMode' => 'voice_mode',
      'switchedToTextMode' => 'switched_to_text_mode',
      'switchedToVoiceMode' => 'switched_to_voice_mode',
      'copy' => 'copy',
      'download' => 'download',
      'wrap' => 'wrap',
      'agentWorking' => 'agent_working',
      'agentDone' => 'agent_done',
      'agentError' => 'agent_error',
      'attachFile' => 'attach_file',
      'removeFile' => 'remove_file',
      'fileUploadError' => 'file_upload_error',
      'fileTypeUnsupported' => 'file_type_unsupported',
      'fileTooLarge' => 'file_too_large',
      'fileLimitReached' => 'file_limit_reached',
      'typingIndicator' => 'typing_indicator',
      'richContentUnavailable' => 'rich_content_unavailable'
    ]);

    $widgetStyles = new \ElevenLabs\Types\WidgetStyles([
      'base' => 'base',
      'baseHover' => 'base_hover',
      'baseActive' => 'base_active',
      'baseBorder' => 'base_border',
      'baseSubtle' => 'base_subtle',
      'basePrimary' => 'base_primary',
      'baseError' => 'base_error',
      'accent' => 'accent',
      'accentHover' => 'accent_hover',
      'accentActive' => 'accent_active',
      'accentBorder' => 'accent_border',
      'accentSubtle' => 'accent_subtle',
      'accentPrimary' => 'accent_primary',
      'overlayPadding' => 6.64,
      'buttonRadius' => 6.41,
      'inputRadius' => 6.32,
      'bubbleRadius' => 3.68,
      'sheetRadius' => 3.55,
      'compactSheetRadius' => 3.52,
      'dropdownSheetRadius' => 6.58
    ]);

    $widgetTextContentsTranslation = new \ElevenLabs\Types\WidgetTextContentsTranslation([
      'source' => [],
      'text' => []
    ]);

    $widgetTermsTranslation = new \ElevenLabs\Types\WidgetTermsTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $widgetLanguagePreset = new \ElevenLabs\Types\WidgetLanguagePreset([
      'textContents' => $widgetTextContents,
      'textContentsTranslation' => $widgetTextContentsTranslation,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'termsTranslation' => $widgetTermsTranslation
    ]);

    $widgetConfig = new \ElevenLabs\Types\WidgetConfig([
      'variant' => $embedVariant,
      'placement' => $widgetPlacement,
      'expandable' => $widgetExpandable,
      'avatar' => $widgetConfigAvatar,
      'feedbackMode' => $widgetFeedbackMode,
      'endFeedback' => $widgetEndFeedbackConfig,
      'bgColor' => '#ffffff',
      'textColor' => '#000000',
      'btnColor' => '#000000',
      'btnTextColor' => '#ffffff',
      'borderColor' => '#e1e1e1',
      'focusColor' => '#000000',
      'borderRadius' => 5,
      'btnRadius' => 8,
      'actionText' => 'action_text',
      'startCallText' => 'start_call_text',
      'endCallText' => 'end_call_text',
      'expandText' => 'expand_text',
      'listeningText' => 'listening_text',
      'speakingText' => 'speaking_text',
      'shareablePageText' => 'shareable_page_text',
      'shareablePageShowTerms' => true,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'showAvatarWhenCollapsed' => true,
      'disableBanner' => true,
      'overrideLink' => 'override_link',
      'markdownLinkAllowedHosts' => [],
      'markdownLinkIncludeWww' => true,
      'markdownLinkAllowHttp' => true,
      'micMutingEnabled' => true,
      'transcriptEnabled' => true,
      'textInputEnabled' => true,
      'conversationModeToggleEnabled' => true,
      'defaultExpanded' => false,
      'alwaysExpanded' => true,
      'dismissible' => false,
      'showAgentStatus' => false,
      'showConversationId' => true,
      'stripAudioTags' => true,
      'syntaxHighlightTheme' => $widgetConfigSyntaxHighlightTheme,
      'textContents' => $widgetTextContents,
      'styles' => $widgetStyles,
      'showResizeButton' => true,
      'endConfirmationEnabled' => false,
      'mobileFullscreen' => true,
      'transcriptSpeechSyncEnabled' => true,
      'languageSelector' => false,
      'supportsTextOnly' => true,
      'customAvatarPath' => 'custom_avatar_path',
      'languagePresets' => []
    ]);

    $analysisPropertyType = \ElevenLabs\Types\AnalysisPropertyType::Boolean->value;

    $analysisPropertyConstantValue = []; // TODO: populate with required fields

    $analysisProperty = new \ElevenLabs\Types\AnalysisProperty([
      'type' => $analysisPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => true,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $analysisPropertyConstantValue,
      'isOmitted' => false,
      'name' => 'name',
      'llm' => $llm
    ]);

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $attachedUserEvaluationRefSource =
      \ElevenLabs\Types\AttachedUserEvaluationRefSource::User->value;

    $attachedUserEvaluationRef = new \ElevenLabs\Types\AttachedUserEvaluationRef([
      'source' => $attachedUserEvaluationRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'additionalVersionIds' => [],
      'scope' => $analysisScope,
      'weight' => 7.08
    ]);
    $agentAnalysisItemsInputEvaluationCriteriaItem = \ElevenLabs\Types\AgentAnalysisItemsInputEvaluationCriteriaItem::user(
      $attachedUserEvaluationRef
    );

    $attachedUserDataCollectionRefSource =
      \ElevenLabs\Types\AttachedUserDataCollectionRefSource::User->value;

    $attachedUserDataCollectionRef = new \ElevenLabs\Types\AttachedUserDataCollectionRef([
      'source' => $attachedUserDataCollectionRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'scope' => $analysisScope
    ]);
    $agentAnalysisItemsInputDataCollectionItem = \ElevenLabs\Types\AgentAnalysisItemsInputDataCollectionItem::user(
      $attachedUserDataCollectionRef
    );

    $agentAnalysisItemsInput = new \ElevenLabs\Types\AgentAnalysisItemsInput([
      'evaluationCriteria' => [],
      'dataCollection' => []
    ]);

    $asrConversationalConfigOverrideConfig = new \ElevenLabs\Types\AsrConversationalConfigOverrideConfig(
      [
        'keywords' => false
      ]
    );

    $softTimeoutConfigOverrideConfig = new \ElevenLabs\Types\SoftTimeoutConfigOverrideConfig([
      'message' => false,
      'additionalSoftTimeoutMessages' => false
    ]);

    $turnConfigOverrideConfig = new \ElevenLabs\Types\TurnConfigOverrideConfig([
      'softTimeoutConfig' => $softTimeoutConfigOverrideConfig,
      'noisyEnvironmentMessage' => false
    ]);

    $ttsConversationalConfigOverrideConfig = new \ElevenLabs\Types\TtsConversationalConfigOverrideConfig(
      [
        'modelId' => false,
        'voiceId' => false,
        'supportedVoices' => false,
        'stability' => false,
        'speed' => false,
        'similarityBoost' => true,
        'cloneStrength' => true,
        'pronunciationDictionaryLocators' => false
      ]
    );

    $conversationConfigOverrideConfig = new \ElevenLabs\Types\ConversationConfigOverrideConfig([
      'textOnly' => true,
      'maxDurationSeconds' => false
    ]);

    $promptAgentApiModelOverrideConfig = new \ElevenLabs\Types\PromptAgentApiModelOverrideConfig([
      'prompt' => true,
      'llm' => false,
      'reasoningEffort' => false,
      'toolIds' => true,
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => true,
      'knowledgeBase' => true
    ]);

    $agentConfigOverrideConfig = new \ElevenLabs\Types\AgentConfigOverrideConfig([
      'firstMessage' => true,
      'language' => true,
      'maxConversationDurationMessage' => true,
      'prompt' => $promptAgentApiModelOverrideConfig
    ]);

    $conversationConfigClientOverrideConfigInput = new \ElevenLabs\Types\ConversationConfigClientOverrideConfigInput(
      [
        'asr' => $asrConversationalConfigOverrideConfig,
        'turn' => $turnConfigOverrideConfig,
        'tts' => $ttsConversationalConfigOverrideConfig,
        'conversation' => $conversationConfigOverrideConfig,
        'agent' => $agentConfigOverrideConfig
      ]
    );

    $conversationInitiationClientDataConfigInput = new \ElevenLabs\Types\ConversationInitiationClientDataConfigInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideConfigInput,
        'customLlmExtraBody' => true,
        'enableConversationInitiationClientDataFromWebhook' => false,
        'enableStartingWorkflowNodeIdFromClient' => true,
        'enableProcedureIdsFromClient' => false
      ]
    );

    $conversationInitiationClientDataWebhookRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $conversationInitiationClientDataWebhook = new \ElevenLabs\Types\ConversationInitiationClientDataWebhook(
      [
        'url' => 'url',
        'requestHeaders' => []
      ]
    );

    $webhookEventType = \ElevenLabs\Types\WebhookEventType::Transcript->value;

    $webhookTranscriptFormat = \ElevenLabs\Types\WebhookTranscriptFormat::Json->value;

    $convAiWebhooks = new \ElevenLabs\Types\ConvAiWebhooks([
      'postCallWebhookId' => 'post_call_webhook_id',
      'events' => [],
      'transcriptFormat' => $webhookTranscriptFormat,
      'excludeTranscript' => false,
      'sendAudio' => true
    ]);

    $agentWorkspaceOverridesInput = new \ElevenLabs\Types\AgentWorkspaceOverridesInput([
      'conversationInitiationClientDataWebhook' => $conversationInitiationClientDataWebhook,
      'webhooks' => $convAiWebhooks
    ]);

    $attachedTestModel = new \ElevenLabs\Types\AttachedTestModel([
      'testId' => 'test_id',
      'workflowNodeId' => 'workflow_node_id'
    ]);

    $agentTestingSettings = new \ElevenLabs\Types\AgentTestingSettings([
      'attachedTests' => []
    ]);

    $guardrailsV1InputVersion = \ElevenLabs\Types\GuardrailsV1InputVersion::One->value;

    $focusGuardrail = new \ElevenLabs\Types\FocusGuardrail([
      'isEnabled' => false
    ]);

    $promptInjectionGuardrail = new \ElevenLabs\Types\PromptInjectionGuardrail([
      'isEnabled' => false
    ]);

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $contentThresholdGuardrailThreshold = \ElevenLabs\Types\Threshold2::Low->value;

    $contentThresholdGuardrail = new \ElevenLabs\Types\ContentThresholdGuardrail([
      'isEnabled' => false,
      'threshold' => $contentThresholdGuardrailThreshold
    ]);

    $contentConfig = new \ElevenLabs\Types\ContentConfig([
      'sexual' => $contentThresholdGuardrail,
      'violence' => $contentThresholdGuardrail,
      'harassment' => $contentThresholdGuardrail,
      'selfHarm' => $contentThresholdGuardrail,
      'profanity' => $contentThresholdGuardrail,
      'religionOrPolitics' => $contentThresholdGuardrail,
      'medicalAndLegalInformation' => $contentThresholdGuardrail
    ]);

    $endCallTriggerActionType = \ElevenLabs\Types\EndCallTriggerActionType::EndCall->value;

    $endCallTriggerAction = new \ElevenLabs\Types\EndCallTriggerAction([
      'type' => $endCallTriggerActionType
    ]);
    $contentGuardrailInputTriggerAction = \ElevenLabs\Types\ContentGuardrailInputTriggerAction::endCall(
      $endCallTriggerAction
    );

    $contentGuardrailInput = new \ElevenLabs\Types\ContentGuardrailInput([
      'executionMode' => $guardrailExecutionMode,
      'config' => $contentConfig,
      'triggerAction' => $contentGuardrailInputTriggerAction
    ]);

    $customGuardrailConfigModel =
      \ElevenLabs\Types\CustomGuardrailConfigModel::Gemini25FlashLite->value;

    $customGuardrailConfigTriggerAction = \ElevenLabs\Types\CustomGuardrailConfigTriggerAction::endCall(
      $endCallTriggerAction
    );

    $customGuardrailConfig = new \ElevenLabs\Types\CustomGuardrailConfig([
      'isEnabled' => true,
      'name' => 'name',
      'prompt' => 'prompt',
      'executionMode' => $guardrailExecutionMode,
      'model' => $customGuardrailConfigModel,
      'serviceTier' => $llmServiceTier,
      'historyMessageCount' => 33,
      'triggerAction' => $customGuardrailConfigTriggerAction,
      'evaluateFullResponseOnly' => false
    ]);

    $customGuardrailsConfigInput = new \ElevenLabs\Types\CustomGuardrailsConfigInput([
      'configs' => []
    ]);

    $customGuardrailInput = new \ElevenLabs\Types\CustomGuardrailInput([
      'config' => $customGuardrailsConfigInput
    ]);

    $guardrailsV1Input = new \ElevenLabs\Types\GuardrailsV1Input([
      'version' => $guardrailsV1InputVersion,
      'focus' => $focusGuardrail,
      'promptInjection' => $promptInjectionGuardrail,
      'content' => $contentGuardrailInput,
      'custom' => $customGuardrailInput
    ]);

    $authSettings = new \ElevenLabs\Types\AuthSettings([
      'enableAuth' => true,
      'allowlist' => [],
      'requireOriginHeader' => true,
      'shareableToken' => 'shareable_token'
    ]);

    $agentCallLimits = new \ElevenLabs\Types\AgentCallLimits([
      'agentConcurrencyLimit' => -1,
      'dailyLimit' => 100000,
      'burstingEnabled' => true
    ]);

    $agentHoldAudioConfig = new \ElevenLabs\Types\AgentHoldAudioConfig([
      'audioPath' => 'audio_path',
      'audioUrl' => 'audio_url',
      'originalFilename' => 'original_filename',
      'durationSecs' => 4.56,
      'sizeBytes' => 7
    ]);

    $agentQueueingConfig = new \ElevenLabs\Types\AgentQueueingConfig([
      'enabled' => false,
      'waitTimeoutSeconds' => 180,
      'holdAudio' => $agentHoldAudioConfig
    ]);

    $configEntityType = \ElevenLabs\Types\ConfigEntityType::Name->value;

    $conversationHistoryRedactionConfig = new \ElevenLabs\Types\ConversationHistoryRedactionConfig([
      'enabled' => false,
      'entities' => [],
      'excludedDataCollectionIds' => []
    ]);

    $privacyConfigInput = new \ElevenLabs\Types\PrivacyConfigInput([
      'recordVoice' => true,
      'retentionDays' => -1,
      'deleteTranscriptAndPii' => true,
      'deleteAudio' => false,
      'applyToExistingConversations' => true,
      'zeroRetentionMode' => true,
      'conversationHistoryRedaction' => $conversationHistoryRedactionConfig
    ]);

    $agentTrustContext = \ElevenLabs\Types\AgentTrustContext::Unknown->value;

    $topicDiscoverySettings = new \ElevenLabs\Types\TopicDiscoverySettings();

    $sentimentAnalysisSettings = new \ElevenLabs\Types\SentimentAnalysisSettings();

    $alertingMonitorConfig = new \ElevenLabs\Types\AlertingMonitorConfig([
      'enabled' => false,
      'threshold' => 0.24,
      'relativeIncreaseThreshold' => 9.18,
      'minFailureCount' => 1,
      'minHistoryBucketCount' => 7,
      'minSampleCount' => 2,
      'suspectTriggerThreshold' => 8,
      'autoResolveAfterInactiveMinutes' => 10
    ]);

    $alertingWebhookNotifierType = \ElevenLabs\Types\AlertingWebhookNotifierType::Webhook->value;

    $alertingWebhookNotifier = new \ElevenLabs\Types\AlertingWebhookNotifier([
      'type' => $alertingWebhookNotifierType,
      'webhookId' => 'webhook_id'
    ]);
    $alertingSettingsNotifiersItem = \ElevenLabs\Types\AlertingSettingsNotifiersItem::webhook(
      $alertingWebhookNotifier
    );

    $alertingSettings = new \ElevenLabs\Types\AlertingSettings([
      'monitorConfigs' => [],
      'autoResolveAfterInactiveMinutes' => 10,
      'environments' => ['environments'],
      'notifiers' => []
    ]);

    $agentPlatformSettingsRequestModel = new \ElevenLabs\Types\AgentPlatformSettingsRequestModel([
      'evaluation' => $evaluationSettingsInput,
      'widget' => $widgetConfig,
      'dataCollection' => [],
      'dataCollectionScopes' => [],
      'analysisItems' => $agentAnalysisItemsInput,
      'overrides' => $conversationInitiationClientDataConfigInput,
      'workspaceOverrides' => $agentWorkspaceOverridesInput,
      'testing' => $agentTestingSettings,
      'archived' => false,
      'guardrails' => $guardrailsV1Input,
      'summaryLanguage' => 'summary_language',
      'autoTranslateTranscriptToAppLanguage' => false,
      'auth' => $authSettings,
      'callLimits' => $agentCallLimits,
      'queueingConfig' => $agentQueueingConfig,
      'privacy' => $privacyConfigInput,
      'trustContext' => $agentTrustContext,
      'analysisLlm' => $llm,
      'topicDiscovery' => $topicDiscoverySettings,
      'sentimentAnalysis' => $sentimentAnalysisSettings,
      'alerting' => $alertingSettings
    ]);

    $workflowUnconditionalModelInputType =
      \ElevenLabs\Types\WorkflowUnconditionalModelInputType::Unconditional->value;

    $workflowUnconditionalModelInput = new \ElevenLabs\Types\WorkflowUnconditionalModelInput([
      'label' => 'label',
      'type' => $workflowUnconditionalModelInputType
    ]);
    $workflowEdgeModelInputForwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $workflowEdgeModelInputBackwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $positionInput = new \ElevenLabs\Types\PositionInput([
      'x' => 0.13,
      'y' => 8.06
    ]);

    $workflowEdgeModelInput = new \ElevenLabs\Types\WorkflowEdgeModelInput([
      'source' => 'source',
      'target' => 'target',
      'forwardCondition' => $workflowEdgeModelInputForwardCondition,
      'backwardCondition' => $workflowEdgeModelInputBackwardCondition,
      'reroutes' => []
    ]);

    $workflowStartNodeModelInputType =
      \ElevenLabs\Types\WorkflowStartNodeModelInputType::Start->value;

    $workflowStartNodeModelInput = new \ElevenLabs\Types\WorkflowStartNodeModelInput([
      'type' => $workflowStartNodeModelInputType,
      'position' => $positionInput,
      'edgeOrder' => []
    ]);
    $agentWorkflowRequestModelNodesValue = \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::start(
      $workflowStartNodeModelInput
    );

    $agentWorkflowRequestModel = new \ElevenLabs\Types\AgentWorkflowRequestModel([
      'edges' => [],
      'nodes' => [],
      'preventSubagentLoops' => false
    ]);

    $request = new \ElevenLabs\Agents\Requests\BodyCreateAgentV1ConvaiAgentsCreatePost([
      'enableVersioning' => true,
      'conversationConfig' => $conversationalConfig,
      'platformSettings' => $agentPlatformSettingsRequestModel,
      'workflow' => $agentWorkflowRequestModel,
      'name' => 'name',
      'tags' => []
    ]);
    $sdk->agents->create(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/create$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testGetSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "name": "test-value",
          "conversation_config": {
              "asr": {
                  "quality": "high",
                  "provider": "elevenlabs",
                  "user_input_audio_format": "pcm_8000",
                  "keywords": [
                      "test-value"
                  ]
              },
              "turn": {
                  "turn_timeout": 1,
                  "initial_wait_time": 1,
                  "silence_end_call_timeout": 1,
                  "turn_eagerness": "patient",
                  "spelling_patience": "auto",
                  "speculative_turn": true,
                  "retranscribe_on_turn_timeout": true,
                  "turn_model": "turn_v2",
                  "interruption_ignore_terms": [
                      "test-value"
                  ],
                  "interruption_ignore_term_languages": [
                      "test-value"
                  ],
                  "merge_with_default_ignore_terms": true,
                  "transcribe_on_disabled_interruptions": true,
                  "soft_timeout_config": {
                      "timeout_seconds": 1,
                      "message": "test-value",
                      "additional_soft_timeout_messages": [
                          "test-value"
                      ],
                      "use_llm_generated_message": true,
                      "randomize_fillers": true,
                      "max_soft_timeouts_per_generation": 1,
                      "llm_generated_message_prompt_override": "test-value",
                      "disable_until_first_user_message": true
                  },
                  "noisy_environment_detection": true,
                  "noisy_environment_message": "test-value"
              },
              "tts": {
                  "model_id": "eleven_turbo_v2",
                  "voice_id": "test-value",
                  "supported_voices": [
                      {
                          "label": "test-value",
                          "voice_id": "test-value",
                          "description": "test-value",
                          "language": "test-value",
                          "model_family": "turbo",
                          "optimize_streaming_latency": 0,
                          "stability": 0,
                          "speed": 0.7,
                          "similarity_boost": 0,
                          "clone_strength": 0
                      }
                  ],
                  "expressive_mode": true,
                  "suggested_audio_tags": [
                      {
                          "tag": "test-value",
                          "description": "test-value"
                      }
                  ],
                  "agent_output_audio_format": "pcm_8000",
                  "optimize_streaming_latency": 0,
                  "stability": 0,
                  "speed": 0.7,
                  "similarity_boost": 0,
                  "clone_strength": 0,
                  "text_normalisation_type": "system_prompt",
                  "pronunciation_dictionary_locators": [
                      {
                          "pronunciation_dictionary_id": "test-value",
                          "version_id": "test-value"
                      }
                  ],
                  "enable_phoneme_tags": true,
                  "audio_effects": {
                      "filter_preset_id": "test-value",
                      "distance": 0,
                      "environment_id": "test-value",
                      "background_noise_id": "test-value",
                      "send_level": 0,
                      "pan": -1
                  }
              },
              "conversation": {
                  "text_only": true,
                  "max_duration_seconds": 1,
                  "client_events": [
                      "conversation_initiation_metadata"
                  ],
                  "file_input": {
                      "enabled": true,
                      "max_files_in_memory": 1,
                      "max_files_per_conversation": 1
                  },
                  "monitoring_enabled": true,
                  "monitoring_events": [
                      "conversation_initiation_metadata"
                  ],
                  "dtmf_input_settings": {
                      "dtmf_input_timeout": 0.5,
                      "hash_terminator": true,
                      "redact_input": true
                  },
                  "background_sound": {
                      "source_type": "preset",
                      "source_id": "office2",
                      "volume": 0.01,
                      "crossfade_loop": true
                  },
                  "source_attribution": true
              },
              "language_presets": {
                  "key": {
                      "overrides": {
                          "asr": {
                              "keywords": [
                                  "test-value"
                              ]
                          },
                          "turn": {
                              "soft_timeout_config": {
                                  "message": "test-value",
                                  "additional_soft_timeout_messages": [
                                      "test-value"
                                  ]
                              },
                              "noisy_environment_message": "test-value"
                          },
                          "tts": {
                              "model_id": "eleven_turbo_v2",
                              "voice_id": "test-value",
                              "supported_voices": [
                                  {
                                      "label": "test-value",
                                      "voice_id": "test-value",
                                      "description": "test-value",
                                      "language": "test-value",
                                      "model_family": "turbo",
                                      "optimize_streaming_latency": 0,
                                      "stability": 0,
                                      "speed": 0.7,
                                      "similarity_boost": 0,
                                      "clone_strength": 0
                                  }
                              ],
                              "stability": 1,
                              "speed": 1,
                              "similarity_boost": 1,
                              "clone_strength": 1,
                              "pronunciation_dictionary_locators": [
                                  {
                                      "pronunciation_dictionary_id": "test-value",
                                      "version_id": "test-value"
                                  }
                              ]
                          },
                          "conversation": {
                              "text_only": true,
                              "max_duration_seconds": 1
                          },
                          "agent": {
                              "first_message": "test-value",
                              "language": "test-value",
                              "max_conversation_duration_message": "test-value",
                              "prompt": {
                                  "prompt": "test-value",
                                  "llm": "gpt-4o-mini",
                                  "reasoning_effort": "none",
                                  "tool_ids": [
                                      "test-value"
                                  ],
                                  "tool_ids_strict": true,
                                  "native_mcp_server_ids": [
                                      "test-value"
                                  ],
                                  "knowledge_base": [
                                      {
                                          "type": "file",
                                          "name": "test-value",
                                          "id": "test-value",
                                          "usage_mode": "prompt"
                                      }
                                  ]
                              }
                          }
                      },
                      "first_message_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      },
                      "soft_timeout_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      },
                      "noisy_environment_message_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      }
                  }
              },
              "agent": {
                  "first_message": "test-value",
                  "language": "test-value",
                  "hinglish_mode": true,
                  "dynamic_variables": "test-value",
                  "disable_first_message_interruptions": true,
                  "max_conversation_duration_message": "test-value",
                  "text_behavior_overrides": {
                      "key": {
                          "verbosity": "auto",
                          "output_format": "mp3_22050_32",
                          "interaction_budget": "realtime"
                      }
                  },
                  "subagent_config": {
                      "agents": [
                          {
                              "execution_mode": "immediate",
                              "timeout_secs": 10,
                              "agent_id": "test-value",
                              "branch_id": "test-value",
                              "description": "test-value",
                              "parameters": {
                                  "description": "test-value",
                                  "dynamic_variable": "test-value",
                                  "constant_value": {
                                      "key": "test-value"
                                  },
                                  "is_omitted": true,
                                  "type": "object",
                                  "required": [
                                      "test-value"
                                  ],
                                  "properties": {
                                      "key": {
                                          "type": "boolean",
                                          "description": "test-value",
                                          "enum": [
                                              "test-value"
                                          ],
                                          "is_system_provided": true,
                                          "dynamic_variable": "test-value",
                                          "allowed_values": {
                                              "dynamic_variable": "test-value"
                                          },
                                          "allowed_values_dynamic_variable": "test-value",
                                          "constant_value": "test-value",
                                          "is_omitted": true
                                      }
                                  },
                                  "required_constraints": {
                                      "any_of": [
                                          {
                                              "required": [
                                                  "test-value"
                                              ]
                                          }
                                      ],
                                      "all_of": [
                                          {
                                              "required": [
                                                  "test-value"
                                              ]
                                          }
                                      ]
                                  }
                              }
                          }
                      ],
                      "self_subagent": {
                          "execution_mode": "immediate",
                          "timeout_secs": 10,
                          "description": "test-value"
                      }
                  },
                  "prompt": {
                      "prompt": "test-value",
                      "llm": "gpt-4o-mini",
                      "reasoning_effort": "none",
                      "service_tier": "standard",
                      "thinking_budget": 1,
                      "enable_reasoning_summary": true,
                      "temperature": 1,
                      "max_tokens": 1,
                      "tool_ids": [
                          "test-value"
                      ],
                      "tool_ids_strict": true,
                      "built_in_tools": {
                          "transfer_to_agent": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "end_call": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "language_detection": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "transfer_to_number": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "skip_turn": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "play_keypad_touch_tone": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "voicemail_detection": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          }
                      },
                      "enable_parallel_tool_calls": true,
                      "mcp_server_ids": [
                          "test-value"
                      ],
                      "native_mcp_server_ids": [
                          "test-value"
                      ],
                      "knowledge_base": [
                          {
                              "type": "file",
                              "name": "test-value",
                              "id": "test-value",
                              "usage_mode": "prompt"
                          }
                      ],
                      "custom_llm": {
                          "url": "test-value",
                          "model_id": "test-value",
                          "api_key": {
                              "secret_id": "test-value"
                          },
                          "auth_connection": {
                              "auth_connection_id": "test-value"
                          },
                          "request_headers": {
                              "key": "test-value"
                          },
                          "api_version": "test-value",
                          "api_type": "chat_completions"
                      },
                      "ignore_default_personality": true,
                      "rag": {
                          "enabled": true,
                          "embedding_model": "e5_mistral_7b_instruct",
                          "max_vector_distance": 1,
                          "max_documents_length": 1,
                          "max_retrieved_rag_chunks_count": 20,
                          "num_candidates": 10000,
                          "query_rewrite_prompt_override": "test-value",
                          "knowledge_base_tool_info": {
                              "enabled_strategies": [
                                  "cat"
                              ]
                          }
                      },
                      "timezone": "test-value",
                      "backup_llm_config": {
                          "preference": "default"
                      },
                      "cascade_timeout_seconds": 2,
                      "tools": [
                          {
                              "type": "webhook",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 5,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "dynamic_variables": {
                                  "dynamic_variable_placeholders": {
                                      "key": "test-value"
                                  }
                              },
                              "execution_mode": "immediate",
                              "api_schema": {
                                  "request_headers": {
                                      "key": "test-value"
                                  },
                                  "url": "test-value",
                                  "method": "GET",
                                  "path_params_schema": {
                                      "key": {
                                          "type": "boolean",
                                          "description": "test-value",
                                          "enum": [
                                              "test-value"
                                          ],
                                          "is_system_provided": true,
                                          "dynamic_variable": "test-value",
                                          "allowed_values": {
                                              "dynamic_variable": "test-value"
                                          },
                                          "allowed_values_dynamic_variable": "test-value",
                                          "constant_value": "test-value",
                                          "is_omitted": true
                                      }
                                  },
                                  "query_params_schema": {
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required": [
                                          "test-value"
                                      ]
                                  },
                                  "request_body_schema": {
                                      "description": "test-value",
                                      "dynamic_variable": "test-value",
                                      "constant_value": {
                                          "key": "test-value"
                                      },
                                      "is_omitted": true,
                                      "type": "object",
                                      "required": [
                                          "test-value"
                                      ],
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required_constraints": {
                                          "any_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ],
                                          "all_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ]
                                      }
                                  },
                                  "response_body_schema": {
                                      "description": "test-value",
                                      "dynamic_variable": "test-value",
                                      "constant_value": {
                                          "key": "test-value"
                                      },
                                      "is_omitted": true,
                                      "type": "object",
                                      "required": [
                                          "test-value"
                                      ],
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required_constraints": {
                                          "any_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ],
                                          "all_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ]
                                      }
                                  },
                                  "response_filter": {
                                      "mode": "all",
                                      "filters": [
                                          "test-value"
                                      ],
                                      "content_type": "application/json"
                                  },
                                  "content_type": "application/json",
                                  "auth_resolved_params": [
                                      "test-value"
                                  ],
                                  "auth_connection": {
                                      "auth_connection_id": "test-value"
                                  }
                              },
                              "follow_redirects": true,
                              "follow_redirects_allowed_domains": [
                                  "test-value"
                              ]
                          }
                      ]
                  }
              }
          },
          "metadata": {
              "created_at_unix_secs": 1,
              "updated_at_unix_secs": 1
          },
          "platform_settings": {
              "evaluation": {
                  "criteria": [
                      {
                          "id": "test-value",
                          "name": "test-value",
                          "type": "prompt",
                          "conversation_goal_prompt": "test-value",
                          "use_knowledge_base": true,
                          "scope": "conversation",
                          "llm": "gpt-4o-mini",
                          "scoring_mode": "binary",
                          "max_score": 1,
                          "score_instructions": "test-value"
                      }
                  ]
              },
              "widget": {
                  "variant": "tiny",
                  "placement": "top-left",
                  "expandable": "never",
                  "avatar": {
                      "type": "orb",
                      "color_1": "test-value",
                      "color_2": "test-value"
                  },
                  "feedback_mode": "none",
                  "end_feedback": {
                      "type": "rating"
                  },
                  "bg_color": "test-value",
                  "text_color": "test-value",
                  "btn_color": "test-value",
                  "btn_text_color": "test-value",
                  "border_color": "test-value",
                  "focus_color": "test-value",
                  "border_radius": 1,
                  "btn_radius": 1,
                  "action_text": "test-value",
                  "start_call_text": "test-value",
                  "end_call_text": "test-value",
                  "expand_text": "test-value",
                  "listening_text": "test-value",
                  "speaking_text": "test-value",
                  "shareable_page_text": "test-value",
                  "shareable_page_show_terms": true,
                  "terms_text": "test-value",
                  "terms_html": "test-value",
                  "terms_key": "test-value",
                  "show_avatar_when_collapsed": true,
                  "disable_banner": true,
                  "override_link": "test-value",
                  "markdown_link_allowed_hosts": [
                      {
                          "hostname": "test-value"
                      }
                  ],
                  "markdown_link_include_www": true,
                  "markdown_link_allow_http": true,
                  "mic_muting_enabled": true,
                  "transcript_enabled": true,
                  "text_input_enabled": true,
                  "conversation_mode_toggle_enabled": true,
                  "default_expanded": true,
                  "always_expanded": true,
                  "dismissible": true,
                  "show_agent_status": true,
                  "show_conversation_id": true,
                  "strip_audio_tags": true,
                  "syntax_highlight_theme": "light",
                  "text_contents": {
                      "main_label": "test-value",
                      "start_call": "test-value",
                      "start_chat": "test-value",
                      "new_call": "test-value",
                      "end_call": "test-value",
                      "mute_microphone": "test-value",
                      "change_language": "test-value",
                      "collapse": "test-value",
                      "expand": "test-value",
                      "copied": "test-value",
                      "accept_terms": "test-value",
                      "dismiss_terms": "test-value",
                      "listening_status": "test-value",
                      "speaking_status": "test-value",
                      "connecting_status": "test-value",
                      "chatting_status": "test-value",
                      "queue_waiting_status": "test-value",
                      "queue_waiting_status_short": "test-value",
                      "input_label": "test-value",
                      "input_placeholder": "test-value",
                      "input_placeholder_text_only": "test-value",
                      "input_placeholder_new_conversation": "test-value",
                      "user_ended_conversation": "test-value",
                      "agent_ended_conversation": "test-value",
                      "conversation_id": "test-value",
                      "error_occurred": "test-value",
                      "queue_timed_out": "test-value",
                      "copy_id": "test-value",
                      "initiate_feedback": "test-value",
                      "request_follow_up_feedback": "test-value",
                      "thanks_for_feedback": "test-value",
                      "thanks_for_feedback_details": "test-value",
                      "follow_up_feedback_placeholder": "test-value",
                      "submit": "test-value",
                      "go_back": "test-value",
                      "send_message": "test-value",
                      "text_mode": "test-value",
                      "voice_mode": "test-value",
                      "switched_to_text_mode": "test-value",
                      "switched_to_voice_mode": "test-value",
                      "copy": "test-value",
                      "download": "test-value",
                      "wrap": "test-value",
                      "agent_working": "test-value",
                      "agent_done": "test-value",
                      "agent_error": "test-value",
                      "attach_file": "test-value",
                      "remove_file": "test-value",
                      "file_upload_error": "test-value",
                      "file_type_unsupported": "test-value",
                      "file_too_large": "test-value",
                      "file_limit_reached": "test-value",
                      "typing_indicator": "test-value",
                      "rich_content_unavailable": "test-value"
                  },
                  "styles": {
                      "base": "test-value",
                      "base_hover": "test-value",
                      "base_active": "test-value",
                      "base_border": "test-value",
                      "base_subtle": "test-value",
                      "base_primary": "test-value",
                      "base_error": "test-value",
                      "accent": "test-value",
                      "accent_hover": "test-value",
                      "accent_active": "test-value",
                      "accent_border": "test-value",
                      "accent_subtle": "test-value",
                      "accent_primary": "test-value",
                      "overlay_padding": 1,
                      "button_radius": 1,
                      "input_radius": 1,
                      "bubble_radius": 1,
                      "sheet_radius": 1,
                      "compact_sheet_radius": 1,
                      "dropdown_sheet_radius": 1
                  },
                  "show_resize_button": true,
                  "end_confirmation_enabled": true,
                  "mobile_fullscreen": true,
                  "transcript_speech_sync_enabled": true,
                  "language_selector": true,
                  "supports_text_only": true,
                  "custom_avatar_path": "test-value",
                  "language_presets": {
                      "key": {
                          "text_contents": {
                              "main_label": "test-value",
                              "start_call": "test-value",
                              "start_chat": "test-value",
                              "new_call": "test-value",
                              "end_call": "test-value",
                              "mute_microphone": "test-value",
                              "change_language": "test-value",
                              "collapse": "test-value",
                              "expand": "test-value",
                              "copied": "test-value",
                              "accept_terms": "test-value",
                              "dismiss_terms": "test-value",
                              "listening_status": "test-value",
                              "speaking_status": "test-value",
                              "connecting_status": "test-value",
                              "chatting_status": "test-value",
                              "queue_waiting_status": "test-value",
                              "queue_waiting_status_short": "test-value",
                              "input_label": "test-value",
                              "input_placeholder": "test-value",
                              "input_placeholder_text_only": "test-value",
                              "input_placeholder_new_conversation": "test-value",
                              "user_ended_conversation": "test-value",
                              "agent_ended_conversation": "test-value",
                              "conversation_id": "test-value",
                              "error_occurred": "test-value",
                              "queue_timed_out": "test-value",
                              "copy_id": "test-value",
                              "initiate_feedback": "test-value",
                              "request_follow_up_feedback": "test-value",
                              "thanks_for_feedback": "test-value",
                              "thanks_for_feedback_details": "test-value",
                              "follow_up_feedback_placeholder": "test-value",
                              "submit": "test-value",
                              "go_back": "test-value",
                              "send_message": "test-value",
                              "text_mode": "test-value",
                              "voice_mode": "test-value",
                              "switched_to_text_mode": "test-value",
                              "switched_to_voice_mode": "test-value",
                              "copy": "test-value",
                              "download": "test-value",
                              "wrap": "test-value",
                              "agent_working": "test-value",
                              "agent_done": "test-value",
                              "agent_error": "test-value",
                              "attach_file": "test-value",
                              "remove_file": "test-value",
                              "file_upload_error": "test-value",
                              "file_type_unsupported": "test-value",
                              "file_too_large": "test-value",
                              "file_limit_reached": "test-value",
                              "typing_indicator": "test-value",
                              "rich_content_unavailable": "test-value"
                          },
                          "text_contents_translation": {
                              "source": {
                                  "key": "test-value"
                              },
                              "text": {
                                  "key": "test-value"
                              }
                          },
                          "terms_text": "test-value",
                          "terms_html": "test-value",
                          "terms_key": "test-value",
                          "terms_translation": {
                              "source_hash": "test-value",
                              "text": "test-value"
                          }
                      }
                  }
              },
              "data_collection": {
                  "key": {
                      "type": "boolean",
                      "description": "test-value",
                      "enum": [
                          "test-value"
                      ],
                      "is_system_provided": true,
                      "dynamic_variable": "test-value",
                      "allowed_values": {
                          "dynamic_variable": "test-value"
                      },
                      "allowed_values_dynamic_variable": "test-value",
                      "constant_value": "test-value",
                      "is_omitted": true,
                      "name": "test-value",
                      "llm": "gpt-4o-mini"
                  }
              },
              "data_collection_scopes": {
                  "key": "conversation"
              },
              "analysis_items": {
                  "evaluation_criteria": [
                      {
                          "source": "user",
                          "analysis_item_id": "test-value",
                          "version_id": "test-value",
                          "additional_version_ids": [
                              "test-value"
                          ],
                          "scope": "conversation",
                          "weight": 1
                      }
                  ],
                  "data_collection": [
                      {
                          "source": "user",
                          "analysis_item_id": "test-value",
                          "version_id": "test-value",
                          "scope": "conversation"
                      }
                  ]
              },
              "overrides": {
                  "conversation_config_override": {
                      "asr": {
                          "keywords": true
                      },
                      "turn": {
                          "soft_timeout_config": {
                              "message": true,
                              "additional_soft_timeout_messages": true
                          },
                          "noisy_environment_message": true
                      },
                      "tts": {
                          "model_id": true,
                          "voice_id": true,
                          "supported_voices": true,
                          "stability": true,
                          "speed": true,
                          "similarity_boost": true,
                          "clone_strength": true,
                          "pronunciation_dictionary_locators": true
                      },
                      "conversation": {
                          "text_only": true,
                          "max_duration_seconds": true
                      },
                      "agent": {
                          "first_message": true,
                          "language": true,
                          "max_conversation_duration_message": true,
                          "prompt": {
                              "prompt": true,
                              "llm": true,
                              "reasoning_effort": true,
                              "tool_ids": true,
                              "tool_ids_strict": true,
                              "native_mcp_server_ids": true,
                              "knowledge_base": true
                          }
                      }
                  },
                  "custom_llm_extra_body": true,
                  "enable_conversation_initiation_client_data_from_webhook": true,
                  "enable_starting_workflow_node_id_from_client": true,
                  "enable_procedure_ids_from_client": true
              },
              "workspace_overrides": {
                  "conversation_initiation_client_data_webhook": {
                      "url": "test-value",
                      "request_headers": {
                          "key": "test-value"
                      }
                  },
                  "webhooks": {
                      "post_call_webhook_id": "test-value",
                      "events": [
                          "transcript"
                      ],
                      "transcript_format": "json",
                      "exclude_transcript": true,
                      "send_audio": true
                  }
              },
              "testing": {
                  "attached_tests": [
                      {
                          "test_id": "test-value",
                          "workflow_node_id": "test-value"
                      }
                  ]
              },
              "archived": true,
              "guardrails": {
                  "version": "1",
                  "focus": {
                      "is_enabled": true
                  },
                  "prompt_injection": {
                      "is_enabled": true
                  },
                  "content": {
                      "execution_mode": "streaming",
                      "config": {
                          "sexual": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "violence": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "harassment": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "self_harm": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "profanity": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "religion_or_politics": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "medical_and_legal_information": {
                              "is_enabled": true,
                              "threshold": 1
                          }
                      },
                      "trigger_action": {
                          "type": "end_call"
                      }
                  },
                  "custom": {
                      "config": {
                          "configs": [
                              {
                                  "is_enabled": true,
                                  "name": "test-value",
                                  "prompt": "test-value",
                                  "execution_mode": "streaming",
                                  "model": "gemini-2.5-flash-lite",
                                  "service_tier": "standard",
                                  "history_message_count": 0,
                                  "trigger_action": {
                                      "type": "end_call"
                                  },
                                  "evaluate_full_response_only": true
                              }
                          ]
                      }
                  }
              },
              "summary_language": "test-value",
              "auto_translate_transcript_to_app_language": true,
              "auth": {
                  "enable_auth": true,
                  "allowlist": [
                      {
                          "hostname": "test-value"
                      }
                  ],
                  "require_origin_header": true,
                  "shareable_token": "test-value"
              },
              "call_limits": {
                  "agent_concurrency_limit": 1,
                  "daily_limit": 1,
                  "bursting_enabled": true
              },
              "queueing_config": {
                  "enabled": true,
                  "wait_timeout_seconds": 1800,
                  "hold_audio": {
                      "audio_path": "test-value",
                      "audio_url": "test-value",
                      "original_filename": "test-value",
                      "duration_secs": 1,
                      "size_bytes": 1
                  }
              },
              "privacy": {
                  "record_voice": true,
                  "retention_days": 1,
                  "delete_transcript_and_pii": true,
                  "delete_audio": true,
                  "apply_to_existing_conversations": true,
                  "zero_retention_mode": true,
                  "conversation_history_redaction": {
                      "enabled": true,
                      "entities": [
                          "name"
                      ],
                      "excluded_data_collection_ids": [
                          "test-value"
                      ]
                  }
              },
              "trust_context": "unknown",
              "analysis_llm": "gpt-4o-mini",
              "alerting": {
                  "monitor_configs": {
                      "key": {
                          "enabled": true,
                          "threshold": 0,
                          "relative_increase_threshold": 0,
                          "min_failure_count": 1,
                          "min_history_bucket_count": 1,
                          "min_sample_count": 1,
                          "suspect_trigger_threshold": 1,
                          "auto_resolve_after_inactive_minutes": 1
                      }
                  },
                  "auto_resolve_after_inactive_minutes": 1,
                  "environments": [
                      "test-value"
                  ],
                  "notifiers": [
                      {
                          "type": "webhook",
                          "webhook_id": "test-value"
                      }
                  ]
              },
              "safety": {
                  "is_blocked_ivc": true,
                  "is_blocked_non_ivc": true,
                  "ignore_safety_evaluation": true
              }
          },
          "phone_numbers": [
              {
                  "phone_number": "test-value",
                  "label": "test-value",
                  "supports_inbound": true,
                  "supports_outbound": true,
                  "phone_number_id": "test-value",
                  "assigned_agent": {
                      "agent_id": "test-value",
                      "agent_name": "test-value",
                      "environment": "test-value",
                      "branch_id": "test-value"
                  },
                  "provider": "twilio"
              }
          ],
          "whatsapp_accounts": [
              {
                  "business_account_id": "test-value",
                  "phone_number_id": "test-value",
                  "business_account_name": "test-value",
                  "phone_number_name": "test-value",
                  "phone_number": "test-value",
                  "account_type": "cloud_api",
                  "assigned_agent_id": "test-value",
                  "enable_messaging": true,
                  "enable_audio_message_response": true,
                  "enable_typing_indicator": true,
                  "assigned_agent_name": "test-value",
                  "is_token_expired": true
              }
          ],
          "workflow": {
              "edges": {
                  "key": {
                      "source": "test-value",
                      "target": "test-value",
                      "forward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "backward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "reroutes": [
                          {
                              "x": 1,
                              "y": 1
                          }
                      ]
                  }
              },
              "nodes": {
                  "key": {
                      "type": "start",
                      "position": {
                          "x": 1,
                          "y": 1
                      },
                      "edge_order": [
                          "test-value"
                      ]
                  }
              },
              "prevent_subagent_loops": true
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "tags": [
              "test-value"
          ],
          "version_id": "test-value",
          "branch_id": "test-value",
          "main_branch_id": "test-value",
          "procedures": {
              "key": {
                  "procedure_id": "test-value",
                  "version_id": "test-value",
                  "name": "test-value",
                  "type": "free_form",
                  "trigger": "test-value",
                  "referenced_tool_ids": [
                      "test-value"
                  ],
                  "referenced_kb_ids": [
                      "test-value"
                  ],
                  "referenced_procedure_ids": [
                      "test-value"
                  ],
                  "referenced_dynamic_variables": [
                      "test-value"
                  ],
                  "written_dynamic_variables": [
                      "test-value"
                  ],
                  "folder_parent_id": "test-value"
              }
          },
          "default_hold_audio_url": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->get(
      request: new \ElevenLabs\Agents\Requests\GetAgentsRequest([
        'versionId' => 'version_id',
        'branchId' => 'branch_id',
        'includeProcedureGeneratedWorkflowElements' => true
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testUpdateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value",
          "name": "test-value",
          "conversation_config": {
              "asr": {
                  "quality": "high",
                  "provider": "elevenlabs",
                  "user_input_audio_format": "pcm_8000",
                  "keywords": [
                      "test-value"
                  ]
              },
              "turn": {
                  "turn_timeout": 1,
                  "initial_wait_time": 1,
                  "silence_end_call_timeout": 1,
                  "turn_eagerness": "patient",
                  "spelling_patience": "auto",
                  "speculative_turn": true,
                  "retranscribe_on_turn_timeout": true,
                  "turn_model": "turn_v2",
                  "interruption_ignore_terms": [
                      "test-value"
                  ],
                  "interruption_ignore_term_languages": [
                      "test-value"
                  ],
                  "merge_with_default_ignore_terms": true,
                  "transcribe_on_disabled_interruptions": true,
                  "soft_timeout_config": {
                      "timeout_seconds": 1,
                      "message": "test-value",
                      "additional_soft_timeout_messages": [
                          "test-value"
                      ],
                      "use_llm_generated_message": true,
                      "randomize_fillers": true,
                      "max_soft_timeouts_per_generation": 1,
                      "llm_generated_message_prompt_override": "test-value",
                      "disable_until_first_user_message": true
                  },
                  "noisy_environment_detection": true,
                  "noisy_environment_message": "test-value"
              },
              "tts": {
                  "model_id": "eleven_turbo_v2",
                  "voice_id": "test-value",
                  "supported_voices": [
                      {
                          "label": "test-value",
                          "voice_id": "test-value",
                          "description": "test-value",
                          "language": "test-value",
                          "model_family": "turbo",
                          "optimize_streaming_latency": 0,
                          "stability": 0,
                          "speed": 0.7,
                          "similarity_boost": 0,
                          "clone_strength": 0
                      }
                  ],
                  "expressive_mode": true,
                  "suggested_audio_tags": [
                      {
                          "tag": "test-value",
                          "description": "test-value"
                      }
                  ],
                  "agent_output_audio_format": "pcm_8000",
                  "optimize_streaming_latency": 0,
                  "stability": 0,
                  "speed": 0.7,
                  "similarity_boost": 0,
                  "clone_strength": 0,
                  "text_normalisation_type": "system_prompt",
                  "pronunciation_dictionary_locators": [
                      {
                          "pronunciation_dictionary_id": "test-value",
                          "version_id": "test-value"
                      }
                  ],
                  "enable_phoneme_tags": true,
                  "audio_effects": {
                      "filter_preset_id": "test-value",
                      "distance": 0,
                      "environment_id": "test-value",
                      "background_noise_id": "test-value",
                      "send_level": 0,
                      "pan": -1
                  }
              },
              "conversation": {
                  "text_only": true,
                  "max_duration_seconds": 1,
                  "client_events": [
                      "conversation_initiation_metadata"
                  ],
                  "file_input": {
                      "enabled": true,
                      "max_files_in_memory": 1,
                      "max_files_per_conversation": 1
                  },
                  "monitoring_enabled": true,
                  "monitoring_events": [
                      "conversation_initiation_metadata"
                  ],
                  "dtmf_input_settings": {
                      "dtmf_input_timeout": 0.5,
                      "hash_terminator": true,
                      "redact_input": true
                  },
                  "background_sound": {
                      "source_type": "preset",
                      "source_id": "office2",
                      "volume": 0.01,
                      "crossfade_loop": true
                  },
                  "source_attribution": true
              },
              "language_presets": {
                  "key": {
                      "overrides": {
                          "asr": {
                              "keywords": [
                                  "test-value"
                              ]
                          },
                          "turn": {
                              "soft_timeout_config": {
                                  "message": "test-value",
                                  "additional_soft_timeout_messages": [
                                      "test-value"
                                  ]
                              },
                              "noisy_environment_message": "test-value"
                          },
                          "tts": {
                              "model_id": "eleven_turbo_v2",
                              "voice_id": "test-value",
                              "supported_voices": [
                                  {
                                      "label": "test-value",
                                      "voice_id": "test-value",
                                      "description": "test-value",
                                      "language": "test-value",
                                      "model_family": "turbo",
                                      "optimize_streaming_latency": 0,
                                      "stability": 0,
                                      "speed": 0.7,
                                      "similarity_boost": 0,
                                      "clone_strength": 0
                                  }
                              ],
                              "stability": 1,
                              "speed": 1,
                              "similarity_boost": 1,
                              "clone_strength": 1,
                              "pronunciation_dictionary_locators": [
                                  {
                                      "pronunciation_dictionary_id": "test-value",
                                      "version_id": "test-value"
                                  }
                              ]
                          },
                          "conversation": {
                              "text_only": true,
                              "max_duration_seconds": 1
                          },
                          "agent": {
                              "first_message": "test-value",
                              "language": "test-value",
                              "max_conversation_duration_message": "test-value",
                              "prompt": {
                                  "prompt": "test-value",
                                  "llm": "gpt-4o-mini",
                                  "reasoning_effort": "none",
                                  "tool_ids": [
                                      "test-value"
                                  ],
                                  "tool_ids_strict": true,
                                  "native_mcp_server_ids": [
                                      "test-value"
                                  ],
                                  "knowledge_base": [
                                      {
                                          "type": "file",
                                          "name": "test-value",
                                          "id": "test-value",
                                          "usage_mode": "prompt"
                                      }
                                  ]
                              }
                          }
                      },
                      "first_message_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      },
                      "soft_timeout_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      },
                      "noisy_environment_message_translation": {
                          "source_hash": "test-value",
                          "text": "test-value"
                      }
                  }
              },
              "agent": {
                  "first_message": "test-value",
                  "language": "test-value",
                  "hinglish_mode": true,
                  "dynamic_variables": "test-value",
                  "disable_first_message_interruptions": true,
                  "max_conversation_duration_message": "test-value",
                  "text_behavior_overrides": {
                      "key": {
                          "verbosity": "auto",
                          "output_format": "mp3_22050_32",
                          "interaction_budget": "realtime"
                      }
                  },
                  "subagent_config": {
                      "agents": [
                          {
                              "execution_mode": "immediate",
                              "timeout_secs": 10,
                              "agent_id": "test-value",
                              "branch_id": "test-value",
                              "description": "test-value",
                              "parameters": {
                                  "description": "test-value",
                                  "dynamic_variable": "test-value",
                                  "constant_value": {
                                      "key": "test-value"
                                  },
                                  "is_omitted": true,
                                  "type": "object",
                                  "required": [
                                      "test-value"
                                  ],
                                  "properties": {
                                      "key": {
                                          "type": "boolean",
                                          "description": "test-value",
                                          "enum": [
                                              "test-value"
                                          ],
                                          "is_system_provided": true,
                                          "dynamic_variable": "test-value",
                                          "allowed_values": {
                                              "dynamic_variable": "test-value"
                                          },
                                          "allowed_values_dynamic_variable": "test-value",
                                          "constant_value": "test-value",
                                          "is_omitted": true
                                      }
                                  },
                                  "required_constraints": {
                                      "any_of": [
                                          {
                                              "required": [
                                                  "test-value"
                                              ]
                                          }
                                      ],
                                      "all_of": [
                                          {
                                              "required": [
                                                  "test-value"
                                              ]
                                          }
                                      ]
                                  }
                              }
                          }
                      ],
                      "self_subagent": {
                          "execution_mode": "immediate",
                          "timeout_secs": 10,
                          "description": "test-value"
                      }
                  },
                  "prompt": {
                      "prompt": "test-value",
                      "llm": "gpt-4o-mini",
                      "reasoning_effort": "none",
                      "service_tier": "standard",
                      "thinking_budget": 1,
                      "enable_reasoning_summary": true,
                      "temperature": 1,
                      "max_tokens": 1,
                      "tool_ids": [
                          "test-value"
                      ],
                      "tool_ids_strict": true,
                      "built_in_tools": {
                          "transfer_to_agent": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "end_call": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "language_detection": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "transfer_to_number": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "skip_turn": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "play_keypad_touch_tone": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          },
                          "voicemail_detection": {
                              "type": "system",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 1,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "params": {
                                  "system_tool_type": "end_call"
                              }
                          }
                      },
                      "enable_parallel_tool_calls": true,
                      "mcp_server_ids": [
                          "test-value"
                      ],
                      "native_mcp_server_ids": [
                          "test-value"
                      ],
                      "knowledge_base": [
                          {
                              "type": "file",
                              "name": "test-value",
                              "id": "test-value",
                              "usage_mode": "prompt"
                          }
                      ],
                      "custom_llm": {
                          "url": "test-value",
                          "model_id": "test-value",
                          "api_key": {
                              "secret_id": "test-value"
                          },
                          "auth_connection": {
                              "auth_connection_id": "test-value"
                          },
                          "request_headers": {
                              "key": "test-value"
                          },
                          "api_version": "test-value",
                          "api_type": "chat_completions"
                      },
                      "ignore_default_personality": true,
                      "rag": {
                          "enabled": true,
                          "embedding_model": "e5_mistral_7b_instruct",
                          "max_vector_distance": 1,
                          "max_documents_length": 1,
                          "max_retrieved_rag_chunks_count": 20,
                          "num_candidates": 10000,
                          "query_rewrite_prompt_override": "test-value",
                          "knowledge_base_tool_info": {
                              "enabled_strategies": [
                                  "cat"
                              ]
                          }
                      },
                      "timezone": "test-value",
                      "backup_llm_config": {
                          "preference": "default"
                      },
                      "cascade_timeout_seconds": 2,
                      "tools": [
                          {
                              "type": "webhook",
                              "name": "test-value",
                              "description": "test-value",
                              "response_timeout_secs": 5,
                              "disable_interruptions": true,
                              "interruption_mode": "allow",
                              "force_pre_tool_speech": true,
                              "pre_tool_speech": "auto",
                              "assignments": [
                                  {
                                      "source": "response",
                                      "dynamic_variable": "test-value",
                                      "value_path": "test-value",
                                      "sanitize": true,
                                      "preserve_native_type": true
                                  }
                              ],
                              "tool_call_sound": "typing",
                              "tool_call_sound_behavior": "auto",
                              "tool_error_handling_mode": "auto",
                              "dynamic_variables": {
                                  "dynamic_variable_placeholders": {
                                      "key": "test-value"
                                  }
                              },
                              "execution_mode": "immediate",
                              "api_schema": {
                                  "request_headers": {
                                      "key": "test-value"
                                  },
                                  "url": "test-value",
                                  "method": "GET",
                                  "path_params_schema": {
                                      "key": {
                                          "type": "boolean",
                                          "description": "test-value",
                                          "enum": [
                                              "test-value"
                                          ],
                                          "is_system_provided": true,
                                          "dynamic_variable": "test-value",
                                          "allowed_values": {
                                              "dynamic_variable": "test-value"
                                          },
                                          "allowed_values_dynamic_variable": "test-value",
                                          "constant_value": "test-value",
                                          "is_omitted": true
                                      }
                                  },
                                  "query_params_schema": {
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required": [
                                          "test-value"
                                      ]
                                  },
                                  "request_body_schema": {
                                      "description": "test-value",
                                      "dynamic_variable": "test-value",
                                      "constant_value": {
                                          "key": "test-value"
                                      },
                                      "is_omitted": true,
                                      "type": "object",
                                      "required": [
                                          "test-value"
                                      ],
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required_constraints": {
                                          "any_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ],
                                          "all_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ]
                                      }
                                  },
                                  "response_body_schema": {
                                      "description": "test-value",
                                      "dynamic_variable": "test-value",
                                      "constant_value": {
                                          "key": "test-value"
                                      },
                                      "is_omitted": true,
                                      "type": "object",
                                      "required": [
                                          "test-value"
                                      ],
                                      "properties": {
                                          "key": {
                                              "type": "boolean",
                                              "description": "test-value",
                                              "enum": [
                                                  "test-value"
                                              ],
                                              "is_system_provided": true,
                                              "dynamic_variable": "test-value",
                                              "allowed_values": {
                                                  "dynamic_variable": "test-value"
                                              },
                                              "allowed_values_dynamic_variable": "test-value",
                                              "constant_value": "test-value",
                                              "is_omitted": true
                                          }
                                      },
                                      "required_constraints": {
                                          "any_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ],
                                          "all_of": [
                                              {
                                                  "required": [
                                                      "test-value"
                                                  ]
                                              }
                                          ]
                                      }
                                  },
                                  "response_filter": {
                                      "mode": "all",
                                      "filters": [
                                          "test-value"
                                      ],
                                      "content_type": "application/json"
                                  },
                                  "content_type": "application/json",
                                  "auth_resolved_params": [
                                      "test-value"
                                  ],
                                  "auth_connection": {
                                      "auth_connection_id": "test-value"
                                  }
                              },
                              "follow_redirects": true,
                              "follow_redirects_allowed_domains": [
                                  "test-value"
                              ]
                          }
                      ]
                  }
              }
          },
          "metadata": {
              "created_at_unix_secs": 1,
              "updated_at_unix_secs": 1
          },
          "platform_settings": {
              "evaluation": {
                  "criteria": [
                      {
                          "id": "test-value",
                          "name": "test-value",
                          "type": "prompt",
                          "conversation_goal_prompt": "test-value",
                          "use_knowledge_base": true,
                          "scope": "conversation",
                          "llm": "gpt-4o-mini",
                          "scoring_mode": "binary",
                          "max_score": 1,
                          "score_instructions": "test-value"
                      }
                  ]
              },
              "widget": {
                  "variant": "tiny",
                  "placement": "top-left",
                  "expandable": "never",
                  "avatar": {
                      "type": "orb",
                      "color_1": "test-value",
                      "color_2": "test-value"
                  },
                  "feedback_mode": "none",
                  "end_feedback": {
                      "type": "rating"
                  },
                  "bg_color": "test-value",
                  "text_color": "test-value",
                  "btn_color": "test-value",
                  "btn_text_color": "test-value",
                  "border_color": "test-value",
                  "focus_color": "test-value",
                  "border_radius": 1,
                  "btn_radius": 1,
                  "action_text": "test-value",
                  "start_call_text": "test-value",
                  "end_call_text": "test-value",
                  "expand_text": "test-value",
                  "listening_text": "test-value",
                  "speaking_text": "test-value",
                  "shareable_page_text": "test-value",
                  "shareable_page_show_terms": true,
                  "terms_text": "test-value",
                  "terms_html": "test-value",
                  "terms_key": "test-value",
                  "show_avatar_when_collapsed": true,
                  "disable_banner": true,
                  "override_link": "test-value",
                  "markdown_link_allowed_hosts": [
                      {
                          "hostname": "test-value"
                      }
                  ],
                  "markdown_link_include_www": true,
                  "markdown_link_allow_http": true,
                  "mic_muting_enabled": true,
                  "transcript_enabled": true,
                  "text_input_enabled": true,
                  "conversation_mode_toggle_enabled": true,
                  "default_expanded": true,
                  "always_expanded": true,
                  "dismissible": true,
                  "show_agent_status": true,
                  "show_conversation_id": true,
                  "strip_audio_tags": true,
                  "syntax_highlight_theme": "light",
                  "text_contents": {
                      "main_label": "test-value",
                      "start_call": "test-value",
                      "start_chat": "test-value",
                      "new_call": "test-value",
                      "end_call": "test-value",
                      "mute_microphone": "test-value",
                      "change_language": "test-value",
                      "collapse": "test-value",
                      "expand": "test-value",
                      "copied": "test-value",
                      "accept_terms": "test-value",
                      "dismiss_terms": "test-value",
                      "listening_status": "test-value",
                      "speaking_status": "test-value",
                      "connecting_status": "test-value",
                      "chatting_status": "test-value",
                      "queue_waiting_status": "test-value",
                      "queue_waiting_status_short": "test-value",
                      "input_label": "test-value",
                      "input_placeholder": "test-value",
                      "input_placeholder_text_only": "test-value",
                      "input_placeholder_new_conversation": "test-value",
                      "user_ended_conversation": "test-value",
                      "agent_ended_conversation": "test-value",
                      "conversation_id": "test-value",
                      "error_occurred": "test-value",
                      "queue_timed_out": "test-value",
                      "copy_id": "test-value",
                      "initiate_feedback": "test-value",
                      "request_follow_up_feedback": "test-value",
                      "thanks_for_feedback": "test-value",
                      "thanks_for_feedback_details": "test-value",
                      "follow_up_feedback_placeholder": "test-value",
                      "submit": "test-value",
                      "go_back": "test-value",
                      "send_message": "test-value",
                      "text_mode": "test-value",
                      "voice_mode": "test-value",
                      "switched_to_text_mode": "test-value",
                      "switched_to_voice_mode": "test-value",
                      "copy": "test-value",
                      "download": "test-value",
                      "wrap": "test-value",
                      "agent_working": "test-value",
                      "agent_done": "test-value",
                      "agent_error": "test-value",
                      "attach_file": "test-value",
                      "remove_file": "test-value",
                      "file_upload_error": "test-value",
                      "file_type_unsupported": "test-value",
                      "file_too_large": "test-value",
                      "file_limit_reached": "test-value",
                      "typing_indicator": "test-value",
                      "rich_content_unavailable": "test-value"
                  },
                  "styles": {
                      "base": "test-value",
                      "base_hover": "test-value",
                      "base_active": "test-value",
                      "base_border": "test-value",
                      "base_subtle": "test-value",
                      "base_primary": "test-value",
                      "base_error": "test-value",
                      "accent": "test-value",
                      "accent_hover": "test-value",
                      "accent_active": "test-value",
                      "accent_border": "test-value",
                      "accent_subtle": "test-value",
                      "accent_primary": "test-value",
                      "overlay_padding": 1,
                      "button_radius": 1,
                      "input_radius": 1,
                      "bubble_radius": 1,
                      "sheet_radius": 1,
                      "compact_sheet_radius": 1,
                      "dropdown_sheet_radius": 1
                  },
                  "show_resize_button": true,
                  "end_confirmation_enabled": true,
                  "mobile_fullscreen": true,
                  "transcript_speech_sync_enabled": true,
                  "language_selector": true,
                  "supports_text_only": true,
                  "custom_avatar_path": "test-value",
                  "language_presets": {
                      "key": {
                          "text_contents": {
                              "main_label": "test-value",
                              "start_call": "test-value",
                              "start_chat": "test-value",
                              "new_call": "test-value",
                              "end_call": "test-value",
                              "mute_microphone": "test-value",
                              "change_language": "test-value",
                              "collapse": "test-value",
                              "expand": "test-value",
                              "copied": "test-value",
                              "accept_terms": "test-value",
                              "dismiss_terms": "test-value",
                              "listening_status": "test-value",
                              "speaking_status": "test-value",
                              "connecting_status": "test-value",
                              "chatting_status": "test-value",
                              "queue_waiting_status": "test-value",
                              "queue_waiting_status_short": "test-value",
                              "input_label": "test-value",
                              "input_placeholder": "test-value",
                              "input_placeholder_text_only": "test-value",
                              "input_placeholder_new_conversation": "test-value",
                              "user_ended_conversation": "test-value",
                              "agent_ended_conversation": "test-value",
                              "conversation_id": "test-value",
                              "error_occurred": "test-value",
                              "queue_timed_out": "test-value",
                              "copy_id": "test-value",
                              "initiate_feedback": "test-value",
                              "request_follow_up_feedback": "test-value",
                              "thanks_for_feedback": "test-value",
                              "thanks_for_feedback_details": "test-value",
                              "follow_up_feedback_placeholder": "test-value",
                              "submit": "test-value",
                              "go_back": "test-value",
                              "send_message": "test-value",
                              "text_mode": "test-value",
                              "voice_mode": "test-value",
                              "switched_to_text_mode": "test-value",
                              "switched_to_voice_mode": "test-value",
                              "copy": "test-value",
                              "download": "test-value",
                              "wrap": "test-value",
                              "agent_working": "test-value",
                              "agent_done": "test-value",
                              "agent_error": "test-value",
                              "attach_file": "test-value",
                              "remove_file": "test-value",
                              "file_upload_error": "test-value",
                              "file_type_unsupported": "test-value",
                              "file_too_large": "test-value",
                              "file_limit_reached": "test-value",
                              "typing_indicator": "test-value",
                              "rich_content_unavailable": "test-value"
                          },
                          "text_contents_translation": {
                              "source": {
                                  "key": "test-value"
                              },
                              "text": {
                                  "key": "test-value"
                              }
                          },
                          "terms_text": "test-value",
                          "terms_html": "test-value",
                          "terms_key": "test-value",
                          "terms_translation": {
                              "source_hash": "test-value",
                              "text": "test-value"
                          }
                      }
                  }
              },
              "data_collection": {
                  "key": {
                      "type": "boolean",
                      "description": "test-value",
                      "enum": [
                          "test-value"
                      ],
                      "is_system_provided": true,
                      "dynamic_variable": "test-value",
                      "allowed_values": {
                          "dynamic_variable": "test-value"
                      },
                      "allowed_values_dynamic_variable": "test-value",
                      "constant_value": "test-value",
                      "is_omitted": true,
                      "name": "test-value",
                      "llm": "gpt-4o-mini"
                  }
              },
              "data_collection_scopes": {
                  "key": "conversation"
              },
              "analysis_items": {
                  "evaluation_criteria": [
                      {
                          "source": "user",
                          "analysis_item_id": "test-value",
                          "version_id": "test-value",
                          "additional_version_ids": [
                              "test-value"
                          ],
                          "scope": "conversation",
                          "weight": 1
                      }
                  ],
                  "data_collection": [
                      {
                          "source": "user",
                          "analysis_item_id": "test-value",
                          "version_id": "test-value",
                          "scope": "conversation"
                      }
                  ]
              },
              "overrides": {
                  "conversation_config_override": {
                      "asr": {
                          "keywords": true
                      },
                      "turn": {
                          "soft_timeout_config": {
                              "message": true,
                              "additional_soft_timeout_messages": true
                          },
                          "noisy_environment_message": true
                      },
                      "tts": {
                          "model_id": true,
                          "voice_id": true,
                          "supported_voices": true,
                          "stability": true,
                          "speed": true,
                          "similarity_boost": true,
                          "clone_strength": true,
                          "pronunciation_dictionary_locators": true
                      },
                      "conversation": {
                          "text_only": true,
                          "max_duration_seconds": true
                      },
                      "agent": {
                          "first_message": true,
                          "language": true,
                          "max_conversation_duration_message": true,
                          "prompt": {
                              "prompt": true,
                              "llm": true,
                              "reasoning_effort": true,
                              "tool_ids": true,
                              "tool_ids_strict": true,
                              "native_mcp_server_ids": true,
                              "knowledge_base": true
                          }
                      }
                  },
                  "custom_llm_extra_body": true,
                  "enable_conversation_initiation_client_data_from_webhook": true,
                  "enable_starting_workflow_node_id_from_client": true,
                  "enable_procedure_ids_from_client": true
              },
              "workspace_overrides": {
                  "conversation_initiation_client_data_webhook": {
                      "url": "test-value",
                      "request_headers": {
                          "key": "test-value"
                      }
                  },
                  "webhooks": {
                      "post_call_webhook_id": "test-value",
                      "events": [
                          "transcript"
                      ],
                      "transcript_format": "json",
                      "exclude_transcript": true,
                      "send_audio": true
                  }
              },
              "testing": {
                  "attached_tests": [
                      {
                          "test_id": "test-value",
                          "workflow_node_id": "test-value"
                      }
                  ]
              },
              "archived": true,
              "guardrails": {
                  "version": "1",
                  "focus": {
                      "is_enabled": true
                  },
                  "prompt_injection": {
                      "is_enabled": true
                  },
                  "content": {
                      "execution_mode": "streaming",
                      "config": {
                          "sexual": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "violence": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "harassment": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "self_harm": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "profanity": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "religion_or_politics": {
                              "is_enabled": true,
                              "threshold": 1
                          },
                          "medical_and_legal_information": {
                              "is_enabled": true,
                              "threshold": 1
                          }
                      },
                      "trigger_action": {
                          "type": "end_call"
                      }
                  },
                  "custom": {
                      "config": {
                          "configs": [
                              {
                                  "is_enabled": true,
                                  "name": "test-value",
                                  "prompt": "test-value",
                                  "execution_mode": "streaming",
                                  "model": "gemini-2.5-flash-lite",
                                  "service_tier": "standard",
                                  "history_message_count": 0,
                                  "trigger_action": {
                                      "type": "end_call"
                                  },
                                  "evaluate_full_response_only": true
                              }
                          ]
                      }
                  }
              },
              "summary_language": "test-value",
              "auto_translate_transcript_to_app_language": true,
              "auth": {
                  "enable_auth": true,
                  "allowlist": [
                      {
                          "hostname": "test-value"
                      }
                  ],
                  "require_origin_header": true,
                  "shareable_token": "test-value"
              },
              "call_limits": {
                  "agent_concurrency_limit": 1,
                  "daily_limit": 1,
                  "bursting_enabled": true
              },
              "queueing_config": {
                  "enabled": true,
                  "wait_timeout_seconds": 1800,
                  "hold_audio": {
                      "audio_path": "test-value",
                      "audio_url": "test-value",
                      "original_filename": "test-value",
                      "duration_secs": 1,
                      "size_bytes": 1
                  }
              },
              "privacy": {
                  "record_voice": true,
                  "retention_days": 1,
                  "delete_transcript_and_pii": true,
                  "delete_audio": true,
                  "apply_to_existing_conversations": true,
                  "zero_retention_mode": true,
                  "conversation_history_redaction": {
                      "enabled": true,
                      "entities": [
                          "name"
                      ],
                      "excluded_data_collection_ids": [
                          "test-value"
                      ]
                  }
              },
              "trust_context": "unknown",
              "analysis_llm": "gpt-4o-mini",
              "alerting": {
                  "monitor_configs": {
                      "key": {
                          "enabled": true,
                          "threshold": 0,
                          "relative_increase_threshold": 0,
                          "min_failure_count": 1,
                          "min_history_bucket_count": 1,
                          "min_sample_count": 1,
                          "suspect_trigger_threshold": 1,
                          "auto_resolve_after_inactive_minutes": 1
                      }
                  },
                  "auto_resolve_after_inactive_minutes": 1,
                  "environments": [
                      "test-value"
                  ],
                  "notifiers": [
                      {
                          "type": "webhook",
                          "webhook_id": "test-value"
                      }
                  ]
              },
              "safety": {
                  "is_blocked_ivc": true,
                  "is_blocked_non_ivc": true,
                  "ignore_safety_evaluation": true
              }
          },
          "phone_numbers": [
              {
                  "phone_number": "test-value",
                  "label": "test-value",
                  "supports_inbound": true,
                  "supports_outbound": true,
                  "phone_number_id": "test-value",
                  "assigned_agent": {
                      "agent_id": "test-value",
                      "agent_name": "test-value",
                      "environment": "test-value",
                      "branch_id": "test-value"
                  },
                  "provider": "twilio"
              }
          ],
          "whatsapp_accounts": [
              {
                  "business_account_id": "test-value",
                  "phone_number_id": "test-value",
                  "business_account_name": "test-value",
                  "phone_number_name": "test-value",
                  "phone_number": "test-value",
                  "account_type": "cloud_api",
                  "assigned_agent_id": "test-value",
                  "enable_messaging": true,
                  "enable_audio_message_response": true,
                  "enable_typing_indicator": true,
                  "assigned_agent_name": "test-value",
                  "is_token_expired": true
              }
          ],
          "workflow": {
              "edges": {
                  "key": {
                      "source": "test-value",
                      "target": "test-value",
                      "forward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "backward_condition": {
                          "label": "test-value",
                          "type": "unconditional"
                      },
                      "reroutes": [
                          {
                              "x": 1,
                              "y": 1
                          }
                      ]
                  }
              },
              "nodes": {
                  "key": {
                      "type": "start",
                      "position": {
                          "x": 1,
                          "y": 1
                      },
                      "edge_order": [
                          "test-value"
                      ]
                  }
              },
              "prevent_subagent_loops": true
          },
          "access_info": {
              "is_creator": true,
              "creator_name": "test-value",
              "creator_email": "test-value",
              "role": "admin",
              "anonymous_access_level_override": "admin",
              "access_source": "creator"
          },
          "tags": [
              "test-value"
          ],
          "version_id": "test-value",
          "branch_id": "test-value",
          "main_branch_id": "test-value",
          "procedures": {
              "key": {
                  "procedure_id": "test-value",
                  "version_id": "test-value",
                  "name": "test-value",
                  "type": "free_form",
                  "trigger": "test-value",
                  "referenced_tool_ids": [
                      "test-value"
                  ],
                  "referenced_kb_ids": [
                      "test-value"
                  ],
                  "referenced_procedure_ids": [
                      "test-value"
                  ],
                  "referenced_dynamic_variables": [
                      "test-value"
                  ],
                  "written_dynamic_variables": [
                      "test-value"
                  ],
                  "folder_parent_id": "test-value"
              }
          },
          "default_hold_audio_url": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $asrQuality = \ElevenLabs\Types\AsrQuality::High->value;

    $asrProvider = \ElevenLabs\Types\AsrProvider::Elevenlabs->value;

    $asrInputFormat = \ElevenLabs\Types\AsrInputFormat::Pcm8000->value;

    $asrConversationalConfig = new \ElevenLabs\Types\AsrConversationalConfig([
      'quality' => $asrQuality,
      'provider' => $asrProvider,
      'userInputAudioFormat' => $asrInputFormat,
      'keywords' => []
    ]);

    $turnEagerness = \ElevenLabs\Types\TurnEagerness::Patient->value;

    $spellingPatience = \ElevenLabs\Types\SpellingPatience::Auto->value;

    $turnModel = \ElevenLabs\Types\TurnModel::TurnV2->value;

    $softTimeoutConfig = new \ElevenLabs\Types\SoftTimeoutConfig([
      'timeoutSeconds' => -1,
      'message' => 'Hhmmmm...yeah.',
      'additionalSoftTimeoutMessages' => [],
      'useLlmGeneratedMessage' => true,
      'randomizeFillers' => false,
      'maxSoftTimeoutsPerGeneration' => 1,
      'llmGeneratedMessagePromptOverride' => 'llm_generated_message_prompt_override',
      'disableUntilFirstUserMessage' => false
    ]);

    $turnConfig = new \ElevenLabs\Types\TurnConfig([
      'turnTimeout' => 7,
      'initialWaitTime' => 0.63,
      'silenceEndCallTimeout' => -1,
      'turnEagerness' => $turnEagerness,
      'spellingPatience' => $spellingPatience,
      'speculativeTurn' => false,
      'retranscribeOnTurnTimeout' => true,
      'turnModel' => $turnModel,
      'interruptionIgnoreTerms' => [],
      'interruptionIgnoreTermLanguages' => [],
      'mergeWithDefaultIgnoreTerms' => false,
      'transcribeOnDisabledInterruptions' => true,
      'softTimeoutConfig' => $softTimeoutConfig,
      'noisyEnvironmentDetection' => true,
      'noisyEnvironmentMessage' =>
        "Uhh ... sorry, I\'m picking up some noise in the background. Could you move somewhere quieter?"
    ]);

    $ttsConversationalModel = \ElevenLabs\Types\TtsConversationalModel::ElevenTurboV2->value;

    $ttsModelFamily = \ElevenLabs\Types\TtsModelFamily::Turbo->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $supportedVoice = new \ElevenLabs\Types\SupportedVoice([
      'label' => 'label',
      'voiceId' => 'voice_id',
      'description' => 'description',
      'language' => 'language',
      'modelFamily' => $ttsModelFamily,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.42,
      'speed' => 0.78,
      'similarityBoost' => 0.33,
      'cloneStrength' => 0.41
    ]);

    $suggestedAudioTag = new \ElevenLabs\Types\SuggestedAudioTag([
      'tag' => 'tag',
      'description' => 'description'
    ]);

    $ttsOutputFormat = \ElevenLabs\Types\TtsOutputFormat::Pcm8000->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $textNormalisationType = \ElevenLabs\Types\TextNormalisationType::SystemPrompt->value;

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $effectsSpecOutput = new \ElevenLabs\Types\EffectsSpecOutput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.38,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.59
    ]);

    $ttsConversationalConfigOutput = new \ElevenLabs\Types\TtsConversationalConfigOutput([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'cjVigY5qzO86Huf0OWal',
      'supportedVoices' => [],
      'expressiveMode' => true,
      'suggestedAudioTags' => [],
      'agentOutputAudioFormat' => $ttsOutputFormat,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.5,
      'speed' => 1,
      'similarityBoost' => 0.8,
      'cloneStrength' => 0.91,
      'textNormalisationType' => $textNormalisationType,
      'pronunciationDictionaryLocators' => [],
      'enablePhonemeTags' => true,
      'audioEffects' => $effectsSpecOutput
    ]);

    $clientEvent = \ElevenLabs\Types\ClientEvent::ConversationInitiationMetadata->value;

    $fileInputConfig = new \ElevenLabs\Types\FileInputConfig([
      'enabled' => true,
      'maxFilesInMemory' => 10,
      'maxFilesPerConversation' => 10
    ]);

    $dtmfInputConfig = new \ElevenLabs\Types\DtmfInputConfig([
      'dtmfInputTimeout' => 2,
      'hashTerminator' => true,
      'redactInput' => false
    ]);

    $backgroundSoundSourceType = \ElevenLabs\Types\BackgroundSoundSourceType::Preset->value;

    $backgroundSoundPresetId = \ElevenLabs\Types\BackgroundSoundPresetId::Office2->value;

    $backgroundSoundConfig = new \ElevenLabs\Types\BackgroundSoundConfig([
      'sourceType' => $backgroundSoundSourceType,
      'sourceId' => $backgroundSoundPresetId,
      'volume' => 0.15,
      'crossfadeLoop' => true
    ]);

    $conversationConfigOutput = new \ElevenLabs\Types\ConversationConfigOutput([
      'textOnly' => false,
      'maxDurationSeconds' => 600,
      'clientEvents' => [],
      'fileInput' => $fileInputConfig,
      'monitoringEnabled' => true,
      'monitoringEvents' => [],
      'dtmfInputSettings' => $dtmfInputConfig,
      'backgroundSound' => $backgroundSoundConfig,
      'sourceAttribution' => false
    ]);

    $asrConversationalConfigOverride = new \ElevenLabs\Types\AsrConversationalConfigOverride([
      'keywords' => []
    ]);

    $softTimeoutConfigOverride = new \ElevenLabs\Types\SoftTimeoutConfigOverride([
      'message' => 'message',
      'additionalSoftTimeoutMessages' => []
    ]);

    $turnConfigOverride = new \ElevenLabs\Types\TurnConfigOverride([
      'softTimeoutConfig' => $softTimeoutConfigOverride,
      'noisyEnvironmentMessage' => 'noisy_environment_message'
    ]);

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 6.57,
      'speed' => 1.8,
      'similarityBoost' => 6.48,
      'cloneStrength' => 1.49,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => false,
      'maxDurationSeconds' => 5
    ]);

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $llmReasoningEffort = \ElevenLabs\Types\LlmReasoningEffort::None->value;

    $knowledgeBaseDocumentType = \ElevenLabs\Types\KnowledgeBaseDocumentType::File->value;

    $documentUsageModeEnum = \ElevenLabs\Types\DocumentUsageModeEnum::Prompt->value;

    $knowledgeBaseLocator = new \ElevenLabs\Types\KnowledgeBaseLocator([
      'type' => $knowledgeBaseDocumentType,
      'name' => 'name',
      'id' => 'id',
      'usageMode' => $documentUsageModeEnum
    ]);

    $promptAgentApiModelOverrideOutput = new \ElevenLabs\Types\PromptAgentApiModelOverrideOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideOutput = new \ElevenLabs\Types\AgentConfigOverrideOutput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideOutput
    ]);

    $conversationConfigClientOverrideOutput = new \ElevenLabs\Types\ConversationConfigClientOverrideOutput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideOutput
      ]
    );

    $languagePresetTranslation = new \ElevenLabs\Types\LanguagePresetTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $languagePresetOutput = new \ElevenLabs\Types\LanguagePresetOutput([
      'overrides' => $conversationConfigClientOverrideOutput,
      'firstMessageTranslation' => $languagePresetTranslation,
      'softTimeoutTranslation' => $languagePresetTranslation,
      'noisyEnvironmentMessageTranslation' => $languagePresetTranslation
    ]);

    $vadConfig = new \ElevenLabs\Types\VadConfig();

    $verbosity = \ElevenLabs\Types\Verbosity::Auto->value;

    $outputFormat = \ElevenLabs\Types\OutputFormat::Mp32205032->value;

    $interactionBudget = \ElevenLabs\Types\InteractionBudget::Realtime->value;

    $behaviorOverride = new \ElevenLabs\Types\BehaviorOverride([
      'verbosity' => $verbosity,
      'outputFormat' => $outputFormat,
      'interactionBudget' => $interactionBudget
    ]);

    $subAgentOutputExecutionMode = \ElevenLabs\Types\SubAgentOutputExecutionMode::Immediate->value;

    $objectJsonSchemaPropertyOutputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType::Object->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = []; // TODO: populate with required fields

    $objectJsonSchemaPropertyOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyOutput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput([
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => false,
      'type' => $objectJsonSchemaPropertyOutputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $subAgentOutput = new \ElevenLabs\Types\SubAgentOutput([
      'executionMode' => $subAgentOutputExecutionMode,
      'timeoutSecs' => 60,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'description' => 'description',
      'parameters' => $objectJsonSchemaPropertyOutput
    ]);

    $selfSubagentExecutionMode = \ElevenLabs\Types\SelfSubagentExecutionMode::Immediate->value;

    $selfSubagent = new \ElevenLabs\Types\SelfSubagent([
      'executionMode' => $selfSubagentExecutionMode,
      'timeoutSecs' => 60,
      'description' => 'description'
    ]);

    $subagentConfigOutput = new \ElevenLabs\Types\SubagentConfigOutput([
      'agents' => [],
      'selfSubagent' => $selfSubagent
    ]);

    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $systemToolConfigOutputType = \ElevenLabs\Types\SystemToolConfigOutputType::System->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $endCallToolConfigSystemToolType =
      \ElevenLabs\Types\EndCallToolConfigSystemToolType::EndCall->value;

    $endCallToolConfig = new \ElevenLabs\Types\EndCallToolConfig([
      'systemToolType' => $endCallToolConfigSystemToolType
    ]);
    $systemToolConfigOutputParams = \ElevenLabs\Types\SystemToolConfigOutputParams::endCall(
      $endCallToolConfig
    );

    $systemToolConfigOutput = new \ElevenLabs\Types\SystemToolConfigOutput([
      'type' => $systemToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'params' => $systemToolConfigOutputParams
    ]);

    $builtInToolsOutput = new \ElevenLabs\Types\BuiltInToolsOutput([
      'transferToAgent' => $systemToolConfigOutput,
      'endCall' => $systemToolConfigOutput,
      'languageDetection' => $systemToolConfigOutput,
      'transferToNumber' => $systemToolConfigOutput,
      'skipTurn' => $systemToolConfigOutput,
      'playKeypadTouchTone' => $systemToolConfigOutput,
      'voicemailDetection' => $systemToolConfigOutput
    ]);

    $customLlmApiKey = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $customLlmRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmapiType = \ElevenLabs\Types\CustomLlmapiType::ChatCompletions->value;

    $customLlm = new \ElevenLabs\Types\CustomLlm([
      'url' => 'url',
      'modelId' => 'model_id',
      'apiKey' => $customLlmApiKey,
      'authConnection' => $customLlmAuthConnection,
      'requestHeaders' => [],
      'apiVersion' => 'api_version',
      'apiType' => $customLlmapiType
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $searchStrategy = \ElevenLabs\Types\SearchStrategy::Cat->value;

    $knowledgeBaseToolInfo = new \ElevenLabs\Types\KnowledgeBaseToolInfo([
      'enabledStrategies' => []
    ]);

    $ragConfigOutput = new \ElevenLabs\Types\RagConfigOutput([
      'enabled' => true,
      'embeddingModel' => $embeddingModelEnum,
      'maxVectorDistance' => 0.5,
      'maxDocumentsLength' => 50000,
      'maxRetrievedRagChunksCount' => 5,
      'numCandidates' => 8647,
      'queryRewritePromptOverride' => 'query_rewrite_prompt_override',
      'knowledgeBaseToolInfo' => $knowledgeBaseToolInfo
    ]);

    $backupLlmDefaultPreference = \ElevenLabs\Types\BackupLlmDefaultPreference::Default_->value;

    $backupLlmDefault = new \ElevenLabs\Types\BackupLlmDefault([
      'preference' => $backupLlmDefaultPreference
    ]);
    $promptAgentApiModelOutputBackupLlmConfig = \ElevenLabs\Types\PromptAgentApiModelOutputBackupLlmConfig::default(
      $backupLlmDefault
    );

    $webhookToolConfigOutputType = \ElevenLabs\Types\WebhookToolConfigOutputType::Webhook->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigOutputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigOutputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputMethod::Get->value;

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutput = new \ElevenLabs\Types\QueryParamsJsonSchemaOutput([
      'properties' => [],
      'required' => []
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigOutputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigOutputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigOutput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigOutput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigOutputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaOutput,
      'requestBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigOutputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigOutputAuthConnection
    ]);

    $webhookToolConfigOutput = new \ElevenLabs\Types\WebhookToolConfigOutput([
      'type' => $webhookToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigOutput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $promptAgentApiModelOutputToolsItem = \ElevenLabs\Types\PromptAgentApiModelOutputToolsItem::webhook(
      $webhookToolConfigOutput
    );

    $promptAgentApiModelOutput = new \ElevenLabs\Types\PromptAgentApiModelOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'serviceTier' => $llmServiceTier,
      'thinkingBudget' => 3,
      'enableReasoningSummary' => true,
      'temperature' => 6.3,
      'maxTokens' => -1,
      'toolIds' => [],
      'toolIdsStrict' => false,
      'builtInTools' => $builtInToolsOutput,
      'enableParallelToolCalls' => true,
      'mcpServerIds' => [],
      'nativeMcpServerIds' => [],
      'knowledgeBase' => [],
      'customLlm' => $customLlm,
      'ignoreDefaultPersonality' => true,
      'rag' => $ragConfigOutput,
      'timezone' => 'timezone',
      'backupLlmConfig' => $promptAgentApiModelOutputBackupLlmConfig,
      'cascadeTimeoutSeconds' => 4,
      'tools' => []
    ]);

    $agentConfig = new \ElevenLabs\Types\AgentConfig([
      'firstMessage' => 'first_message',
      'language' => 'en',
      'hinglishMode' => false,
      'dynamicVariables' => [],
      'disableFirstMessageInterruptions' => false,
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'textBehaviorOverrides' => [],
      'subagentConfig' => $subagentConfigOutput,
      'prompt' => $promptAgentApiModelOutput
    ]);

    $conversationalConfig = new \ElevenLabs\Types\ConversationalConfig([
      'asr' => $asrConversationalConfig,
      'turn' => $turnConfig,
      'tts' => $ttsConversationalConfigOutput,
      'conversation' => $conversationConfigOutput,
      'languagePresets' => [],
      'vad' => $vadConfig,
      'agent' => $agentConfig
    ]);

    $promptEvaluationCriteriaType = \ElevenLabs\Types\PromptEvaluationCriteriaType::Prompt->value;

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $criteriaScoringMode = \ElevenLabs\Types\CriteriaScoringMode::Binary->value;

    $promptEvaluationCriteria = new \ElevenLabs\Types\PromptEvaluationCriteria([
      'id' => 'id',
      'name' => 'name',
      'type' => $promptEvaluationCriteriaType,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scope' => $analysisScope,
      'llm' => $llm,
      'scoringMode' => $criteriaScoringMode,
      'maxScore' => 100,
      'scoreInstructions' => 'score_instructions'
    ]);

    $evaluationSettingsInput = new \ElevenLabs\Types\EvaluationSettingsInput([
      'criteria' => []
    ]);

    $embedVariant = \ElevenLabs\Types\EmbedVariant::Tiny->value;

    $widgetPlacement = \ElevenLabs\Types\WidgetPlacement::TopLeft->value;

    $widgetExpandable = \ElevenLabs\Types\WidgetExpandable::Never->value;

    $orbAvatarType = \ElevenLabs\Types\OrbAvatarType::Orb->value;

    $orbAvatar = new \ElevenLabs\Types\OrbAvatar([
      'type' => $orbAvatarType,
      'color1' => '#2792dc',
      'color2' => '#9ce6e6'
    ]);
    $widgetConfigAvatar = \ElevenLabs\Types\WidgetConfigAvatar::orb($orbAvatar);

    $widgetFeedbackMode = \ElevenLabs\Types\WidgetFeedbackMode::None->value;

    $widgetEndFeedbackType = \ElevenLabs\Types\WidgetEndFeedbackType::Rating->value;

    $widgetEndFeedbackConfig = new \ElevenLabs\Types\WidgetEndFeedbackConfig([
      'type' => $widgetEndFeedbackType
    ]);

    $allowlistItem = new \ElevenLabs\Types\AllowlistItem([
      'hostname' => 'hostname'
    ]);

    $widgetConfigSyntaxHighlightTheme =
      \ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme::Light->value;

    $widgetTextContents = new \ElevenLabs\Types\WidgetTextContents([
      'mainLabel' => 'main_label',
      'startCall' => 'start_call',
      'startChat' => 'start_chat',
      'newCall' => 'new_call',
      'endCall' => 'end_call',
      'muteMicrophone' => 'mute_microphone',
      'changeLanguage' => 'change_language',
      'collapse' => 'collapse',
      'expand' => 'expand',
      'copied' => 'copied',
      'acceptTerms' => 'accept_terms',
      'dismissTerms' => 'dismiss_terms',
      'listeningStatus' => 'listening_status',
      'speakingStatus' => 'speaking_status',
      'connectingStatus' => 'connecting_status',
      'chattingStatus' => 'chatting_status',
      'queueWaitingStatus' => 'queue_waiting_status',
      'queueWaitingStatusShort' => 'queue_waiting_status_short',
      'inputLabel' => 'input_label',
      'inputPlaceholder' => 'input_placeholder',
      'inputPlaceholderTextOnly' => 'input_placeholder_text_only',
      'inputPlaceholderNewConversation' => 'input_placeholder_new_conversation',
      'userEndedConversation' => 'user_ended_conversation',
      'agentEndedConversation' => 'agent_ended_conversation',
      'conversationId' => 'conversation_id',
      'errorOccurred' => 'error_occurred',
      'queueTimedOut' => 'queue_timed_out',
      'copyId' => 'copy_id',
      'initiateFeedback' => 'initiate_feedback',
      'requestFollowUpFeedback' => 'request_follow_up_feedback',
      'thanksForFeedback' => 'thanks_for_feedback',
      'thanksForFeedbackDetails' => 'thanks_for_feedback_details',
      'followUpFeedbackPlaceholder' => 'follow_up_feedback_placeholder',
      'submit' => 'submit',
      'goBack' => 'go_back',
      'sendMessage' => 'send_message',
      'textMode' => 'text_mode',
      'voiceMode' => 'voice_mode',
      'switchedToTextMode' => 'switched_to_text_mode',
      'switchedToVoiceMode' => 'switched_to_voice_mode',
      'copy' => 'copy',
      'download' => 'download',
      'wrap' => 'wrap',
      'agentWorking' => 'agent_working',
      'agentDone' => 'agent_done',
      'agentError' => 'agent_error',
      'attachFile' => 'attach_file',
      'removeFile' => 'remove_file',
      'fileUploadError' => 'file_upload_error',
      'fileTypeUnsupported' => 'file_type_unsupported',
      'fileTooLarge' => 'file_too_large',
      'fileLimitReached' => 'file_limit_reached',
      'typingIndicator' => 'typing_indicator',
      'richContentUnavailable' => 'rich_content_unavailable'
    ]);

    $widgetStyles = new \ElevenLabs\Types\WidgetStyles([
      'base' => 'base',
      'baseHover' => 'base_hover',
      'baseActive' => 'base_active',
      'baseBorder' => 'base_border',
      'baseSubtle' => 'base_subtle',
      'basePrimary' => 'base_primary',
      'baseError' => 'base_error',
      'accent' => 'accent',
      'accentHover' => 'accent_hover',
      'accentActive' => 'accent_active',
      'accentBorder' => 'accent_border',
      'accentSubtle' => 'accent_subtle',
      'accentPrimary' => 'accent_primary',
      'overlayPadding' => 6.64,
      'buttonRadius' => 6.41,
      'inputRadius' => 6.32,
      'bubbleRadius' => 3.68,
      'sheetRadius' => 3.55,
      'compactSheetRadius' => 3.52,
      'dropdownSheetRadius' => 6.58
    ]);

    $widgetTextContentsTranslation = new \ElevenLabs\Types\WidgetTextContentsTranslation([
      'source' => [],
      'text' => []
    ]);

    $widgetTermsTranslation = new \ElevenLabs\Types\WidgetTermsTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $widgetLanguagePreset = new \ElevenLabs\Types\WidgetLanguagePreset([
      'textContents' => $widgetTextContents,
      'textContentsTranslation' => $widgetTextContentsTranslation,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'termsTranslation' => $widgetTermsTranslation
    ]);

    $widgetConfig = new \ElevenLabs\Types\WidgetConfig([
      'variant' => $embedVariant,
      'placement' => $widgetPlacement,
      'expandable' => $widgetExpandable,
      'avatar' => $widgetConfigAvatar,
      'feedbackMode' => $widgetFeedbackMode,
      'endFeedback' => $widgetEndFeedbackConfig,
      'bgColor' => '#ffffff',
      'textColor' => '#000000',
      'btnColor' => '#000000',
      'btnTextColor' => '#ffffff',
      'borderColor' => '#e1e1e1',
      'focusColor' => '#000000',
      'borderRadius' => 5,
      'btnRadius' => 8,
      'actionText' => 'action_text',
      'startCallText' => 'start_call_text',
      'endCallText' => 'end_call_text',
      'expandText' => 'expand_text',
      'listeningText' => 'listening_text',
      'speakingText' => 'speaking_text',
      'shareablePageText' => 'shareable_page_text',
      'shareablePageShowTerms' => true,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'showAvatarWhenCollapsed' => true,
      'disableBanner' => true,
      'overrideLink' => 'override_link',
      'markdownLinkAllowedHosts' => [],
      'markdownLinkIncludeWww' => true,
      'markdownLinkAllowHttp' => true,
      'micMutingEnabled' => true,
      'transcriptEnabled' => true,
      'textInputEnabled' => true,
      'conversationModeToggleEnabled' => true,
      'defaultExpanded' => false,
      'alwaysExpanded' => true,
      'dismissible' => false,
      'showAgentStatus' => false,
      'showConversationId' => true,
      'stripAudioTags' => true,
      'syntaxHighlightTheme' => $widgetConfigSyntaxHighlightTheme,
      'textContents' => $widgetTextContents,
      'styles' => $widgetStyles,
      'showResizeButton' => true,
      'endConfirmationEnabled' => false,
      'mobileFullscreen' => true,
      'transcriptSpeechSyncEnabled' => true,
      'languageSelector' => false,
      'supportsTextOnly' => true,
      'customAvatarPath' => 'custom_avatar_path',
      'languagePresets' => []
    ]);

    $analysisPropertyType = \ElevenLabs\Types\AnalysisPropertyType::Boolean->value;

    $analysisPropertyConstantValue = []; // TODO: populate with required fields

    $analysisProperty = new \ElevenLabs\Types\AnalysisProperty([
      'type' => $analysisPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => true,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $analysisPropertyConstantValue,
      'isOmitted' => false,
      'name' => 'name',
      'llm' => $llm
    ]);

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $attachedUserEvaluationRefSource =
      \ElevenLabs\Types\AttachedUserEvaluationRefSource::User->value;

    $attachedUserEvaluationRef = new \ElevenLabs\Types\AttachedUserEvaluationRef([
      'source' => $attachedUserEvaluationRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'additionalVersionIds' => [],
      'scope' => $analysisScope,
      'weight' => 7.08
    ]);
    $agentAnalysisItemsInputEvaluationCriteriaItem = \ElevenLabs\Types\AgentAnalysisItemsInputEvaluationCriteriaItem::user(
      $attachedUserEvaluationRef
    );

    $attachedUserDataCollectionRefSource =
      \ElevenLabs\Types\AttachedUserDataCollectionRefSource::User->value;

    $attachedUserDataCollectionRef = new \ElevenLabs\Types\AttachedUserDataCollectionRef([
      'source' => $attachedUserDataCollectionRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'scope' => $analysisScope
    ]);
    $agentAnalysisItemsInputDataCollectionItem = \ElevenLabs\Types\AgentAnalysisItemsInputDataCollectionItem::user(
      $attachedUserDataCollectionRef
    );

    $agentAnalysisItemsInput = new \ElevenLabs\Types\AgentAnalysisItemsInput([
      'evaluationCriteria' => [],
      'dataCollection' => []
    ]);

    $asrConversationalConfigOverrideConfig = new \ElevenLabs\Types\AsrConversationalConfigOverrideConfig(
      [
        'keywords' => false
      ]
    );

    $softTimeoutConfigOverrideConfig = new \ElevenLabs\Types\SoftTimeoutConfigOverrideConfig([
      'message' => false,
      'additionalSoftTimeoutMessages' => false
    ]);

    $turnConfigOverrideConfig = new \ElevenLabs\Types\TurnConfigOverrideConfig([
      'softTimeoutConfig' => $softTimeoutConfigOverrideConfig,
      'noisyEnvironmentMessage' => false
    ]);

    $ttsConversationalConfigOverrideConfig = new \ElevenLabs\Types\TtsConversationalConfigOverrideConfig(
      [
        'modelId' => false,
        'voiceId' => false,
        'supportedVoices' => false,
        'stability' => false,
        'speed' => false,
        'similarityBoost' => true,
        'cloneStrength' => true,
        'pronunciationDictionaryLocators' => false
      ]
    );

    $conversationConfigOverrideConfig = new \ElevenLabs\Types\ConversationConfigOverrideConfig([
      'textOnly' => true,
      'maxDurationSeconds' => false
    ]);

    $promptAgentApiModelOverrideConfig = new \ElevenLabs\Types\PromptAgentApiModelOverrideConfig([
      'prompt' => true,
      'llm' => false,
      'reasoningEffort' => false,
      'toolIds' => true,
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => true,
      'knowledgeBase' => true
    ]);

    $agentConfigOverrideConfig = new \ElevenLabs\Types\AgentConfigOverrideConfig([
      'firstMessage' => true,
      'language' => true,
      'maxConversationDurationMessage' => true,
      'prompt' => $promptAgentApiModelOverrideConfig
    ]);

    $conversationConfigClientOverrideConfigInput = new \ElevenLabs\Types\ConversationConfigClientOverrideConfigInput(
      [
        'asr' => $asrConversationalConfigOverrideConfig,
        'turn' => $turnConfigOverrideConfig,
        'tts' => $ttsConversationalConfigOverrideConfig,
        'conversation' => $conversationConfigOverrideConfig,
        'agent' => $agentConfigOverrideConfig
      ]
    );

    $conversationInitiationClientDataConfigInput = new \ElevenLabs\Types\ConversationInitiationClientDataConfigInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideConfigInput,
        'customLlmExtraBody' => true,
        'enableConversationInitiationClientDataFromWebhook' => false,
        'enableStartingWorkflowNodeIdFromClient' => true,
        'enableProcedureIdsFromClient' => false
      ]
    );

    $conversationInitiationClientDataWebhookRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $conversationInitiationClientDataWebhook = new \ElevenLabs\Types\ConversationInitiationClientDataWebhook(
      [
        'url' => 'url',
        'requestHeaders' => []
      ]
    );

    $webhookEventType = \ElevenLabs\Types\WebhookEventType::Transcript->value;

    $webhookTranscriptFormat = \ElevenLabs\Types\WebhookTranscriptFormat::Json->value;

    $convAiWebhooks = new \ElevenLabs\Types\ConvAiWebhooks([
      'postCallWebhookId' => 'post_call_webhook_id',
      'events' => [],
      'transcriptFormat' => $webhookTranscriptFormat,
      'excludeTranscript' => false,
      'sendAudio' => true
    ]);

    $agentWorkspaceOverridesInput = new \ElevenLabs\Types\AgentWorkspaceOverridesInput([
      'conversationInitiationClientDataWebhook' => $conversationInitiationClientDataWebhook,
      'webhooks' => $convAiWebhooks
    ]);

    $attachedTestModel = new \ElevenLabs\Types\AttachedTestModel([
      'testId' => 'test_id',
      'workflowNodeId' => 'workflow_node_id'
    ]);

    $agentTestingSettings = new \ElevenLabs\Types\AgentTestingSettings([
      'attachedTests' => []
    ]);

    $guardrailsV1InputVersion = \ElevenLabs\Types\GuardrailsV1InputVersion::One->value;

    $focusGuardrail = new \ElevenLabs\Types\FocusGuardrail([
      'isEnabled' => false
    ]);

    $promptInjectionGuardrail = new \ElevenLabs\Types\PromptInjectionGuardrail([
      'isEnabled' => false
    ]);

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $contentThresholdGuardrailThreshold = \ElevenLabs\Types\Threshold2::Low->value;

    $contentThresholdGuardrail = new \ElevenLabs\Types\ContentThresholdGuardrail([
      'isEnabled' => false,
      'threshold' => $contentThresholdGuardrailThreshold
    ]);

    $contentConfig = new \ElevenLabs\Types\ContentConfig([
      'sexual' => $contentThresholdGuardrail,
      'violence' => $contentThresholdGuardrail,
      'harassment' => $contentThresholdGuardrail,
      'selfHarm' => $contentThresholdGuardrail,
      'profanity' => $contentThresholdGuardrail,
      'religionOrPolitics' => $contentThresholdGuardrail,
      'medicalAndLegalInformation' => $contentThresholdGuardrail
    ]);

    $endCallTriggerActionType = \ElevenLabs\Types\EndCallTriggerActionType::EndCall->value;

    $endCallTriggerAction = new \ElevenLabs\Types\EndCallTriggerAction([
      'type' => $endCallTriggerActionType
    ]);
    $contentGuardrailInputTriggerAction = \ElevenLabs\Types\ContentGuardrailInputTriggerAction::endCall(
      $endCallTriggerAction
    );

    $contentGuardrailInput = new \ElevenLabs\Types\ContentGuardrailInput([
      'executionMode' => $guardrailExecutionMode,
      'config' => $contentConfig,
      'triggerAction' => $contentGuardrailInputTriggerAction
    ]);

    $customGuardrailConfigModel =
      \ElevenLabs\Types\CustomGuardrailConfigModel::Gemini25FlashLite->value;

    $customGuardrailConfigTriggerAction = \ElevenLabs\Types\CustomGuardrailConfigTriggerAction::endCall(
      $endCallTriggerAction
    );

    $customGuardrailConfig = new \ElevenLabs\Types\CustomGuardrailConfig([
      'isEnabled' => true,
      'name' => 'name',
      'prompt' => 'prompt',
      'executionMode' => $guardrailExecutionMode,
      'model' => $customGuardrailConfigModel,
      'serviceTier' => $llmServiceTier,
      'historyMessageCount' => 33,
      'triggerAction' => $customGuardrailConfigTriggerAction,
      'evaluateFullResponseOnly' => false
    ]);

    $customGuardrailsConfigInput = new \ElevenLabs\Types\CustomGuardrailsConfigInput([
      'configs' => []
    ]);

    $customGuardrailInput = new \ElevenLabs\Types\CustomGuardrailInput([
      'config' => $customGuardrailsConfigInput
    ]);

    $guardrailsV1Input = new \ElevenLabs\Types\GuardrailsV1Input([
      'version' => $guardrailsV1InputVersion,
      'focus' => $focusGuardrail,
      'promptInjection' => $promptInjectionGuardrail,
      'content' => $contentGuardrailInput,
      'custom' => $customGuardrailInput
    ]);

    $authSettings = new \ElevenLabs\Types\AuthSettings([
      'enableAuth' => true,
      'allowlist' => [],
      'requireOriginHeader' => true,
      'shareableToken' => 'shareable_token'
    ]);

    $agentCallLimits = new \ElevenLabs\Types\AgentCallLimits([
      'agentConcurrencyLimit' => -1,
      'dailyLimit' => 100000,
      'burstingEnabled' => true
    ]);

    $agentHoldAudioConfig = new \ElevenLabs\Types\AgentHoldAudioConfig([
      'audioPath' => 'audio_path',
      'audioUrl' => 'audio_url',
      'originalFilename' => 'original_filename',
      'durationSecs' => 4.56,
      'sizeBytes' => 7
    ]);

    $agentQueueingConfig = new \ElevenLabs\Types\AgentQueueingConfig([
      'enabled' => false,
      'waitTimeoutSeconds' => 180,
      'holdAudio' => $agentHoldAudioConfig
    ]);

    $configEntityType = \ElevenLabs\Types\ConfigEntityType::Name->value;

    $conversationHistoryRedactionConfig = new \ElevenLabs\Types\ConversationHistoryRedactionConfig([
      'enabled' => false,
      'entities' => [],
      'excludedDataCollectionIds' => []
    ]);

    $privacyConfigInput = new \ElevenLabs\Types\PrivacyConfigInput([
      'recordVoice' => true,
      'retentionDays' => -1,
      'deleteTranscriptAndPii' => true,
      'deleteAudio' => false,
      'applyToExistingConversations' => true,
      'zeroRetentionMode' => true,
      'conversationHistoryRedaction' => $conversationHistoryRedactionConfig
    ]);

    $agentTrustContext = \ElevenLabs\Types\AgentTrustContext::Unknown->value;

    $topicDiscoverySettings = new \ElevenLabs\Types\TopicDiscoverySettings();

    $sentimentAnalysisSettings = new \ElevenLabs\Types\SentimentAnalysisSettings();

    $alertingMonitorConfig = new \ElevenLabs\Types\AlertingMonitorConfig([
      'enabled' => false,
      'threshold' => 0.24,
      'relativeIncreaseThreshold' => 9.18,
      'minFailureCount' => 1,
      'minHistoryBucketCount' => 7,
      'minSampleCount' => 2,
      'suspectTriggerThreshold' => 8,
      'autoResolveAfterInactiveMinutes' => 10
    ]);

    $alertingWebhookNotifierType = \ElevenLabs\Types\AlertingWebhookNotifierType::Webhook->value;

    $alertingWebhookNotifier = new \ElevenLabs\Types\AlertingWebhookNotifier([
      'type' => $alertingWebhookNotifierType,
      'webhookId' => 'webhook_id'
    ]);
    $alertingSettingsNotifiersItem = \ElevenLabs\Types\AlertingSettingsNotifiersItem::webhook(
      $alertingWebhookNotifier
    );

    $alertingSettings = new \ElevenLabs\Types\AlertingSettings([
      'monitorConfigs' => [],
      'autoResolveAfterInactiveMinutes' => 10,
      'environments' => ['environments'],
      'notifiers' => []
    ]);

    $agentPlatformSettingsRequestModel = new \ElevenLabs\Types\AgentPlatformSettingsRequestModel([
      'evaluation' => $evaluationSettingsInput,
      'widget' => $widgetConfig,
      'dataCollection' => [],
      'dataCollectionScopes' => [],
      'analysisItems' => $agentAnalysisItemsInput,
      'overrides' => $conversationInitiationClientDataConfigInput,
      'workspaceOverrides' => $agentWorkspaceOverridesInput,
      'testing' => $agentTestingSettings,
      'archived' => false,
      'guardrails' => $guardrailsV1Input,
      'summaryLanguage' => 'summary_language',
      'autoTranslateTranscriptToAppLanguage' => false,
      'auth' => $authSettings,
      'callLimits' => $agentCallLimits,
      'queueingConfig' => $agentQueueingConfig,
      'privacy' => $privacyConfigInput,
      'trustContext' => $agentTrustContext,
      'analysisLlm' => $llm,
      'topicDiscovery' => $topicDiscoverySettings,
      'sentimentAnalysis' => $sentimentAnalysisSettings,
      'alerting' => $alertingSettings
    ]);

    $workflowUnconditionalModelInputType =
      \ElevenLabs\Types\WorkflowUnconditionalModelInputType::Unconditional->value;

    $workflowUnconditionalModelInput = new \ElevenLabs\Types\WorkflowUnconditionalModelInput([
      'label' => 'label',
      'type' => $workflowUnconditionalModelInputType
    ]);
    $workflowEdgeModelInputForwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $workflowEdgeModelInputBackwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $positionInput = new \ElevenLabs\Types\PositionInput([
      'x' => 0.13,
      'y' => 8.06
    ]);

    $workflowEdgeModelInput = new \ElevenLabs\Types\WorkflowEdgeModelInput([
      'source' => 'source',
      'target' => 'target',
      'forwardCondition' => $workflowEdgeModelInputForwardCondition,
      'backwardCondition' => $workflowEdgeModelInputBackwardCondition,
      'reroutes' => []
    ]);

    $workflowStartNodeModelInputType =
      \ElevenLabs\Types\WorkflowStartNodeModelInputType::Start->value;

    $workflowStartNodeModelInput = new \ElevenLabs\Types\WorkflowStartNodeModelInput([
      'type' => $workflowStartNodeModelInputType,
      'position' => $positionInput,
      'edgeOrder' => []
    ]);
    $agentWorkflowRequestModelNodesValue = \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::start(
      $workflowStartNodeModelInput
    );

    $agentWorkflowRequestModel = new \ElevenLabs\Types\AgentWorkflowRequestModel([
      'edges' => [],
      'nodes' => [],
      'preventSubagentLoops' => false
    ]);

    $procedureVersionRef = new \ElevenLabs\Types\ProcedureVersionRef([
      'procedureId' => 'procedure_id',
      'versionId' => 'version_id'
    ]);

    $request = new \ElevenLabs\Agents\Requests\UpdateAgentRequest([
      'enableVersioningIfNotEnabled' => true,
      'branchId' => 'branch_id',
      'includeProcedureGeneratedWorkflowElements' => true,
      'conversationConfig' => $conversationalConfig,
      'platformSettings' => $agentPlatformSettingsRequestModel,
      'workflow' => $agentWorkflowRequestModel,
      'name' => 'name',
      'tags' => [],
      'versionDescription' => 'version_description',
      'procedures' => []
    ]);
    $sdk->agents->update(request: $request, agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('PATCH', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testDeleteSendsWireRequest(): void
  {
    $transport = $this->transport(200, '');
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->delete(
      request: new \ElevenLabs\Agents\Requests\DeleteAgentsRequest([
        'force' => false
      ]),
      agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testListSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agents": [
              {
                  "agent_id": "test-value",
                  "name": "test-value",
                  "voice_id": "test-value",
                  "tags": [
                      "test-value"
                  ],
                  "created_at_unix_secs": 1,
                  "updated_at_unix_secs": 1,
                  "access_info": {
                      "is_creator": true,
                      "creator_name": "test-value",
                      "creator_email": "test-value",
                      "role": "admin",
                      "anonymous_access_level_override": "admin",
                      "access_source": "creator"
                  },
                  "last_call_time_unix_secs": 1,
                  "archived": true
              }
          ],
          "next_cursor": "test-value",
          "has_more": true
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sortDirection = \ElevenLabs\Types\SortDirection::Asc;
    $sortBy = \ElevenLabs\Types\AgentSortBy::Name;
    $sdk->agents->list(
      request: new \ElevenLabs\Agents\Requests\ListAgentsRequest([
        'pageSize' => 30,
        'search' => 'search',
        'archived' => true,
        'showOnlyOwnedAgents' => false,
        'createdByUserId' => 'created_by_user_id',
        'tags' => [],
        'sortDirection' => $sortDirection->value,
        'sortBy' => $sortBy->value,
        'cursor' => 'cursor'
      ])
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDuplicateSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "agent_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $request = new \ElevenLabs\Agents\Requests\BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost(
      [
        'name' => 'name'
      ]
    );
    $sdk->agents->duplicate(request: $request, agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/duplicate$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRunTestsSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "name": "test-value",
          "agent_id": "test-value",
          "branch_id": "test-value",
          "version_id": "test-value",
          "ran_against_draft": true,
          "created_at": 1,
          "folder_id": "test-value",
          "repeat_count": 1,
          "cancelled": true,
          "bucketing_status": "pending",
          "result_groups": [
              {
                  "test_id": "test-value",
                  "test_name": "test-value",
                  "workflow_node_id": "test-value",
                  "buckets": [
                      {
                          "test_run_ids": [
                              "test-value"
                          ],
                          "title": "test-value",
                          "reason": "test-value",
                          "status": "pending"
                      }
                  ]
              }
          ],
          "test_runs": [
              {
                  "test_run_id": "test-value",
                  "test_info": {
                      "from_conversation_metadata": {
                          "conversation_id": "test-value",
                          "agent_id": "test-value",
                          "branch_id": "test-value",
                          "workflow_node_id": "test-value",
                          "original_agent_reply": [
                              {
                                  "role": "user",
                                  "agent_metadata": {
                                      "agent_id": "test-value",
                                      "branch_id": "test-value",
                                      "workflow_node_id": "test-value",
                                      "version_id": "test-value"
                                  },
                                  "message": "test-value",
                                  "multivoice_message": {
                                      "parts": [
                                          {
                                              "text": "test-value",
                                              "voice_label": "test-value",
                                              "time_in_call_secs": 1
                                          }
                                      ]
                                  },
                                  "tool_calls": [
                                      {
                                          "type": "system",
                                          "request_id": "test-value",
                                          "tool_name": "test-value",
                                          "tool_id": "test-value",
                                          "params_as_json": "test-value",
                                          "tool_has_been_called": true,
                                          "tool_details": {
                                              "type": "webhook",
                                              "method": "test-value",
                                              "url": "test-value",
                                              "headers": {
                                                  "key": "test-value"
                                              },
                                              "path_params": {
                                                  "key": "test-value"
                                              },
                                              "query_params": {
                                                  "key": "test-value"
                                              },
                                              "body": "test-value"
                                          }
                                      }
                                  ],
                                  "tool_results": [
                                      {
                                          "request_id": "test-value",
                                          "tool_name": "test-value",
                                          "tool_id": "test-value",
                                          "result_value": "test-value",
                                          "is_error": true,
                                          "is_blocked": true,
                                          "tool_has_been_called": true,
                                          "tool_latency_secs": 1,
                                          "error_type": "test-value",
                                          "raw_error_message": "test-value",
                                          "dynamic_variable_updates": [
                                              {
                                                  "variable_name": "test-value",
                                                  "old_value": "test-value",
                                                  "new_value": "test-value",
                                                  "updated_at": 1,
                                                  "tool_name": "test-value",
                                                  "tool_request_id": "test-value"
                                              }
                                          ],
                                          "type": "client"
                                      }
                                  ],
                                  "feedback": {
                                      "score": "like",
                                      "time_in_call_secs": 1
                                  },
                                  "llm_override": "test-value",
                                  "producing_llm": "test-value",
                                  "time_in_call_secs": 1,
                                  "conversation_turn_metrics": {
                                      "metrics": {
                                          "key": {
                                              "elapsed_time": 1
                                          }
                                      },
                                      "convai_asr_provider": "test-value",
                                      "convai_tts_model": "test-value",
                                      "convai_tts_cascade": "test-value",
                                      "voice_id": "test-value"
                                  },
                                  "rag_retrieval_info": {
                                      "chunks": [
                                          {
                                              "document_id": "test-value",
                                              "chunk_id": "test-value",
                                              "vector_distance": 1
                                          }
                                      ],
                                      "embedding_model": "e5_mistral_7b_instruct",
                                      "retrieval_query": "test-value",
                                      "rag_latency_secs": 1,
                                      "used_chunk_ids": [
                                          "test-value"
                                      ]
                                  },
                                  "llm_usage": {
                                      "model_usage": {
                                          "key": {
                                              "input": {
                                                  "tokens": 1,
                                                  "price": 1
                                              },
                                              "input_cache_read": {
                                                  "tokens": 1,
                                                  "price": 1
                                              },
                                              "input_cache_write": {
                                                  "tokens": 1,
                                                  "price": 1
                                              },
                                              "output_total": {
                                                  "tokens": 1,
                                                  "price": 1
                                              }
                                          }
                                      }
                                  },
                                  "interrupted": true,
                                  "ignored_as_backchannel": true,
                                  "platform_event": "user_turn_timeout",
                                  "original_message": "test-value",
                                  "reasoning": [
                                      {
                                          "summary": "test-value",
                                          "provider_redact": true
                                      }
                                  ],
                                  "source_medium": "audio",
                                  "source_event_id": 1,
                                  "used_static_kb_document_ids": [
                                      "test-value"
                                  ],
                                  "user_identifier": "test-value",
                                  "id": "test-value",
                                  "created_at_unix_ms": 1,
                                  "triggered_guardrails": [
                                      {
                                          "guardrail_type": "custom",
                                          "guardrail_name": "test-value",
                                          "execution_mode": "streaming",
                                          "guardrail_details": {
                                              "type": "llm",
                                              "rationale": "test-value"
                                          }
                                      }
                                  ]
                              }
                          ]
                      },
                      "dynamic_variables": {
                          "key": "test-value"
                      },
                      "chat_history": [
                          {
                              "role": "user",
                              "agent_metadata": {
                                  "agent_id": "test-value",
                                  "branch_id": "test-value",
                                  "workflow_node_id": "test-value",
                                  "version_id": "test-value"
                              },
                              "message": "test-value",
                              "multivoice_message": {
                                  "parts": [
                                      {
                                          "text": "test-value",
                                          "voice_label": "test-value",
                                          "time_in_call_secs": 1
                                      }
                                  ]
                              },
                              "tool_calls": [
                                  {
                                      "type": "system",
                                      "request_id": "test-value",
                                      "tool_name": "test-value",
                                      "tool_id": "test-value",
                                      "params_as_json": "test-value",
                                      "tool_has_been_called": true,
                                      "tool_details": {
                                          "type": "webhook",
                                          "method": "test-value",
                                          "url": "test-value",
                                          "headers": {
                                              "key": "test-value"
                                          },
                                          "path_params": {
                                              "key": "test-value"
                                          },
                                          "query_params": {
                                              "key": "test-value"
                                          },
                                          "body": "test-value"
                                      }
                                  }
                              ],
                              "tool_results": [
                                  {
                                      "request_id": "test-value",
                                      "tool_name": "test-value",
                                      "tool_id": "test-value",
                                      "result_value": "test-value",
                                      "is_error": true,
                                      "is_blocked": true,
                                      "tool_has_been_called": true,
                                      "tool_latency_secs": 1,
                                      "error_type": "test-value",
                                      "raw_error_message": "test-value",
                                      "dynamic_variable_updates": [
                                          {
                                              "variable_name": "test-value",
                                              "old_value": "test-value",
                                              "new_value": "test-value",
                                              "updated_at": 1,
                                              "tool_name": "test-value",
                                              "tool_request_id": "test-value"
                                          }
                                      ],
                                      "type": "client"
                                  }
                              ],
                              "feedback": {
                                  "score": "like",
                                  "time_in_call_secs": 1
                              },
                              "llm_override": "test-value",
                              "producing_llm": "test-value",
                              "time_in_call_secs": 1,
                              "conversation_turn_metrics": {
                                  "metrics": {
                                      "key": {
                                          "elapsed_time": 1
                                      }
                                  },
                                  "convai_asr_provider": "test-value",
                                  "convai_tts_model": "test-value",
                                  "convai_tts_cascade": "test-value",
                                  "voice_id": "test-value"
                              },
                              "rag_retrieval_info": {
                                  "chunks": [
                                      {
                                          "document_id": "test-value",
                                          "chunk_id": "test-value",
                                          "vector_distance": 1
                                      }
                                  ],
                                  "embedding_model": "e5_mistral_7b_instruct",
                                  "retrieval_query": "test-value",
                                  "rag_latency_secs": 1,
                                  "used_chunk_ids": [
                                      "test-value"
                                  ]
                              },
                              "llm_usage": {
                                  "model_usage": {
                                      "key": {
                                          "input": {
                                              "tokens": 1,
                                              "price": 1
                                          },
                                          "input_cache_read": {
                                              "tokens": 1,
                                              "price": 1
                                          },
                                          "input_cache_write": {
                                              "tokens": 1,
                                              "price": 1
                                          },
                                          "output_total": {
                                              "tokens": 1,
                                              "price": 1
                                          }
                                      }
                                  }
                              },
                              "interrupted": true,
                              "ignored_as_backchannel": true,
                              "platform_event": "user_turn_timeout",
                              "original_message": "test-value",
                              "reasoning": [
                                  {
                                      "summary": "test-value",
                                      "provider_redact": true
                                  }
                              ],
                              "source_medium": "audio",
                              "source_event_id": 1,
                              "used_static_kb_document_ids": [
                                  "test-value"
                              ],
                              "user_identifier": "test-value",
                              "id": "test-value",
                              "created_at_unix_ms": 1,
                              "triggered_guardrails": [
                                  {
                                      "guardrail_type": "custom",
                                      "guardrail_name": "test-value",
                                      "execution_mode": "streaming",
                                      "guardrail_details": {
                                          "type": "llm",
                                          "rationale": "test-value"
                                      }
                                  }
                              ]
                          }
                      ],
                      "conversation_initiation_source": "unknown",
                      "environment": "test-value",
                      "type": "llm",
                      "success_condition": "test-value",
                      "success_examples": [
                          {
                              "response": "test-value",
                              "type": "success"
                          }
                      ],
                      "failure_examples": [
                          {
                              "response": "test-value",
                              "type": "failure"
                          }
                      ]
                  },
                  "test_invocation_id": "test-value",
                  "agent_id": "test-value",
                  "branch_id": "test-value",
                  "version_id": "test-value",
                  "ran_against_draft": true,
                  "workflow_node_id": "test-value",
                  "status": "pending",
                  "agent_responses": [
                      {
                          "role": "user",
                          "agent_metadata": {
                              "agent_id": "test-value",
                              "branch_id": "test-value",
                              "workflow_node_id": "test-value",
                              "version_id": "test-value"
                          },
                          "message": "test-value",
                          "multivoice_message": {
                              "parts": [
                                  {
                                      "text": "test-value",
                                      "voice_label": "test-value",
                                      "time_in_call_secs": 1
                                  }
                              ]
                          },
                          "tool_calls": [
                              {
                                  "type": "system",
                                  "request_id": "test-value",
                                  "tool_name": "test-value",
                                  "tool_id": "test-value",
                                  "params_as_json": "test-value",
                                  "tool_has_been_called": true,
                                  "tool_details": {
                                      "type": "webhook",
                                      "method": "test-value",
                                      "url": "test-value",
                                      "headers": {
                                          "key": "test-value"
                                      },
                                      "path_params": {
                                          "key": "test-value"
                                      },
                                      "query_params": {
                                          "key": "test-value"
                                      },
                                      "body": "test-value"
                                  }
                              }
                          ],
                          "tool_results": [
                              {
                                  "request_id": "test-value",
                                  "tool_name": "test-value",
                                  "tool_id": "test-value",
                                  "result_value": "test-value",
                                  "is_error": true,
                                  "is_blocked": true,
                                  "tool_has_been_called": true,
                                  "tool_latency_secs": 1,
                                  "error_type": "test-value",
                                  "raw_error_message": "test-value",
                                  "dynamic_variable_updates": [
                                      {
                                          "variable_name": "test-value",
                                          "old_value": "test-value",
                                          "new_value": "test-value",
                                          "updated_at": 1,
                                          "tool_name": "test-value",
                                          "tool_request_id": "test-value"
                                      }
                                  ],
                                  "type": "client"
                              }
                          ],
                          "feedback": {
                              "score": "like",
                              "time_in_call_secs": 1
                          },
                          "llm_override": "test-value",
                          "producing_llm": "test-value",
                          "time_in_call_secs": 1,
                          "conversation_turn_metrics": {
                              "metrics": {
                                  "key": {
                                      "elapsed_time": 1
                                  }
                              },
                              "convai_asr_provider": "test-value",
                              "convai_tts_model": "test-value",
                              "convai_tts_cascade": "test-value",
                              "voice_id": "test-value"
                          },
                          "rag_retrieval_info": {
                              "chunks": [
                                  {
                                      "document_id": "test-value",
                                      "chunk_id": "test-value",
                                      "vector_distance": 1
                                  }
                              ],
                              "embedding_model": "e5_mistral_7b_instruct",
                              "retrieval_query": "test-value",
                              "rag_latency_secs": 1,
                              "used_chunk_ids": [
                                  "test-value"
                              ]
                          },
                          "llm_usage": {
                              "model_usage": {
                                  "key": {
                                      "input": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_read": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_write": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "output_total": {
                                          "tokens": 1,
                                          "price": 1
                                      }
                                  }
                              }
                          },
                          "interrupted": true,
                          "ignored_as_backchannel": true,
                          "platform_event": "user_turn_timeout",
                          "original_message": "test-value",
                          "reasoning": [
                              {
                                  "summary": "test-value",
                                  "provider_redact": true
                              }
                          ],
                          "source_medium": "audio",
                          "source_event_id": 1,
                          "used_static_kb_document_ids": [
                              "test-value"
                          ],
                          "user_identifier": "test-value",
                          "id": "test-value",
                          "created_at_unix_ms": 1,
                          "triggered_guardrails": [
                              {
                                  "guardrail_type": "custom",
                                  "guardrail_name": "test-value",
                                  "execution_mode": "streaming",
                                  "guardrail_details": {
                                      "type": "llm",
                                      "rationale": "test-value"
                                  }
                              }
                          ]
                      }
                  ],
                  "triggered_guardrails": [
                      {
                          "guardrail_type": "custom",
                          "guardrail_name": "test-value",
                          "execution_mode": "streaming",
                          "guardrail_details": {
                              "type": "llm",
                              "rationale": "test-value"
                          }
                      }
                  ],
                  "test_id": "test-value",
                  "test_name": "test-value",
                  "condition_result": {
                      "result": "success",
                      "rationale": {
                          "messages": [
                              "test-value"
                          ],
                          "summary": "test-value"
                      }
                  },
                  "last_updated_at_unix": 1,
                  "metadata": {
                      "workspace_id": "test-value",
                      "test_name": "test-value",
                      "ran_by_user_email": "test-value",
                      "test_type": "llm"
                  },
                  "root_folder_id": "test-value",
                  "root_folder_name": "test-value",
                  "environment": "test-value",
                  "credits_used": 1,
                  "charging": {
                      "dev_discount": true,
                      "is_burst": true,
                      "tier": "test-value",
                      "llm_usage": {
                          "irreversible_generation": {
                              "model_usage": {
                                  "key": {
                                      "input": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_read": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_write": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "output_total": {
                                          "tokens": 1,
                                          "price": 1
                                      }
                                  }
                              }
                          },
                          "initiated_generation": {
                              "model_usage": {
                                  "key": {
                                      "input": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_read": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "input_cache_write": {
                                          "tokens": 1,
                                          "price": 1
                                      },
                                      "output_total": {
                                          "tokens": 1,
                                          "price": 1
                                      }
                                  }
                              }
                          }
                      },
                      "llm_price": 1,
                      "llm_charge": 1,
                      "call_charge": 1,
                      "platform_charge": 1,
                      "platform_usage": {
                          "category_usage": {
                              "key": {
                                  "credits": 1,
                                  "price": 1,
                                  "quantity": 1
                              }
                          }
                      },
                      "platform_price": 1,
                      "free_minutes_consumed": 1,
                      "free_llm_dollars_consumed": 1,
                      "tts_usage": {
                          "primary_tts_model": "test-value",
                          "total_audio_output_seconds": 1,
                          "total_characters": 1,
                          "per_voice_usage": [
                              {
                                  "voice_id": "test-value",
                                  "audio_output_seconds": 1
                              }
                          ]
                      },
                      "asr_usage": {
                          "asr_model": "test-value",
                          "total_transcription_calls": 1,
                          "total_audio_input_seconds": 1
                      },
                      "analysis": {
                          "total": {
                              "price": 1,
                              "charge": 1,
                              "runs": 1,
                              "price_per_feature": {
                                  "key": 1
                              },
                              "charge_per_feature": {
                                  "key": 1
                              }
                          },
                          "last_run": {
                              "price": 1,
                              "charge": 1,
                              "price_per_feature": {
                                  "key": 1
                              },
                              "charge_per_feature": {
                                  "key": 1
                              }
                          }
                      },
                      "voice_surcharge_charge": 1
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

    $singleTestRunRequestModel = new \ElevenLabs\Types\SingleTestRunRequestModel([
      'testId' => 'test_id',
      'workflowNodeId' => 'workflow_node_id',
      'rootFolderId' => 'root_folder_id',
      'rootFolderName' => 'root_folder_name'
    ]);

    $asrQuality = \ElevenLabs\Types\AsrQuality::High->value;

    $asrProvider = \ElevenLabs\Types\AsrProvider::Elevenlabs->value;

    $asrInputFormat = \ElevenLabs\Types\AsrInputFormat::Pcm8000->value;

    $asrConversationalConfig = new \ElevenLabs\Types\AsrConversationalConfig([
      'quality' => $asrQuality,
      'provider' => $asrProvider,
      'userInputAudioFormat' => $asrInputFormat,
      'keywords' => []
    ]);

    $turnEagerness = \ElevenLabs\Types\TurnEagerness::Patient->value;

    $spellingPatience = \ElevenLabs\Types\SpellingPatience::Auto->value;

    $turnModel = \ElevenLabs\Types\TurnModel::TurnV2->value;

    $softTimeoutConfig = new \ElevenLabs\Types\SoftTimeoutConfig([
      'timeoutSeconds' => -1,
      'message' => 'Hhmmmm...yeah.',
      'additionalSoftTimeoutMessages' => [],
      'useLlmGeneratedMessage' => true,
      'randomizeFillers' => false,
      'maxSoftTimeoutsPerGeneration' => 1,
      'llmGeneratedMessagePromptOverride' => 'llm_generated_message_prompt_override',
      'disableUntilFirstUserMessage' => false
    ]);

    $turnConfig = new \ElevenLabs\Types\TurnConfig([
      'turnTimeout' => 7,
      'initialWaitTime' => 0.63,
      'silenceEndCallTimeout' => -1,
      'turnEagerness' => $turnEagerness,
      'spellingPatience' => $spellingPatience,
      'speculativeTurn' => false,
      'retranscribeOnTurnTimeout' => true,
      'turnModel' => $turnModel,
      'interruptionIgnoreTerms' => [],
      'interruptionIgnoreTermLanguages' => [],
      'mergeWithDefaultIgnoreTerms' => false,
      'transcribeOnDisabledInterruptions' => true,
      'softTimeoutConfig' => $softTimeoutConfig,
      'noisyEnvironmentDetection' => true,
      'noisyEnvironmentMessage' =>
        "Uhh ... sorry, I\'m picking up some noise in the background. Could you move somewhere quieter?"
    ]);

    $ttsConversationalModel = \ElevenLabs\Types\TtsConversationalModel::ElevenTurboV2->value;

    $ttsModelFamily = \ElevenLabs\Types\TtsModelFamily::Turbo->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $supportedVoice = new \ElevenLabs\Types\SupportedVoice([
      'label' => 'label',
      'voiceId' => 'voice_id',
      'description' => 'description',
      'language' => 'language',
      'modelFamily' => $ttsModelFamily,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.42,
      'speed' => 0.78,
      'similarityBoost' => 0.33,
      'cloneStrength' => 0.41
    ]);

    $suggestedAudioTag = new \ElevenLabs\Types\SuggestedAudioTag([
      'tag' => 'tag',
      'description' => 'description'
    ]);

    $ttsOutputFormat = \ElevenLabs\Types\TtsOutputFormat::Pcm8000->value;

    $ttsOptimizeStreamingLatency = \ElevenLabs\Types\TtsOptimizeStreamingLatency::Zero->value;

    $textNormalisationType = \ElevenLabs\Types\TextNormalisationType::SystemPrompt->value;

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $effectsSpecOutput = new \ElevenLabs\Types\EffectsSpecOutput([
      'filterPresetId' => 'filter_preset_id',
      'distance' => 0.38,
      'environmentId' => 'environment_id',
      'backgroundNoiseId' => 'background_noise_id',
      'sendLevel' => 1,
      'pan' => -0.59
    ]);

    $ttsConversationalConfigOutput = new \ElevenLabs\Types\TtsConversationalConfigOutput([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'cjVigY5qzO86Huf0OWal',
      'supportedVoices' => [],
      'expressiveMode' => true,
      'suggestedAudioTags' => [],
      'agentOutputAudioFormat' => $ttsOutputFormat,
      'optimizeStreamingLatency' => $ttsOptimizeStreamingLatency,
      'stability' => 0.5,
      'speed' => 1,
      'similarityBoost' => 0.8,
      'cloneStrength' => 0.91,
      'textNormalisationType' => $textNormalisationType,
      'pronunciationDictionaryLocators' => [],
      'enablePhonemeTags' => true,
      'audioEffects' => $effectsSpecOutput
    ]);

    $clientEvent = \ElevenLabs\Types\ClientEvent::ConversationInitiationMetadata->value;

    $fileInputConfig = new \ElevenLabs\Types\FileInputConfig([
      'enabled' => true,
      'maxFilesInMemory' => 10,
      'maxFilesPerConversation' => 10
    ]);

    $dtmfInputConfig = new \ElevenLabs\Types\DtmfInputConfig([
      'dtmfInputTimeout' => 2,
      'hashTerminator' => true,
      'redactInput' => false
    ]);

    $backgroundSoundSourceType = \ElevenLabs\Types\BackgroundSoundSourceType::Preset->value;

    $backgroundSoundPresetId = \ElevenLabs\Types\BackgroundSoundPresetId::Office2->value;

    $backgroundSoundConfig = new \ElevenLabs\Types\BackgroundSoundConfig([
      'sourceType' => $backgroundSoundSourceType,
      'sourceId' => $backgroundSoundPresetId,
      'volume' => 0.15,
      'crossfadeLoop' => true
    ]);

    $conversationConfigOutput = new \ElevenLabs\Types\ConversationConfigOutput([
      'textOnly' => false,
      'maxDurationSeconds' => 600,
      'clientEvents' => [],
      'fileInput' => $fileInputConfig,
      'monitoringEnabled' => true,
      'monitoringEvents' => [],
      'dtmfInputSettings' => $dtmfInputConfig,
      'backgroundSound' => $backgroundSoundConfig,
      'sourceAttribution' => false
    ]);

    $asrConversationalConfigOverride = new \ElevenLabs\Types\AsrConversationalConfigOverride([
      'keywords' => []
    ]);

    $softTimeoutConfigOverride = new \ElevenLabs\Types\SoftTimeoutConfigOverride([
      'message' => 'message',
      'additionalSoftTimeoutMessages' => []
    ]);

    $turnConfigOverride = new \ElevenLabs\Types\TurnConfigOverride([
      'softTimeoutConfig' => $softTimeoutConfigOverride,
      'noisyEnvironmentMessage' => 'noisy_environment_message'
    ]);

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 6.57,
      'speed' => 1.8,
      'similarityBoost' => 6.48,
      'cloneStrength' => 1.49,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => false,
      'maxDurationSeconds' => 5
    ]);

    $llm = \ElevenLabs\Types\Llm::Gpt4OMini->value;

    $llmReasoningEffort = \ElevenLabs\Types\LlmReasoningEffort::None->value;

    $knowledgeBaseDocumentType = \ElevenLabs\Types\KnowledgeBaseDocumentType::File->value;

    $documentUsageModeEnum = \ElevenLabs\Types\DocumentUsageModeEnum::Prompt->value;

    $knowledgeBaseLocator = new \ElevenLabs\Types\KnowledgeBaseLocator([
      'type' => $knowledgeBaseDocumentType,
      'name' => 'name',
      'id' => 'id',
      'usageMode' => $documentUsageModeEnum
    ]);

    $promptAgentApiModelOverrideOutput = new \ElevenLabs\Types\PromptAgentApiModelOverrideOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideOutput = new \ElevenLabs\Types\AgentConfigOverrideOutput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideOutput
    ]);

    $conversationConfigClientOverrideOutput = new \ElevenLabs\Types\ConversationConfigClientOverrideOutput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideOutput
      ]
    );

    $languagePresetTranslation = new \ElevenLabs\Types\LanguagePresetTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $languagePresetOutput = new \ElevenLabs\Types\LanguagePresetOutput([
      'overrides' => $conversationConfigClientOverrideOutput,
      'firstMessageTranslation' => $languagePresetTranslation,
      'softTimeoutTranslation' => $languagePresetTranslation,
      'noisyEnvironmentMessageTranslation' => $languagePresetTranslation
    ]);

    $vadConfig = new \ElevenLabs\Types\VadConfig();

    $verbosity = \ElevenLabs\Types\Verbosity::Auto->value;

    $outputFormat = \ElevenLabs\Types\OutputFormat::Mp32205032->value;

    $interactionBudget = \ElevenLabs\Types\InteractionBudget::Realtime->value;

    $behaviorOverride = new \ElevenLabs\Types\BehaviorOverride([
      'verbosity' => $verbosity,
      'outputFormat' => $outputFormat,
      'interactionBudget' => $interactionBudget
    ]);

    $subAgentOutputExecutionMode = \ElevenLabs\Types\SubAgentOutputExecutionMode::Immediate->value;

    $objectJsonSchemaPropertyOutputType =
      \ElevenLabs\Types\ObjectJsonSchemaPropertyOutputType::Object->value;

    $literalJsonSchemaPropertyType = \ElevenLabs\Types\Type11::Boolean->value;

    $allowedValues = new \ElevenLabs\Types\AllowedValues([
      'dynamicVariable' => 'dynamic_variable'
    ]);

    $literalJsonSchemaPropertyConstantValue = []; // TODO: populate with required fields

    $objectJsonSchemaPropertyOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty(
      [
        'type' => $literalJsonSchemaPropertyType,
        'description' => 'description',
        'enum' => [],
        'isSystemProvided' => false,
        'dynamicVariable' => 'dynamic_variable',
        'allowedValues' => $allowedValues,
        'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
        'constantValue' => $literalJsonSchemaPropertyConstantValue,
        'isOmitted' => false
      ]
    );

    $requiredConstraint = new \ElevenLabs\Types\RequiredConstraint([
      'required' => []
    ]);

    $requiredConstraints = new \ElevenLabs\Types\RequiredConstraints([
      'anyOf' => [],
      'allOf' => []
    ]);

    $objectJsonSchemaPropertyOutput = new \ElevenLabs\Types\ObjectJsonSchemaPropertyOutput([
      'description' => 'description',
      'dynamicVariable' => 'dynamic_variable',
      'constantValue' => [],
      'isOmitted' => false,
      'type' => $objectJsonSchemaPropertyOutputType,
      'required' => [],
      'properties' => [],
      'requiredConstraints' => $requiredConstraints
    ]);

    $subAgentOutput = new \ElevenLabs\Types\SubAgentOutput([
      'executionMode' => $subAgentOutputExecutionMode,
      'timeoutSecs' => 60,
      'agentId' => 'agent_id',
      'branchId' => 'branch_id',
      'description' => 'description',
      'parameters' => $objectJsonSchemaPropertyOutput
    ]);

    $selfSubagentExecutionMode = \ElevenLabs\Types\SelfSubagentExecutionMode::Immediate->value;

    $selfSubagent = new \ElevenLabs\Types\SelfSubagent([
      'executionMode' => $selfSubagentExecutionMode,
      'timeoutSecs' => 60,
      'description' => 'description'
    ]);

    $subagentConfigOutput = new \ElevenLabs\Types\SubagentConfigOutput([
      'agents' => [],
      'selfSubagent' => $selfSubagent
    ]);

    $llmServiceTier = \ElevenLabs\Types\LlmServiceTier::Standard->value;

    $systemToolConfigOutputType = \ElevenLabs\Types\SystemToolConfigOutputType::System->value;

    $toolInterruptionMode = \ElevenLabs\Types\ToolInterruptionMode::Allow->value;

    $preToolSpeechMode = \ElevenLabs\Types\PreToolSpeechMode::Auto->value;

    $dynamicVariableAssignmentSource =
      \ElevenLabs\Types\DynamicVariableAssignmentSource::Response->value;

    $dynamicVariableAssignment = new \ElevenLabs\Types\DynamicVariableAssignment([
      'source' => $dynamicVariableAssignmentSource,
      'dynamicVariable' => 'dynamic_variable',
      'valuePath' => 'value_path',
      'sanitize' => false,
      'preserveNativeType' => false
    ]);

    $toolCallSoundType = \ElevenLabs\Types\ToolCallSoundType::Typing->value;

    $toolCallSoundBehavior = \ElevenLabs\Types\ToolCallSoundBehavior::Auto->value;

    $toolErrorHandlingMode = \ElevenLabs\Types\ToolErrorHandlingMode::Auto->value;

    $endCallToolConfigSystemToolType =
      \ElevenLabs\Types\EndCallToolConfigSystemToolType::EndCall->value;

    $endCallToolConfig = new \ElevenLabs\Types\EndCallToolConfig([
      'systemToolType' => $endCallToolConfigSystemToolType
    ]);
    $systemToolConfigOutputParams = \ElevenLabs\Types\SystemToolConfigOutputParams::endCall(
      $endCallToolConfig
    );

    $systemToolConfigOutput = new \ElevenLabs\Types\SystemToolConfigOutput([
      'type' => $systemToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'params' => $systemToolConfigOutputParams
    ]);

    $builtInToolsOutput = new \ElevenLabs\Types\BuiltInToolsOutput([
      'transferToAgent' => $systemToolConfigOutput,
      'endCall' => $systemToolConfigOutput,
      'languageDetection' => $systemToolConfigOutput,
      'transferToNumber' => $systemToolConfigOutput,
      'skipTurn' => $systemToolConfigOutput,
      'playKeypadTouchTone' => $systemToolConfigOutput,
      'voicemailDetection' => $systemToolConfigOutput
    ]);

    $customLlmApiKey = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $customLlmRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator([
      'secretId' => 'secret_id'
    ]);

    $customLlmapiType = \ElevenLabs\Types\CustomLlmapiType::ChatCompletions->value;

    $customLlm = new \ElevenLabs\Types\CustomLlm([
      'url' => 'url',
      'modelId' => 'model_id',
      'apiKey' => $customLlmApiKey,
      'authConnection' => $customLlmAuthConnection,
      'requestHeaders' => [],
      'apiVersion' => 'api_version',
      'apiType' => $customLlmapiType
    ]);

    $embeddingModelEnum = \ElevenLabs\Types\EmbeddingModelEnum::E5Mistral7BInstruct->value;

    $searchStrategy = \ElevenLabs\Types\SearchStrategy::Cat->value;

    $knowledgeBaseToolInfo = new \ElevenLabs\Types\KnowledgeBaseToolInfo([
      'enabledStrategies' => []
    ]);

    $ragConfigOutput = new \ElevenLabs\Types\RagConfigOutput([
      'enabled' => true,
      'embeddingModel' => $embeddingModelEnum,
      'maxVectorDistance' => 0.5,
      'maxDocumentsLength' => 50000,
      'maxRetrievedRagChunksCount' => 5,
      'numCandidates' => 8647,
      'queryRewritePromptOverride' => 'query_rewrite_prompt_override',
      'knowledgeBaseToolInfo' => $knowledgeBaseToolInfo
    ]);

    $backupLlmDefaultPreference = \ElevenLabs\Types\BackupLlmDefaultPreference::Default_->value;

    $backupLlmDefault = new \ElevenLabs\Types\BackupLlmDefault([
      'preference' => $backupLlmDefaultPreference
    ]);
    $promptAgentApiModelOutputBackupLlmConfig = \ElevenLabs\Types\PromptAgentApiModelOutputBackupLlmConfig::default(
      $backupLlmDefault
    );

    $webhookToolConfigOutputType = \ElevenLabs\Types\WebhookToolConfigOutputType::Webhook->value;

    $dynamicVariablesConfig = new \ElevenLabs\Types\DynamicVariablesConfig([
      'dynamicVariablePlaceholders' => []
    ]);

    $toolExecutionMode = \ElevenLabs\Types\ToolExecutionMode::Immediate->value;

    $webhookToolApiSchemaConfigOutputRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $webhookToolApiSchemaConfigOutputMethod =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputMethod::Get->value;

    $literalJsonSchemaProperty = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutputPropertiesValue = new \ElevenLabs\Types\LiteralJsonSchemaProperty([
      'type' => $literalJsonSchemaPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => false,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $literalJsonSchemaPropertyConstantValue,
      'isOmitted' => false
    ]);

    $queryParamsJsonSchemaOutput = new \ElevenLabs\Types\QueryParamsJsonSchemaOutput([
      'properties' => [],
      'required' => []
    ]);

    $responseFilterMode = \ElevenLabs\Types\ResponseFilterMode::All->value;

    $responseFilterContentType =
      \ElevenLabs\Types\ResponseFilterContentType::ApplicationJson->value;

    $responseFilter = new \ElevenLabs\Types\ResponseFilter([
      'mode' => $responseFilterMode,
      'filters' => [],
      'contentType' => $responseFilterContentType
    ]);

    $webhookToolApiSchemaConfigOutputContentType =
      \ElevenLabs\Types\WebhookToolApiSchemaConfigOutputContentType::ApplicationJson->value;

    $webhookToolApiSchemaConfigOutputAuthConnection = new \ElevenLabs\Types\AuthConnectionLocator([
      'authConnectionId' => 'auth_connection_id'
    ]);

    $webhookToolApiSchemaConfigOutput = new \ElevenLabs\Types\WebhookToolApiSchemaConfigOutput([
      'requestHeaders' => [],
      'url' => 'url',
      'method' => $webhookToolApiSchemaConfigOutputMethod,
      'pathParamsSchema' => [],
      'queryParamsSchema' => $queryParamsJsonSchemaOutput,
      'requestBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseBodySchema' => $objectJsonSchemaPropertyOutput,
      'responseFilter' => $responseFilter,
      'contentType' => $webhookToolApiSchemaConfigOutputContentType,
      'authResolvedParams' => [],
      'authConnection' => $webhookToolApiSchemaConfigOutputAuthConnection
    ]);

    $webhookToolConfigOutput = new \ElevenLabs\Types\WebhookToolConfigOutput([
      'type' => $webhookToolConfigOutputType,
      'name' => 'name',
      'description' => 'description',
      'responseTimeoutSecs' => 20,
      'disableInterruptions' => true,
      'interruptionMode' => $toolInterruptionMode,
      'forcePreToolSpeech' => true,
      'preToolSpeech' => $preToolSpeechMode,
      'assignments' => [],
      'toolCallSound' => $toolCallSoundType,
      'toolCallSoundBehavior' => $toolCallSoundBehavior,
      'toolErrorHandlingMode' => $toolErrorHandlingMode,
      'dynamicVariables' => $dynamicVariablesConfig,
      'executionMode' => $toolExecutionMode,
      'apiSchema' => $webhookToolApiSchemaConfigOutput,
      'followRedirects' => true,
      'followRedirectsAllowedDomains' => []
    ]);
    $promptAgentApiModelOutputToolsItem = \ElevenLabs\Types\PromptAgentApiModelOutputToolsItem::webhook(
      $webhookToolConfigOutput
    );

    $promptAgentApiModelOutput = new \ElevenLabs\Types\PromptAgentApiModelOutput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'serviceTier' => $llmServiceTier,
      'thinkingBudget' => 3,
      'enableReasoningSummary' => true,
      'temperature' => 6.3,
      'maxTokens' => -1,
      'toolIds' => [],
      'toolIdsStrict' => false,
      'builtInTools' => $builtInToolsOutput,
      'enableParallelToolCalls' => true,
      'mcpServerIds' => [],
      'nativeMcpServerIds' => [],
      'knowledgeBase' => [],
      'customLlm' => $customLlm,
      'ignoreDefaultPersonality' => true,
      'rag' => $ragConfigOutput,
      'timezone' => 'timezone',
      'backupLlmConfig' => $promptAgentApiModelOutputBackupLlmConfig,
      'cascadeTimeoutSeconds' => 4,
      'tools' => []
    ]);

    $agentConfig = new \ElevenLabs\Types\AgentConfig([
      'firstMessage' => 'first_message',
      'language' => 'en',
      'hinglishMode' => false,
      'dynamicVariables' => [],
      'disableFirstMessageInterruptions' => false,
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'textBehaviorOverrides' => [],
      'subagentConfig' => $subagentConfigOutput,
      'prompt' => $promptAgentApiModelOutput
    ]);

    $conversationalConfig = new \ElevenLabs\Types\ConversationalConfig([
      'asr' => $asrConversationalConfig,
      'turn' => $turnConfig,
      'tts' => $ttsConversationalConfigOutput,
      'conversation' => $conversationConfigOutput,
      'languagePresets' => [],
      'vad' => $vadConfig,
      'agent' => $agentConfig
    ]);

    $promptEvaluationCriteriaType = \ElevenLabs\Types\PromptEvaluationCriteriaType::Prompt->value;

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $criteriaScoringMode = \ElevenLabs\Types\CriteriaScoringMode::Binary->value;

    $promptEvaluationCriteria = new \ElevenLabs\Types\PromptEvaluationCriteria([
      'id' => 'id',
      'name' => 'name',
      'type' => $promptEvaluationCriteriaType,
      'conversationGoalPrompt' => 'conversation_goal_prompt',
      'useKnowledgeBase' => false,
      'scope' => $analysisScope,
      'llm' => $llm,
      'scoringMode' => $criteriaScoringMode,
      'maxScore' => 100,
      'scoreInstructions' => 'score_instructions'
    ]);

    $evaluationSettingsInput = new \ElevenLabs\Types\EvaluationSettingsInput([
      'criteria' => []
    ]);

    $embedVariant = \ElevenLabs\Types\EmbedVariant::Tiny->value;

    $widgetPlacement = \ElevenLabs\Types\WidgetPlacement::TopLeft->value;

    $widgetExpandable = \ElevenLabs\Types\WidgetExpandable::Never->value;

    $orbAvatarType = \ElevenLabs\Types\OrbAvatarType::Orb->value;

    $orbAvatar = new \ElevenLabs\Types\OrbAvatar([
      'type' => $orbAvatarType,
      'color1' => '#2792dc',
      'color2' => '#9ce6e6'
    ]);
    $widgetConfigAvatar = \ElevenLabs\Types\WidgetConfigAvatar::orb($orbAvatar);

    $widgetFeedbackMode = \ElevenLabs\Types\WidgetFeedbackMode::None->value;

    $widgetEndFeedbackType = \ElevenLabs\Types\WidgetEndFeedbackType::Rating->value;

    $widgetEndFeedbackConfig = new \ElevenLabs\Types\WidgetEndFeedbackConfig([
      'type' => $widgetEndFeedbackType
    ]);

    $allowlistItem = new \ElevenLabs\Types\AllowlistItem([
      'hostname' => 'hostname'
    ]);

    $widgetConfigSyntaxHighlightTheme =
      \ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme::Light->value;

    $widgetTextContents = new \ElevenLabs\Types\WidgetTextContents([
      'mainLabel' => 'main_label',
      'startCall' => 'start_call',
      'startChat' => 'start_chat',
      'newCall' => 'new_call',
      'endCall' => 'end_call',
      'muteMicrophone' => 'mute_microphone',
      'changeLanguage' => 'change_language',
      'collapse' => 'collapse',
      'expand' => 'expand',
      'copied' => 'copied',
      'acceptTerms' => 'accept_terms',
      'dismissTerms' => 'dismiss_terms',
      'listeningStatus' => 'listening_status',
      'speakingStatus' => 'speaking_status',
      'connectingStatus' => 'connecting_status',
      'chattingStatus' => 'chatting_status',
      'queueWaitingStatus' => 'queue_waiting_status',
      'queueWaitingStatusShort' => 'queue_waiting_status_short',
      'inputLabel' => 'input_label',
      'inputPlaceholder' => 'input_placeholder',
      'inputPlaceholderTextOnly' => 'input_placeholder_text_only',
      'inputPlaceholderNewConversation' => 'input_placeholder_new_conversation',
      'userEndedConversation' => 'user_ended_conversation',
      'agentEndedConversation' => 'agent_ended_conversation',
      'conversationId' => 'conversation_id',
      'errorOccurred' => 'error_occurred',
      'queueTimedOut' => 'queue_timed_out',
      'copyId' => 'copy_id',
      'initiateFeedback' => 'initiate_feedback',
      'requestFollowUpFeedback' => 'request_follow_up_feedback',
      'thanksForFeedback' => 'thanks_for_feedback',
      'thanksForFeedbackDetails' => 'thanks_for_feedback_details',
      'followUpFeedbackPlaceholder' => 'follow_up_feedback_placeholder',
      'submit' => 'submit',
      'goBack' => 'go_back',
      'sendMessage' => 'send_message',
      'textMode' => 'text_mode',
      'voiceMode' => 'voice_mode',
      'switchedToTextMode' => 'switched_to_text_mode',
      'switchedToVoiceMode' => 'switched_to_voice_mode',
      'copy' => 'copy',
      'download' => 'download',
      'wrap' => 'wrap',
      'agentWorking' => 'agent_working',
      'agentDone' => 'agent_done',
      'agentError' => 'agent_error',
      'attachFile' => 'attach_file',
      'removeFile' => 'remove_file',
      'fileUploadError' => 'file_upload_error',
      'fileTypeUnsupported' => 'file_type_unsupported',
      'fileTooLarge' => 'file_too_large',
      'fileLimitReached' => 'file_limit_reached',
      'typingIndicator' => 'typing_indicator',
      'richContentUnavailable' => 'rich_content_unavailable'
    ]);

    $widgetStyles = new \ElevenLabs\Types\WidgetStyles([
      'base' => 'base',
      'baseHover' => 'base_hover',
      'baseActive' => 'base_active',
      'baseBorder' => 'base_border',
      'baseSubtle' => 'base_subtle',
      'basePrimary' => 'base_primary',
      'baseError' => 'base_error',
      'accent' => 'accent',
      'accentHover' => 'accent_hover',
      'accentActive' => 'accent_active',
      'accentBorder' => 'accent_border',
      'accentSubtle' => 'accent_subtle',
      'accentPrimary' => 'accent_primary',
      'overlayPadding' => 6.64,
      'buttonRadius' => 6.41,
      'inputRadius' => 6.32,
      'bubbleRadius' => 3.68,
      'sheetRadius' => 3.55,
      'compactSheetRadius' => 3.52,
      'dropdownSheetRadius' => 6.58
    ]);

    $widgetTextContentsTranslation = new \ElevenLabs\Types\WidgetTextContentsTranslation([
      'source' => [],
      'text' => []
    ]);

    $widgetTermsTranslation = new \ElevenLabs\Types\WidgetTermsTranslation([
      'sourceHash' => 'source_hash',
      'text' => 'text'
    ]);

    $widgetLanguagePreset = new \ElevenLabs\Types\WidgetLanguagePreset([
      'textContents' => $widgetTextContents,
      'textContentsTranslation' => $widgetTextContentsTranslation,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'termsTranslation' => $widgetTermsTranslation
    ]);

    $widgetConfig = new \ElevenLabs\Types\WidgetConfig([
      'variant' => $embedVariant,
      'placement' => $widgetPlacement,
      'expandable' => $widgetExpandable,
      'avatar' => $widgetConfigAvatar,
      'feedbackMode' => $widgetFeedbackMode,
      'endFeedback' => $widgetEndFeedbackConfig,
      'bgColor' => '#ffffff',
      'textColor' => '#000000',
      'btnColor' => '#000000',
      'btnTextColor' => '#ffffff',
      'borderColor' => '#e1e1e1',
      'focusColor' => '#000000',
      'borderRadius' => 5,
      'btnRadius' => 8,
      'actionText' => 'action_text',
      'startCallText' => 'start_call_text',
      'endCallText' => 'end_call_text',
      'expandText' => 'expand_text',
      'listeningText' => 'listening_text',
      'speakingText' => 'speaking_text',
      'shareablePageText' => 'shareable_page_text',
      'shareablePageShowTerms' => true,
      'termsText' => 'terms_text',
      'termsHtml' => 'terms_html',
      'termsKey' => 'terms_key',
      'showAvatarWhenCollapsed' => true,
      'disableBanner' => true,
      'overrideLink' => 'override_link',
      'markdownLinkAllowedHosts' => [],
      'markdownLinkIncludeWww' => true,
      'markdownLinkAllowHttp' => true,
      'micMutingEnabled' => true,
      'transcriptEnabled' => true,
      'textInputEnabled' => true,
      'conversationModeToggleEnabled' => true,
      'defaultExpanded' => false,
      'alwaysExpanded' => true,
      'dismissible' => false,
      'showAgentStatus' => false,
      'showConversationId' => true,
      'stripAudioTags' => true,
      'syntaxHighlightTheme' => $widgetConfigSyntaxHighlightTheme,
      'textContents' => $widgetTextContents,
      'styles' => $widgetStyles,
      'showResizeButton' => true,
      'endConfirmationEnabled' => false,
      'mobileFullscreen' => true,
      'transcriptSpeechSyncEnabled' => true,
      'languageSelector' => false,
      'supportsTextOnly' => true,
      'customAvatarPath' => 'custom_avatar_path',
      'languagePresets' => []
    ]);

    $analysisPropertyType = \ElevenLabs\Types\AnalysisPropertyType::Boolean->value;

    $analysisPropertyConstantValue = []; // TODO: populate with required fields

    $analysisProperty = new \ElevenLabs\Types\AnalysisProperty([
      'type' => $analysisPropertyType,
      'description' => 'description',
      'enum' => [],
      'isSystemProvided' => true,
      'dynamicVariable' => 'dynamic_variable',
      'allowedValues' => $allowedValues,
      'allowedValuesDynamicVariable' => 'allowed_values_dynamic_variable',
      'constantValue' => $analysisPropertyConstantValue,
      'isOmitted' => false,
      'name' => 'name',
      'llm' => $llm
    ]);

    $analysisScope = \ElevenLabs\Types\AnalysisScope::Conversation->value;

    $attachedUserEvaluationRefSource =
      \ElevenLabs\Types\AttachedUserEvaluationRefSource::User->value;

    $attachedUserEvaluationRef = new \ElevenLabs\Types\AttachedUserEvaluationRef([
      'source' => $attachedUserEvaluationRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'additionalVersionIds' => [],
      'scope' => $analysisScope,
      'weight' => 7.08
    ]);
    $agentAnalysisItemsInputEvaluationCriteriaItem = \ElevenLabs\Types\AgentAnalysisItemsInputEvaluationCriteriaItem::user(
      $attachedUserEvaluationRef
    );

    $attachedUserDataCollectionRefSource =
      \ElevenLabs\Types\AttachedUserDataCollectionRefSource::User->value;

    $attachedUserDataCollectionRef = new \ElevenLabs\Types\AttachedUserDataCollectionRef([
      'source' => $attachedUserDataCollectionRefSource,
      'analysisItemId' => 'analysis_item_id',
      'versionId' => 'latest',
      'scope' => $analysisScope
    ]);
    $agentAnalysisItemsInputDataCollectionItem = \ElevenLabs\Types\AgentAnalysisItemsInputDataCollectionItem::user(
      $attachedUserDataCollectionRef
    );

    $agentAnalysisItemsInput = new \ElevenLabs\Types\AgentAnalysisItemsInput([
      'evaluationCriteria' => [],
      'dataCollection' => []
    ]);

    $asrConversationalConfigOverrideConfig = new \ElevenLabs\Types\AsrConversationalConfigOverrideConfig(
      [
        'keywords' => false
      ]
    );

    $softTimeoutConfigOverrideConfig = new \ElevenLabs\Types\SoftTimeoutConfigOverrideConfig([
      'message' => false,
      'additionalSoftTimeoutMessages' => false
    ]);

    $turnConfigOverrideConfig = new \ElevenLabs\Types\TurnConfigOverrideConfig([
      'softTimeoutConfig' => $softTimeoutConfigOverrideConfig,
      'noisyEnvironmentMessage' => false
    ]);

    $ttsConversationalConfigOverrideConfig = new \ElevenLabs\Types\TtsConversationalConfigOverrideConfig(
      [
        'modelId' => false,
        'voiceId' => false,
        'supportedVoices' => false,
        'stability' => false,
        'speed' => false,
        'similarityBoost' => true,
        'cloneStrength' => true,
        'pronunciationDictionaryLocators' => false
      ]
    );

    $conversationConfigOverrideConfig = new \ElevenLabs\Types\ConversationConfigOverrideConfig([
      'textOnly' => true,
      'maxDurationSeconds' => false
    ]);

    $promptAgentApiModelOverrideConfig = new \ElevenLabs\Types\PromptAgentApiModelOverrideConfig([
      'prompt' => true,
      'llm' => false,
      'reasoningEffort' => false,
      'toolIds' => true,
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => true,
      'knowledgeBase' => true
    ]);

    $agentConfigOverrideConfig = new \ElevenLabs\Types\AgentConfigOverrideConfig([
      'firstMessage' => true,
      'language' => true,
      'maxConversationDurationMessage' => true,
      'prompt' => $promptAgentApiModelOverrideConfig
    ]);

    $conversationConfigClientOverrideConfigInput = new \ElevenLabs\Types\ConversationConfigClientOverrideConfigInput(
      [
        'asr' => $asrConversationalConfigOverrideConfig,
        'turn' => $turnConfigOverrideConfig,
        'tts' => $ttsConversationalConfigOverrideConfig,
        'conversation' => $conversationConfigOverrideConfig,
        'agent' => $agentConfigOverrideConfig
      ]
    );

    $conversationInitiationClientDataConfigInput = new \ElevenLabs\Types\ConversationInitiationClientDataConfigInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideConfigInput,
        'customLlmExtraBody' => true,
        'enableConversationInitiationClientDataFromWebhook' => false,
        'enableStartingWorkflowNodeIdFromClient' => true,
        'enableProcedureIdsFromClient' => false
      ]
    );

    $conversationInitiationClientDataWebhookRequestHeadersValue = new \ElevenLabs\Types\ConvAiSecretLocator(
      [
        'secretId' => 'secret_id'
      ]
    );

    $conversationInitiationClientDataWebhook = new \ElevenLabs\Types\ConversationInitiationClientDataWebhook(
      [
        'url' => 'url',
        'requestHeaders' => []
      ]
    );

    $webhookEventType = \ElevenLabs\Types\WebhookEventType::Transcript->value;

    $webhookTranscriptFormat = \ElevenLabs\Types\WebhookTranscriptFormat::Json->value;

    $convAiWebhooks = new \ElevenLabs\Types\ConvAiWebhooks([
      'postCallWebhookId' => 'post_call_webhook_id',
      'events' => [],
      'transcriptFormat' => $webhookTranscriptFormat,
      'excludeTranscript' => false,
      'sendAudio' => true
    ]);

    $agentWorkspaceOverridesInput = new \ElevenLabs\Types\AgentWorkspaceOverridesInput([
      'conversationInitiationClientDataWebhook' => $conversationInitiationClientDataWebhook,
      'webhooks' => $convAiWebhooks
    ]);

    $attachedTestModel = new \ElevenLabs\Types\AttachedTestModel([
      'testId' => 'test_id',
      'workflowNodeId' => 'workflow_node_id'
    ]);

    $agentTestingSettings = new \ElevenLabs\Types\AgentTestingSettings([
      'attachedTests' => []
    ]);

    $guardrailsV1InputVersion = \ElevenLabs\Types\GuardrailsV1InputVersion::One->value;

    $focusGuardrail = new \ElevenLabs\Types\FocusGuardrail([
      'isEnabled' => false
    ]);

    $promptInjectionGuardrail = new \ElevenLabs\Types\PromptInjectionGuardrail([
      'isEnabled' => false
    ]);

    $guardrailExecutionMode = \ElevenLabs\Types\GuardrailExecutionMode::Streaming->value;

    $contentThresholdGuardrailThreshold = \ElevenLabs\Types\Threshold2::Low->value;

    $contentThresholdGuardrail = new \ElevenLabs\Types\ContentThresholdGuardrail([
      'isEnabled' => false,
      'threshold' => $contentThresholdGuardrailThreshold
    ]);

    $contentConfig = new \ElevenLabs\Types\ContentConfig([
      'sexual' => $contentThresholdGuardrail,
      'violence' => $contentThresholdGuardrail,
      'harassment' => $contentThresholdGuardrail,
      'selfHarm' => $contentThresholdGuardrail,
      'profanity' => $contentThresholdGuardrail,
      'religionOrPolitics' => $contentThresholdGuardrail,
      'medicalAndLegalInformation' => $contentThresholdGuardrail
    ]);

    $endCallTriggerActionType = \ElevenLabs\Types\EndCallTriggerActionType::EndCall->value;

    $endCallTriggerAction = new \ElevenLabs\Types\EndCallTriggerAction([
      'type' => $endCallTriggerActionType
    ]);
    $contentGuardrailInputTriggerAction = \ElevenLabs\Types\ContentGuardrailInputTriggerAction::endCall(
      $endCallTriggerAction
    );

    $contentGuardrailInput = new \ElevenLabs\Types\ContentGuardrailInput([
      'executionMode' => $guardrailExecutionMode,
      'config' => $contentConfig,
      'triggerAction' => $contentGuardrailInputTriggerAction
    ]);

    $customGuardrailConfigModel =
      \ElevenLabs\Types\CustomGuardrailConfigModel::Gemini25FlashLite->value;

    $customGuardrailConfigTriggerAction = \ElevenLabs\Types\CustomGuardrailConfigTriggerAction::endCall(
      $endCallTriggerAction
    );

    $customGuardrailConfig = new \ElevenLabs\Types\CustomGuardrailConfig([
      'isEnabled' => true,
      'name' => 'name',
      'prompt' => 'prompt',
      'executionMode' => $guardrailExecutionMode,
      'model' => $customGuardrailConfigModel,
      'serviceTier' => $llmServiceTier,
      'historyMessageCount' => 33,
      'triggerAction' => $customGuardrailConfigTriggerAction,
      'evaluateFullResponseOnly' => false
    ]);

    $customGuardrailsConfigInput = new \ElevenLabs\Types\CustomGuardrailsConfigInput([
      'configs' => []
    ]);

    $customGuardrailInput = new \ElevenLabs\Types\CustomGuardrailInput([
      'config' => $customGuardrailsConfigInput
    ]);

    $guardrailsV1Input = new \ElevenLabs\Types\GuardrailsV1Input([
      'version' => $guardrailsV1InputVersion,
      'focus' => $focusGuardrail,
      'promptInjection' => $promptInjectionGuardrail,
      'content' => $contentGuardrailInput,
      'custom' => $customGuardrailInput
    ]);

    $authSettings = new \ElevenLabs\Types\AuthSettings([
      'enableAuth' => true,
      'allowlist' => [],
      'requireOriginHeader' => true,
      'shareableToken' => 'shareable_token'
    ]);

    $agentCallLimits = new \ElevenLabs\Types\AgentCallLimits([
      'agentConcurrencyLimit' => -1,
      'dailyLimit' => 100000,
      'burstingEnabled' => true
    ]);

    $agentHoldAudioConfig = new \ElevenLabs\Types\AgentHoldAudioConfig([
      'audioPath' => 'audio_path',
      'audioUrl' => 'audio_url',
      'originalFilename' => 'original_filename',
      'durationSecs' => 4.56,
      'sizeBytes' => 7
    ]);

    $agentQueueingConfig = new \ElevenLabs\Types\AgentQueueingConfig([
      'enabled' => false,
      'waitTimeoutSeconds' => 180,
      'holdAudio' => $agentHoldAudioConfig
    ]);

    $configEntityType = \ElevenLabs\Types\ConfigEntityType::Name->value;

    $conversationHistoryRedactionConfig = new \ElevenLabs\Types\ConversationHistoryRedactionConfig([
      'enabled' => false,
      'entities' => [],
      'excludedDataCollectionIds' => []
    ]);

    $privacyConfigInput = new \ElevenLabs\Types\PrivacyConfigInput([
      'recordVoice' => true,
      'retentionDays' => -1,
      'deleteTranscriptAndPii' => true,
      'deleteAudio' => false,
      'applyToExistingConversations' => true,
      'zeroRetentionMode' => true,
      'conversationHistoryRedaction' => $conversationHistoryRedactionConfig
    ]);

    $agentTrustContext = \ElevenLabs\Types\AgentTrustContext::Unknown->value;

    $topicDiscoverySettings = new \ElevenLabs\Types\TopicDiscoverySettings();

    $sentimentAnalysisSettings = new \ElevenLabs\Types\SentimentAnalysisSettings();

    $alertingMonitorConfig = new \ElevenLabs\Types\AlertingMonitorConfig([
      'enabled' => false,
      'threshold' => 0.24,
      'relativeIncreaseThreshold' => 9.18,
      'minFailureCount' => 1,
      'minHistoryBucketCount' => 7,
      'minSampleCount' => 2,
      'suspectTriggerThreshold' => 8,
      'autoResolveAfterInactiveMinutes' => 10
    ]);

    $alertingWebhookNotifierType = \ElevenLabs\Types\AlertingWebhookNotifierType::Webhook->value;

    $alertingWebhookNotifier = new \ElevenLabs\Types\AlertingWebhookNotifier([
      'type' => $alertingWebhookNotifierType,
      'webhookId' => 'webhook_id'
    ]);
    $alertingSettingsNotifiersItem = \ElevenLabs\Types\AlertingSettingsNotifiersItem::webhook(
      $alertingWebhookNotifier
    );

    $alertingSettings = new \ElevenLabs\Types\AlertingSettings([
      'monitorConfigs' => [],
      'autoResolveAfterInactiveMinutes' => 10,
      'environments' => ['environments'],
      'notifiers' => []
    ]);

    $agentPlatformSettingsRequestModel = new \ElevenLabs\Types\AgentPlatformSettingsRequestModel([
      'evaluation' => $evaluationSettingsInput,
      'widget' => $widgetConfig,
      'dataCollection' => [],
      'dataCollectionScopes' => [],
      'analysisItems' => $agentAnalysisItemsInput,
      'overrides' => $conversationInitiationClientDataConfigInput,
      'workspaceOverrides' => $agentWorkspaceOverridesInput,
      'testing' => $agentTestingSettings,
      'archived' => false,
      'guardrails' => $guardrailsV1Input,
      'summaryLanguage' => 'summary_language',
      'autoTranslateTranscriptToAppLanguage' => false,
      'auth' => $authSettings,
      'callLimits' => $agentCallLimits,
      'queueingConfig' => $agentQueueingConfig,
      'privacy' => $privacyConfigInput,
      'trustContext' => $agentTrustContext,
      'analysisLlm' => $llm,
      'topicDiscovery' => $topicDiscoverySettings,
      'sentimentAnalysis' => $sentimentAnalysisSettings,
      'alerting' => $alertingSettings
    ]);

    $workflowUnconditionalModelInputType =
      \ElevenLabs\Types\WorkflowUnconditionalModelInputType::Unconditional->value;

    $workflowUnconditionalModelInput = new \ElevenLabs\Types\WorkflowUnconditionalModelInput([
      'label' => 'label',
      'type' => $workflowUnconditionalModelInputType
    ]);
    $workflowEdgeModelInputForwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputForwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $workflowEdgeModelInputBackwardCondition = \ElevenLabs\Types\WorkflowEdgeModelInputBackwardCondition::unconditional(
      $workflowUnconditionalModelInput
    );

    $positionInput = new \ElevenLabs\Types\PositionInput([
      'x' => 0.13,
      'y' => 8.06
    ]);

    $workflowEdgeModelInput = new \ElevenLabs\Types\WorkflowEdgeModelInput([
      'source' => 'source',
      'target' => 'target',
      'forwardCondition' => $workflowEdgeModelInputForwardCondition,
      'backwardCondition' => $workflowEdgeModelInputBackwardCondition,
      'reroutes' => []
    ]);

    $workflowStartNodeModelInputType =
      \ElevenLabs\Types\WorkflowStartNodeModelInputType::Start->value;

    $workflowStartNodeModelInput = new \ElevenLabs\Types\WorkflowStartNodeModelInput([
      'type' => $workflowStartNodeModelInputType,
      'position' => $positionInput,
      'edgeOrder' => []
    ]);
    $agentWorkflowRequestModelNodesValue = \ElevenLabs\Types\AgentWorkflowRequestModelNodesValue::start(
      $workflowStartNodeModelInput
    );

    $agentWorkflowRequestModel = new \ElevenLabs\Types\AgentWorkflowRequestModel([
      'edges' => [],
      'nodes' => [],
      'preventSubagentLoops' => false
    ]);

    $adhocAgentConfigOverrideForTestRequestModel = new \ElevenLabs\Types\AdhocAgentConfigOverrideForTestRequestModel(
      [
        'conversationConfig' => $conversationalConfig,
        'platformSettings' => $agentPlatformSettingsRequestModel,
        'workflow' => $agentWorkflowRequestModel
      ]
    );

    $request = new \ElevenLabs\Agents\Requests\RunAgentTestsRequestModel([
      'name' => 'name',
      'tests' => [$singleTestRunRequestModel],
      'agentConfigOverride' => $adhocAgentConfigOverrideForTestRequestModel,
      'branchId' => 'branch_id',
      'repeatCount' => 1
    ]);
    $sdk->agents->runTests(request: $request, agentId: 'agent_3701k3ttaq12ewp8b7qv5rfyszkz');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/agents/[^/]+/run-tests$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testRagIndexOverviewSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "total_used_bytes": 1,
          "total_max_bytes": 1,
          "models": [
              {
                  "model": "e5_mistral_7b_instruct",
                  "used_bytes": 1
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->ragIndexOverview();

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/rag-index$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testGetDocumentRagIndexesSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "indexes": [
              {
                  "id": "test-value",
                  "model": "e5_mistral_7b_instruct",
                  "status": "new",
                  "progress_percentage": 1,
                  "document_model_index_usage": {
                      "used_bytes": 1
                  }
              }
          ]
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->getDocumentRagIndexes(documentationId: '21m00Tcm4TlvDq8ikWAM');

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('GET', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/rag-index$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  public function testDeleteDocumentRagIndexSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "id": "test-value",
          "model": "e5_mistral_7b_instruct",
          "status": "new",
          "progress_percentage": 1,
          "document_model_index_usage": {
              "used_bytes": 1
          }
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $sdk->agents->deleteDocumentRagIndex(
      documentationId: '21m00Tcm4TlvDq8ikWAM',
      ragIndexId: '21m00Tcm4TlvDq8ikWAM'
    );

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('DELETE', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/knowledge-base/[^/]+/rag-index/[^/]+$#',
      rawurldecode($sent->getUri()->getPath())
    );
  }

  /**
   * @return ClientInterface&object{requests: list<RequestInterface>}
   */
  private function transport(int $status, string $body): ClientInterface
  {
    return new class ($status, $body) implements ClientInterface {
      /** @var list<RequestInterface> */
      public array $requests = [];

      public function __construct(private int $status, private string $body)
      {
      }

      public function sendRequest(RequestInterface $request): ResponseInterface
      {
        $this->requests[] = $request;

        return new \GuzzleHttp\Psr7\Response(
          $this->status,
          ['Content-Type' => 'application/json'],
          $this->body
        );
      }
    };
  }
}
