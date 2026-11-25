<?php

declare(strict_types=1);

namespace ElevenLabs\Tests\Wire\Agents\Whatsapp;

use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ElevenLabs\ElevenLabs;

class WhatsappWireTest extends TestCase
{
  public function testOutboundCallSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "success": true,
          "message": "test-value",
          "conversation_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);

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
      'stability' => 0.56,
      'speed' => 0.83,
      'similarityBoost' => 0.04,
      'cloneStrength' => 0.3
    ]);

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 4.99,
      'speed' => 7.29,
      'similarityBoost' => 5.75,
      'cloneStrength' => 5.08,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => true,
      'maxDurationSeconds' => 9
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

    $promptAgentApiModelOverrideInput = new \ElevenLabs\Types\PromptAgentApiModelOverrideInput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideInput = new \ElevenLabs\Types\AgentConfigOverrideInput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideInput
    ]);

    $conversationConfigClientOverrideInput = new \ElevenLabs\Types\ConversationConfigClientOverrideInput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideInput
      ]
    );

    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown->value;

    $conversationInitiationSourceInfo = new \ElevenLabs\Types\ConversationInitiationSourceInfo([
      'source' => $conversationInitiationSource,
      'version' => 'version'
    ]);

    $conversationInitiationClientDataRequestInput = new \ElevenLabs\Types\ConversationInitiationClientDataRequestInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideInput,
        'customLlmExtraBody' => [],
        'userId' => 'user_id',
        'sourceInfo' => $conversationInitiationSourceInfo,
        'branchId' => 'branch_id',
        'environment' => 'environment',
        'startingWorkflowNodeId' => 'starting_workflow_node_id',
        'procedureIds' => [],
        'startProcedureIds' => [],
        'dynamicVariables' => []
      ]
    );

    $request = new \ElevenLabs\Agents\Whatsapp\Requests\BodyMakeAnOutboundCallViaWhatsAppV1ConvaiWhatsappOutboundCallPost(
      [
        'whatsappPhoneNumberId' => 'whatsapp_phone_number_id',
        'whatsappUserId' => 'whatsapp_user_id',
        'whatsappCallPermissionRequestTemplateName' =>
          'whatsapp_call_permission_request_template_name',
        'whatsappCallPermissionRequestTemplateLanguageCode' =>
          'whatsapp_call_permission_request_template_language_code',
        'agentId' => 'agent_id',
        'conversationInitiationClientData' => $conversationInitiationClientDataRequestInput
      ]
    );
    $sdk->agents->whatsapp->outboundCall(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp/outbound-call$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
  }

  public function testOutboundMessageSendsWireRequest(): void
  {
    $transport = $this->transport(
      200,
      <<<'JSON'
      {
          "conversation_id": "test-value"
      }
      JSON
    );
    $sdk = new ElevenLabs(options: ['client' => $transport]);
    $whatsAppTemplateHeaderComponentParamsType =
      \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParamsType::Header->value;

    $whatsAppTemplateTextParamType = \ElevenLabs\Types\WhatsAppTemplateTextParamType::Text->value;

    $whatsAppTemplateTextParam = new \ElevenLabs\Types\WhatsAppTemplateTextParam([
      'parameterName' => 'parameter_name',
      'type' => $whatsAppTemplateTextParamType,
      'text' => 'text'
    ]);
    $whatsAppTemplateHeaderComponentParamsParametersItem = \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParamsParametersItem::text(
      $whatsAppTemplateTextParam
    );

    $whatsAppTemplateHeaderComponentParams = new \ElevenLabs\Types\WhatsAppTemplateHeaderComponentParams(
      [
        'type' => $whatsAppTemplateHeaderComponentParamsType,
        'parameters' => []
      ]
    );
    $bodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem = \ElevenLabs\Agents\Whatsapp\Types\BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem::header(
      $whatsAppTemplateHeaderComponentParams
    );

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
      'stability' => 0.56,
      'speed' => 0.83,
      'similarityBoost' => 0.04,
      'cloneStrength' => 0.3
    ]);

    $pydanticPronunciationDictionaryVersionLocator = new \ElevenLabs\Types\PydanticPronunciationDictionaryVersionLocator(
      [
        'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
        'versionId' => 'version_id'
      ]
    );

    $ttsConversationalConfigOverride = new \ElevenLabs\Types\TtsConversationalConfigOverride([
      'modelId' => $ttsConversationalModel,
      'voiceId' => 'voice_id',
      'supportedVoices' => [],
      'stability' => 4.99,
      'speed' => 7.29,
      'similarityBoost' => 5.75,
      'cloneStrength' => 5.08,
      'pronunciationDictionaryLocators' => []
    ]);

    $conversationConfigOverride = new \ElevenLabs\Types\ConversationConfigOverride([
      'textOnly' => true,
      'maxDurationSeconds' => 9
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

    $promptAgentApiModelOverrideInput = new \ElevenLabs\Types\PromptAgentApiModelOverrideInput([
      'prompt' => 'prompt',
      'llm' => $llm,
      'reasoningEffort' => $llmReasoningEffort,
      'toolIds' => [],
      'toolIdsStrict' => true,
      'nativeMcpServerIds' => [],
      'knowledgeBase' => []
    ]);

    $agentConfigOverrideInput = new \ElevenLabs\Types\AgentConfigOverrideInput([
      'firstMessage' => 'first_message',
      'language' => 'language',
      'maxConversationDurationMessage' => 'max_conversation_duration_message',
      'prompt' => $promptAgentApiModelOverrideInput
    ]);

    $conversationConfigClientOverrideInput = new \ElevenLabs\Types\ConversationConfigClientOverrideInput(
      [
        'asr' => $asrConversationalConfigOverride,
        'turn' => $turnConfigOverride,
        'tts' => $ttsConversationalConfigOverride,
        'conversation' => $conversationConfigOverride,
        'agent' => $agentConfigOverrideInput
      ]
    );

    $conversationInitiationSource = \ElevenLabs\Types\ConversationInitiationSource::Unknown->value;

    $conversationInitiationSourceInfo = new \ElevenLabs\Types\ConversationInitiationSourceInfo([
      'source' => $conversationInitiationSource,
      'version' => 'version'
    ]);

    $conversationInitiationClientDataRequestInput = new \ElevenLabs\Types\ConversationInitiationClientDataRequestInput(
      [
        'conversationConfigOverride' => $conversationConfigClientOverrideInput,
        'customLlmExtraBody' => [],
        'userId' => 'user_id',
        'sourceInfo' => $conversationInitiationSourceInfo,
        'branchId' => 'branch_id',
        'environment' => 'environment',
        'startingWorkflowNodeId' => 'starting_workflow_node_id',
        'procedureIds' => [],
        'startProcedureIds' => [],
        'dynamicVariables' => []
      ]
    );

    $request = new \ElevenLabs\Agents\Whatsapp\Requests\BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePost(
      [
        'whatsappPhoneNumberId' => 'whatsapp_phone_number_id',
        'whatsappUserId' => 'whatsapp_user_id',
        'templateName' => 'template_name',
        'templateLanguageCode' => 'template_language_code',
        'templateParams' => [],
        'agentId' => 'agent_id',
        'conversationInitiationClientData' => $conversationInitiationClientDataRequestInput
      ]
    );
    $sdk->agents->whatsapp->outboundMessage(request: $request);

    $this->assertCount(1, $transport->requests);
    $sent = $transport->requests[0];
    $this->assertSame('POST', $sent->getMethod());
    $this->assertMatchesRegularExpression(
      '#/v1/convai/whatsapp/outbound-message$#',
      rawurldecode($sent->getUri()->getPath())
    );
    $this->assertStringStartsWith('application/json', $sent->getHeaderLine('Content-Type'));
    $this->assertNotNull(json_decode((string) $sent->getBody(), true));
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
