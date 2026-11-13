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
class WidgetTextContents extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * Call to action displayed inside the compact and full variants.
   */
  #[JsonProperty('main_label')]
  public ?string $mainLabel;

  /**
   * Text and ARIA label for the start call button.
   */
  #[JsonProperty('start_call')]
  public ?string $startCall;

  /**
   * Text and ARIA label for the start chat button (text only)
   */
  #[JsonProperty('start_chat')]
  public ?string $startChat;

  /**
   * Text and ARIA label for the new call button. Displayed when the caller already finished at least one call in order ot start the next one.
   */
  #[JsonProperty('new_call')]
  public ?string $newCall;

  /**
   * Text and ARIA label for the end call button.
   */
  #[JsonProperty('end_call')]
  public ?string $endCall;

  /**
   * ARIA label for the mute microphone button.
   */
  #[JsonProperty('mute_microphone')]
  public ?string $muteMicrophone;

  /**
   * ARIA label for the change language dropdown.
   */
  #[JsonProperty('change_language')]
  public ?string $changeLanguage;

  /**
   * ARIA label for the collapse button.
   */
  #[JsonProperty('collapse')]
  public ?string $collapse;

  /**
   * ARIA label for the expand button.
   */
  #[JsonProperty('expand')]
  public ?string $expand;

  /**
   * Text displayed when the user copies a value using the copy button.
   */
  #[JsonProperty('copied')]
  public ?string $copied;

  /**
   * Text and ARIA label for the accept terms button.
   */
  #[JsonProperty('accept_terms')]
  public ?string $acceptTerms;

  /**
   * Text and ARIA label for the cancel terms button.
   */
  #[JsonProperty('dismiss_terms')]
  public ?string $dismissTerms;

  /**
   * Status displayed when the agent is listening.
   */
  #[JsonProperty('listening_status')]
  public ?string $listeningStatus;

  /**
   * Status displayed when the agent is speaking.
   */
  #[JsonProperty('speaking_status')]
  public ?string $speakingStatus;

  /**
   * Status displayed when the agent is connecting.
   */
  #[JsonProperty('connecting_status')]
  public ?string $connectingStatus;

  /**
   * Status displayed when the agent is chatting (text only)
   */
  #[JsonProperty('chatting_status')]
  public ?string $chattingStatus;

  /**
   * Status displayed while waiting in the queue for an available agent.
   */
  #[JsonProperty('queue_waiting_status')]
  public ?string $queueWaitingStatus;

  /**
   * Short status displayed while waiting for an available agent.
   */
  #[JsonProperty('queue_waiting_status_short')]
  public ?string $queueWaitingStatusShort;

  /**
   * ARIA label for the text message input.
   */
  #[JsonProperty('input_label')]
  public ?string $inputLabel;

  /**
   * Placeholder text for the text message input.
   */
  #[JsonProperty('input_placeholder')]
  public ?string $inputPlaceholder;

  /**
   * Placeholder text for the text message input (text only)
   */
  #[JsonProperty('input_placeholder_text_only')]
  public ?string $inputPlaceholderTextOnly;

  /**
   * Placeholder text for the text message input when starting a new conversation (text only)
   */
  #[JsonProperty('input_placeholder_new_conversation')]
  public ?string $inputPlaceholderNewConversation;

  /**
   * Information message displayed when the user ends the conversation.
   */
  #[JsonProperty('user_ended_conversation')]
  public ?string $userEndedConversation;

  /**
   * Information message displayed when the agent ends the conversation.
   */
  #[JsonProperty('agent_ended_conversation')]
  public ?string $agentEndedConversation;

  /**
   * Text label used next to the conversation ID.
   */
  #[JsonProperty('conversation_id')]
  public ?string $conversationId;

  /**
   * Text label used when an error occurs.
   */
  #[JsonProperty('error_occurred')]
  public ?string $errorOccurred;

  /**
   * Error message displayed when the queue wait times out.
   */
  #[JsonProperty('queue_timed_out')]
  public ?string $queueTimedOut;

  /**
   * Text and ARIA label used for the copy ID button.
   */
  #[JsonProperty('copy_id')]
  public ?string $copyId;

  /**
   * Text displayed to prompt the user for feedback.
   */
  #[JsonProperty('initiate_feedback')]
  public ?string $initiateFeedback;

  /**
   * Text displayed to request additional feedback details.
   */
  #[JsonProperty('request_follow_up_feedback')]
  public ?string $requestFollowUpFeedback;

  /**
   * Text displayed to thank the user for providing feedback.
   */
  #[JsonProperty('thanks_for_feedback')]
  public ?string $thanksForFeedback;

  /**
   * Additional text displayed explaining the value of user feedback.
   */
  #[JsonProperty('thanks_for_feedback_details')]
  public ?string $thanksForFeedbackDetails;

  /**
   * Placeholder text for the follow-up feedback input field.
   */
  #[JsonProperty('follow_up_feedback_placeholder')]
  public ?string $followUpFeedbackPlaceholder;

  /**
   * Text and ARIA label for the submit button.
   */
  #[JsonProperty('submit')]
  public ?string $submit;

  /**
   * Text and ARIA label for the go back button.
   */
  #[JsonProperty('go_back')]
  public ?string $goBack;

  /**
   * Text and ARIA label for the send message button.
   */
  #[JsonProperty('send_message')]
  public ?string $sendMessage;

  /**
   * Text and ARIA label for the switch to text mode button.
   */
  #[JsonProperty('text_mode')]
  public ?string $textMode;

  /**
   * Text and ARIA label for the switch to voice mode button.
   */
  #[JsonProperty('voice_mode')]
  public ?string $voiceMode;

  /**
   * Toast notification displayed when switching to text mode.
   */
  #[JsonProperty('switched_to_text_mode')]
  public ?string $switchedToTextMode;

  /**
   * Toast notification displayed when switching to voice mode.
   */
  #[JsonProperty('switched_to_voice_mode')]
  public ?string $switchedToVoiceMode;

  /**
   * Text and ARIA label for the copy button.
   */
  #[JsonProperty('copy')]
  public ?string $copy;

  /**
   * Text and ARIA label for the download button.
   */
  #[JsonProperty('download')]
  public ?string $download;

  /**
   * Text and ARIA label for the wrap toggle button.
   */
  #[JsonProperty('wrap')]
  public ?string $wrap;

  /**
   * Status text displayed when the agent is processing a tool call.
   */
  #[JsonProperty('agent_working')]
  public ?string $agentWorking;

  /**
   * Status text displayed when the agent finishes processing a tool call.
   */
  #[JsonProperty('agent_done')]
  public ?string $agentDone;

  /**
   * Status text displayed when the agent encounters an error during a tool call.
   */
  #[JsonProperty('agent_error')]
  public ?string $agentError;

  /**
   * Text and ARIA label for the attach file button.
   */
  #[JsonProperty('attach_file')]
  public ?string $attachFile;

  /**
   * ARIA label for the remove file button.
   */
  #[JsonProperty('remove_file')]
  public ?string $removeFile;

  /**
   * Error message displayed when a file fails to upload.
   */
  #[JsonProperty('file_upload_error')]
  public ?string $fileUploadError;

  /**
   * Error message displayed when an unsupported file type is selected. Followed by the list of accepted types.
   */
  #[JsonProperty('file_type_unsupported')]
  public ?string $fileTypeUnsupported;

  /**
   * Error message displayed when a file exceeds the maximum size limit.
   */
  #[JsonProperty('file_too_large')]
  public ?string $fileTooLarge;

  /**
   * Error message displayed when the maximum number of files for a conversation is reached.
   */
  #[JsonProperty('file_limit_reached')]
  public ?string $fileLimitReached;

  /**
   * Status text displayed while the agent is typing.
   */
  #[JsonProperty('typing_indicator')]
  public ?string $typingIndicator;

  /**
   * Fallback message displayed when rich content cannot be rendered.
   */
  #[JsonProperty('rich_content_unavailable')]
  public ?string $richContentUnavailable;

  /**
   * @param array{
   *   mainLabel?: ?string,
   *   startCall?: ?string,
   *   startChat?: ?string,
   *   newCall?: ?string,
   *   endCall?: ?string,
   *   muteMicrophone?: ?string,
   *   changeLanguage?: ?string,
   *   collapse?: ?string,
   *   expand?: ?string,
   *   copied?: ?string,
   *   acceptTerms?: ?string,
   *   dismissTerms?: ?string,
   *   listeningStatus?: ?string,
   *   speakingStatus?: ?string,
   *   connectingStatus?: ?string,
   *   chattingStatus?: ?string,
   *   queueWaitingStatus?: ?string,
   *   queueWaitingStatusShort?: ?string,
   *   inputLabel?: ?string,
   *   inputPlaceholder?: ?string,
   *   inputPlaceholderTextOnly?: ?string,
   *   inputPlaceholderNewConversation?: ?string,
   *   userEndedConversation?: ?string,
   *   agentEndedConversation?: ?string,
   *   conversationId?: ?string,
   *   errorOccurred?: ?string,
   *   queueTimedOut?: ?string,
   *   copyId?: ?string,
   *   initiateFeedback?: ?string,
   *   requestFollowUpFeedback?: ?string,
   *   thanksForFeedback?: ?string,
   *   thanksForFeedbackDetails?: ?string,
   *   followUpFeedbackPlaceholder?: ?string,
   *   submit?: ?string,
   *   goBack?: ?string,
   *   sendMessage?: ?string,
   *   textMode?: ?string,
   *   voiceMode?: ?string,
   *   switchedToTextMode?: ?string,
   *   switchedToVoiceMode?: ?string,
   *   copy?: ?string,
   *   download?: ?string,
   *   wrap?: ?string,
   *   agentWorking?: ?string,
   *   agentDone?: ?string,
   *   agentError?: ?string,
   *   attachFile?: ?string,
   *   removeFile?: ?string,
   *   fileUploadError?: ?string,
   *   fileTypeUnsupported?: ?string,
   *   fileTooLarge?: ?string,
   *   fileLimitReached?: ?string,
   *   typingIndicator?: ?string,
   *   richContentUnavailable?: ?string,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->mainLabel = $values['mainLabel'] ?? null;
    $this->startCall = $values['startCall'] ?? null;
    $this->startChat = $values['startChat'] ?? null;
    $this->newCall = $values['newCall'] ?? null;
    $this->endCall = $values['endCall'] ?? null;
    $this->muteMicrophone = $values['muteMicrophone'] ?? null;
    $this->changeLanguage = $values['changeLanguage'] ?? null;
    $this->collapse = $values['collapse'] ?? null;
    $this->expand = $values['expand'] ?? null;
    $this->copied = $values['copied'] ?? null;
    $this->acceptTerms = $values['acceptTerms'] ?? null;
    $this->dismissTerms = $values['dismissTerms'] ?? null;
    $this->listeningStatus = $values['listeningStatus'] ?? null;
    $this->speakingStatus = $values['speakingStatus'] ?? null;
    $this->connectingStatus = $values['connectingStatus'] ?? null;
    $this->chattingStatus = $values['chattingStatus'] ?? null;
    $this->queueWaitingStatus = $values['queueWaitingStatus'] ?? null;
    $this->queueWaitingStatusShort = $values['queueWaitingStatusShort'] ?? null;
    $this->inputLabel = $values['inputLabel'] ?? null;
    $this->inputPlaceholder = $values['inputPlaceholder'] ?? null;
    $this->inputPlaceholderTextOnly = $values['inputPlaceholderTextOnly'] ?? null;
    $this->inputPlaceholderNewConversation = $values['inputPlaceholderNewConversation'] ?? null;
    $this->userEndedConversation = $values['userEndedConversation'] ?? null;
    $this->agentEndedConversation = $values['agentEndedConversation'] ?? null;
    $this->conversationId = $values['conversationId'] ?? null;
    $this->errorOccurred = $values['errorOccurred'] ?? null;
    $this->queueTimedOut = $values['queueTimedOut'] ?? null;
    $this->copyId = $values['copyId'] ?? null;
    $this->initiateFeedback = $values['initiateFeedback'] ?? null;
    $this->requestFollowUpFeedback = $values['requestFollowUpFeedback'] ?? null;
    $this->thanksForFeedback = $values['thanksForFeedback'] ?? null;
    $this->thanksForFeedbackDetails = $values['thanksForFeedbackDetails'] ?? null;
    $this->followUpFeedbackPlaceholder = $values['followUpFeedbackPlaceholder'] ?? null;
    $this->submit = $values['submit'] ?? null;
    $this->goBack = $values['goBack'] ?? null;
    $this->sendMessage = $values['sendMessage'] ?? null;
    $this->textMode = $values['textMode'] ?? null;
    $this->voiceMode = $values['voiceMode'] ?? null;
    $this->switchedToTextMode = $values['switchedToTextMode'] ?? null;
    $this->switchedToVoiceMode = $values['switchedToVoiceMode'] ?? null;
    $this->copy = $values['copy'] ?? null;
    $this->download = $values['download'] ?? null;
    $this->wrap = $values['wrap'] ?? null;
    $this->agentWorking = $values['agentWorking'] ?? null;
    $this->agentDone = $values['agentDone'] ?? null;
    $this->agentError = $values['agentError'] ?? null;
    $this->attachFile = $values['attachFile'] ?? null;
    $this->removeFile = $values['removeFile'] ?? null;
    $this->fileUploadError = $values['fileUploadError'] ?? null;
    $this->fileTypeUnsupported = $values['fileTypeUnsupported'] ?? null;
    $this->fileTooLarge = $values['fileTooLarge'] ?? null;
    $this->fileLimitReached = $values['fileLimitReached'] ?? null;
    $this->typingIndicator = $values['typingIndicator'] ?? null;
    $this->richContentUnavailable = $values['richContentUnavailable'] ?? null;

    if (array_key_exists('mainLabel', $values)) {
      $this->_dirtyFields['main_label'] = true;
    }
    if (array_key_exists('startCall', $values)) {
      $this->_dirtyFields['start_call'] = true;
    }
    if (array_key_exists('startChat', $values)) {
      $this->_dirtyFields['start_chat'] = true;
    }
    if (array_key_exists('newCall', $values)) {
      $this->_dirtyFields['new_call'] = true;
    }
    if (array_key_exists('endCall', $values)) {
      $this->_dirtyFields['end_call'] = true;
    }
    if (array_key_exists('muteMicrophone', $values)) {
      $this->_dirtyFields['mute_microphone'] = true;
    }
    if (array_key_exists('changeLanguage', $values)) {
      $this->_dirtyFields['change_language'] = true;
    }
    if (array_key_exists('collapse', $values)) {
      $this->_dirtyFields['collapse'] = true;
    }
    if (array_key_exists('expand', $values)) {
      $this->_dirtyFields['expand'] = true;
    }
    if (array_key_exists('copied', $values)) {
      $this->_dirtyFields['copied'] = true;
    }
    if (array_key_exists('acceptTerms', $values)) {
      $this->_dirtyFields['accept_terms'] = true;
    }
    if (array_key_exists('dismissTerms', $values)) {
      $this->_dirtyFields['dismiss_terms'] = true;
    }
    if (array_key_exists('listeningStatus', $values)) {
      $this->_dirtyFields['listening_status'] = true;
    }
    if (array_key_exists('speakingStatus', $values)) {
      $this->_dirtyFields['speaking_status'] = true;
    }
    if (array_key_exists('connectingStatus', $values)) {
      $this->_dirtyFields['connecting_status'] = true;
    }
    if (array_key_exists('chattingStatus', $values)) {
      $this->_dirtyFields['chatting_status'] = true;
    }
    if (array_key_exists('queueWaitingStatus', $values)) {
      $this->_dirtyFields['queue_waiting_status'] = true;
    }
    if (array_key_exists('queueWaitingStatusShort', $values)) {
      $this->_dirtyFields['queue_waiting_status_short'] = true;
    }
    if (array_key_exists('inputLabel', $values)) {
      $this->_dirtyFields['input_label'] = true;
    }
    if (array_key_exists('inputPlaceholder', $values)) {
      $this->_dirtyFields['input_placeholder'] = true;
    }
    if (array_key_exists('inputPlaceholderTextOnly', $values)) {
      $this->_dirtyFields['input_placeholder_text_only'] = true;
    }
    if (array_key_exists('inputPlaceholderNewConversation', $values)) {
      $this->_dirtyFields['input_placeholder_new_conversation'] = true;
    }
    if (array_key_exists('userEndedConversation', $values)) {
      $this->_dirtyFields['user_ended_conversation'] = true;
    }
    if (array_key_exists('agentEndedConversation', $values)) {
      $this->_dirtyFields['agent_ended_conversation'] = true;
    }
    if (array_key_exists('conversationId', $values)) {
      $this->_dirtyFields['conversation_id'] = true;
    }
    if (array_key_exists('errorOccurred', $values)) {
      $this->_dirtyFields['error_occurred'] = true;
    }
    if (array_key_exists('queueTimedOut', $values)) {
      $this->_dirtyFields['queue_timed_out'] = true;
    }
    if (array_key_exists('copyId', $values)) {
      $this->_dirtyFields['copy_id'] = true;
    }
    if (array_key_exists('initiateFeedback', $values)) {
      $this->_dirtyFields['initiate_feedback'] = true;
    }
    if (array_key_exists('requestFollowUpFeedback', $values)) {
      $this->_dirtyFields['request_follow_up_feedback'] = true;
    }
    if (array_key_exists('thanksForFeedback', $values)) {
      $this->_dirtyFields['thanks_for_feedback'] = true;
    }
    if (array_key_exists('thanksForFeedbackDetails', $values)) {
      $this->_dirtyFields['thanks_for_feedback_details'] = true;
    }
    if (array_key_exists('followUpFeedbackPlaceholder', $values)) {
      $this->_dirtyFields['follow_up_feedback_placeholder'] = true;
    }
    if (array_key_exists('submit', $values)) {
      $this->_dirtyFields['submit'] = true;
    }
    if (array_key_exists('goBack', $values)) {
      $this->_dirtyFields['go_back'] = true;
    }
    if (array_key_exists('sendMessage', $values)) {
      $this->_dirtyFields['send_message'] = true;
    }
    if (array_key_exists('textMode', $values)) {
      $this->_dirtyFields['text_mode'] = true;
    }
    if (array_key_exists('voiceMode', $values)) {
      $this->_dirtyFields['voice_mode'] = true;
    }
    if (array_key_exists('switchedToTextMode', $values)) {
      $this->_dirtyFields['switched_to_text_mode'] = true;
    }
    if (array_key_exists('switchedToVoiceMode', $values)) {
      $this->_dirtyFields['switched_to_voice_mode'] = true;
    }
    if (array_key_exists('copy', $values)) {
      $this->_dirtyFields['copy'] = true;
    }
    if (array_key_exists('download', $values)) {
      $this->_dirtyFields['download'] = true;
    }
    if (array_key_exists('wrap', $values)) {
      $this->_dirtyFields['wrap'] = true;
    }
    if (array_key_exists('agentWorking', $values)) {
      $this->_dirtyFields['agent_working'] = true;
    }
    if (array_key_exists('agentDone', $values)) {
      $this->_dirtyFields['agent_done'] = true;
    }
    if (array_key_exists('agentError', $values)) {
      $this->_dirtyFields['agent_error'] = true;
    }
    if (array_key_exists('attachFile', $values)) {
      $this->_dirtyFields['attach_file'] = true;
    }
    if (array_key_exists('removeFile', $values)) {
      $this->_dirtyFields['remove_file'] = true;
    }
    if (array_key_exists('fileUploadError', $values)) {
      $this->_dirtyFields['file_upload_error'] = true;
    }
    if (array_key_exists('fileTypeUnsupported', $values)) {
      $this->_dirtyFields['file_type_unsupported'] = true;
    }
    if (array_key_exists('fileTooLarge', $values)) {
      $this->_dirtyFields['file_too_large'] = true;
    }
    if (array_key_exists('fileLimitReached', $values)) {
      $this->_dirtyFields['file_limit_reached'] = true;
    }
    if (array_key_exists('typingIndicator', $values)) {
      $this->_dirtyFields['typing_indicator'] = true;
    }
    if (array_key_exists('richContentUnavailable', $values)) {
      $this->_dirtyFields['rich_content_unavailable'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->mainLabel !== null) {
      $parts[] = [
        'name' => 'main_label',
        'contents' => $this->mainLabel
      ];
    }

    if ($this->startCall !== null) {
      $parts[] = [
        'name' => 'start_call',
        'contents' => $this->startCall
      ];
    }

    if ($this->startChat !== null) {
      $parts[] = [
        'name' => 'start_chat',
        'contents' => $this->startChat
      ];
    }

    if ($this->newCall !== null) {
      $parts[] = [
        'name' => 'new_call',
        'contents' => $this->newCall
      ];
    }

    if ($this->endCall !== null) {
      $parts[] = [
        'name' => 'end_call',
        'contents' => $this->endCall
      ];
    }

    if ($this->muteMicrophone !== null) {
      $parts[] = [
        'name' => 'mute_microphone',
        'contents' => $this->muteMicrophone
      ];
    }

    if ($this->changeLanguage !== null) {
      $parts[] = [
        'name' => 'change_language',
        'contents' => $this->changeLanguage
      ];
    }

    if ($this->collapse !== null) {
      $parts[] = [
        'name' => 'collapse',
        'contents' => $this->collapse
      ];
    }

    if ($this->expand !== null) {
      $parts[] = [
        'name' => 'expand',
        'contents' => $this->expand
      ];
    }

    if ($this->copied !== null) {
      $parts[] = [
        'name' => 'copied',
        'contents' => $this->copied
      ];
    }

    if ($this->acceptTerms !== null) {
      $parts[] = [
        'name' => 'accept_terms',
        'contents' => $this->acceptTerms
      ];
    }

    if ($this->dismissTerms !== null) {
      $parts[] = [
        'name' => 'dismiss_terms',
        'contents' => $this->dismissTerms
      ];
    }

    if ($this->listeningStatus !== null) {
      $parts[] = [
        'name' => 'listening_status',
        'contents' => $this->listeningStatus
      ];
    }

    if ($this->speakingStatus !== null) {
      $parts[] = [
        'name' => 'speaking_status',
        'contents' => $this->speakingStatus
      ];
    }

    if ($this->connectingStatus !== null) {
      $parts[] = [
        'name' => 'connecting_status',
        'contents' => $this->connectingStatus
      ];
    }

    if ($this->chattingStatus !== null) {
      $parts[] = [
        'name' => 'chatting_status',
        'contents' => $this->chattingStatus
      ];
    }

    if ($this->queueWaitingStatus !== null) {
      $parts[] = [
        'name' => 'queue_waiting_status',
        'contents' => $this->queueWaitingStatus
      ];
    }

    if ($this->queueWaitingStatusShort !== null) {
      $parts[] = [
        'name' => 'queue_waiting_status_short',
        'contents' => $this->queueWaitingStatusShort
      ];
    }

    if ($this->inputLabel !== null) {
      $parts[] = [
        'name' => 'input_label',
        'contents' => $this->inputLabel
      ];
    }

    if ($this->inputPlaceholder !== null) {
      $parts[] = [
        'name' => 'input_placeholder',
        'contents' => $this->inputPlaceholder
      ];
    }

    if ($this->inputPlaceholderTextOnly !== null) {
      $parts[] = [
        'name' => 'input_placeholder_text_only',
        'contents' => $this->inputPlaceholderTextOnly
      ];
    }

    if ($this->inputPlaceholderNewConversation !== null) {
      $parts[] = [
        'name' => 'input_placeholder_new_conversation',
        'contents' => $this->inputPlaceholderNewConversation
      ];
    }

    if ($this->userEndedConversation !== null) {
      $parts[] = [
        'name' => 'user_ended_conversation',
        'contents' => $this->userEndedConversation
      ];
    }

    if ($this->agentEndedConversation !== null) {
      $parts[] = [
        'name' => 'agent_ended_conversation',
        'contents' => $this->agentEndedConversation
      ];
    }

    if ($this->conversationId !== null) {
      $parts[] = [
        'name' => 'conversation_id',
        'contents' => $this->conversationId
      ];
    }

    if ($this->errorOccurred !== null) {
      $parts[] = [
        'name' => 'error_occurred',
        'contents' => $this->errorOccurred
      ];
    }

    if ($this->queueTimedOut !== null) {
      $parts[] = [
        'name' => 'queue_timed_out',
        'contents' => $this->queueTimedOut
      ];
    }

    if ($this->copyId !== null) {
      $parts[] = [
        'name' => 'copy_id',
        'contents' => $this->copyId
      ];
    }

    if ($this->initiateFeedback !== null) {
      $parts[] = [
        'name' => 'initiate_feedback',
        'contents' => $this->initiateFeedback
      ];
    }

    if ($this->requestFollowUpFeedback !== null) {
      $parts[] = [
        'name' => 'request_follow_up_feedback',
        'contents' => $this->requestFollowUpFeedback
      ];
    }

    if ($this->thanksForFeedback !== null) {
      $parts[] = [
        'name' => 'thanks_for_feedback',
        'contents' => $this->thanksForFeedback
      ];
    }

    if ($this->thanksForFeedbackDetails !== null) {
      $parts[] = [
        'name' => 'thanks_for_feedback_details',
        'contents' => $this->thanksForFeedbackDetails
      ];
    }

    if ($this->followUpFeedbackPlaceholder !== null) {
      $parts[] = [
        'name' => 'follow_up_feedback_placeholder',
        'contents' => $this->followUpFeedbackPlaceholder
      ];
    }

    if ($this->submit !== null) {
      $parts[] = [
        'name' => 'submit',
        'contents' => $this->submit
      ];
    }

    if ($this->goBack !== null) {
      $parts[] = [
        'name' => 'go_back',
        'contents' => $this->goBack
      ];
    }

    if ($this->sendMessage !== null) {
      $parts[] = [
        'name' => 'send_message',
        'contents' => $this->sendMessage
      ];
    }

    if ($this->textMode !== null) {
      $parts[] = [
        'name' => 'text_mode',
        'contents' => $this->textMode
      ];
    }

    if ($this->voiceMode !== null) {
      $parts[] = [
        'name' => 'voice_mode',
        'contents' => $this->voiceMode
      ];
    }

    if ($this->switchedToTextMode !== null) {
      $parts[] = [
        'name' => 'switched_to_text_mode',
        'contents' => $this->switchedToTextMode
      ];
    }

    if ($this->switchedToVoiceMode !== null) {
      $parts[] = [
        'name' => 'switched_to_voice_mode',
        'contents' => $this->switchedToVoiceMode
      ];
    }

    if ($this->copy !== null) {
      $parts[] = [
        'name' => 'copy',
        'contents' => $this->copy
      ];
    }

    if ($this->download !== null) {
      $parts[] = [
        'name' => 'download',
        'contents' => $this->download
      ];
    }

    if ($this->wrap !== null) {
      $parts[] = [
        'name' => 'wrap',
        'contents' => $this->wrap
      ];
    }

    if ($this->agentWorking !== null) {
      $parts[] = [
        'name' => 'agent_working',
        'contents' => $this->agentWorking
      ];
    }

    if ($this->agentDone !== null) {
      $parts[] = [
        'name' => 'agent_done',
        'contents' => $this->agentDone
      ];
    }

    if ($this->agentError !== null) {
      $parts[] = [
        'name' => 'agent_error',
        'contents' => $this->agentError
      ];
    }

    if ($this->attachFile !== null) {
      $parts[] = [
        'name' => 'attach_file',
        'contents' => $this->attachFile
      ];
    }

    if ($this->removeFile !== null) {
      $parts[] = [
        'name' => 'remove_file',
        'contents' => $this->removeFile
      ];
    }

    if ($this->fileUploadError !== null) {
      $parts[] = [
        'name' => 'file_upload_error',
        'contents' => $this->fileUploadError
      ];
    }

    if ($this->fileTypeUnsupported !== null) {
      $parts[] = [
        'name' => 'file_type_unsupported',
        'contents' => $this->fileTypeUnsupported
      ];
    }

    if ($this->fileTooLarge !== null) {
      $parts[] = [
        'name' => 'file_too_large',
        'contents' => $this->fileTooLarge
      ];
    }

    if ($this->fileLimitReached !== null) {
      $parts[] = [
        'name' => 'file_limit_reached',
        'contents' => $this->fileLimitReached
      ];
    }

    if ($this->typingIndicator !== null) {
      $parts[] = [
        'name' => 'typing_indicator',
        'contents' => $this->typingIndicator
      ];
    }

    if ($this->richContentUnavailable !== null) {
      $parts[] = [
        'name' => 'rich_content_unavailable',
        'contents' => $this->richContentUnavailable
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
  }
}
