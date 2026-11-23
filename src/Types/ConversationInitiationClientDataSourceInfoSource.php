<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

/**
 * Source of the conversation initiation
 */
enum ConversationInitiationClientDataSourceInfoSource: string
{
  case Unknown = 'unknown';
  case AndroidSdk = 'android_sdk';
  case NodeJsSdk = 'node_js_sdk';
  case ReactNativeSdk = 'react_native_sdk';
  case ReactSdk = 'react_sdk';
  case JsSdk = 'js_sdk';
  case PythonSdk = 'python_sdk';
  case Widget = 'widget';
  case SipTrunk = 'sip_trunk';
  case Twilio = 'twilio';
  case Exotel = 'exotel';
  case Genesys = 'genesys';
  case Avaya = 'avaya';
  case Audiocodes = 'audiocodes';
  case SwiftSdk = 'swift_sdk';
  case Whatsapp = 'whatsapp';
  case TwilioSms = 'twilio_sms';
  case FlutterSdk = 'flutter_sdk';
  case ZendeskIntegration = 'zendesk_integration';
  case SlackIntegration = 'slack_integration';
  case TelegramIntegration = 'telegram_integration';
  case IntercomIntegration = 'intercom_integration';
  case FreshdeskIntegration = 'freshdesk_integration';
  case PlainIntegration = 'plain_integration';
  case SalesforceIntegration = 'salesforce_integration';
  case TemplatePreview = 'template_preview';
  case GenesysBotConnector = 'genesys_bot_connector';
  case SubagentTool = 'subagent_tool';
  case AgentMessagesApi = 'agent_messages_api';
}
