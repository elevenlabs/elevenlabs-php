<?php

declare(strict_types=1);

namespace ElevenLabs\Types;

use ElevenLabs\Core\Json\JsonSerializableType;
use ElevenLabs\Core\Json\ReflectiveSerialization;
use ElevenLabs\Core\Json\JsonProperty;
use ElevenLabs\Core\Types\ArrayType;

/**
 * The reflective deserializer reconstructs this model with `new static($values)`, so a subclass has
 * to keep a constructor it can call with one associative array.
 *
 * @phpstan-consistent-constructor
 */
class WidgetConfig extends JsonSerializableType
{
  use ReflectiveSerialization;

  /**
   * @var ?value-of<\ElevenLabs\Types\EmbedVariant>
   */
  #[JsonProperty('variant')]
  public ?string $variant;

  /**
   * @var ?value-of<\ElevenLabs\Types\WidgetPlacement>
   */
  #[JsonProperty('placement')]
  public ?string $placement;

  /**
   * @var ?value-of<\ElevenLabs\Types\WidgetExpandable>
   */
  #[JsonProperty('expandable')]
  public ?string $expandable;

  /**
   * The avatar of the widget
   */
  #[JsonProperty('avatar')]
  public ?\ElevenLabs\Types\WidgetConfigAvatar $avatar;

  /**
   * @var ?value-of<\ElevenLabs\Types\WidgetFeedbackMode>
   */
  #[JsonProperty('feedback_mode')]
  public ?string $feedbackMode;

  /**
   * Configuration for feedback collected at the end of the conversation
   */
  #[JsonProperty('end_feedback')]
  public ?\ElevenLabs\Types\WidgetEndFeedbackConfig $endFeedback;

  /**
   * The background color of the widget
   */
  #[JsonProperty('bg_color')]
  public ?string $bgColor;

  /**
   * The text color of the widget
   */
  #[JsonProperty('text_color')]
  public ?string $textColor;

  /**
   * The button color of the widget
   */
  #[JsonProperty('btn_color')]
  public ?string $btnColor;

  /**
   * The button text color of the widget
   */
  #[JsonProperty('btn_text_color')]
  public ?string $btnTextColor;

  /**
   * The border color of the widget
   */
  #[JsonProperty('border_color')]
  public ?string $borderColor;

  /**
   * The focus color of the widget
   */
  #[JsonProperty('focus_color')]
  public ?string $focusColor;

  /**
   * The border radius of the widget
   */
  #[JsonProperty('border_radius')]
  public ?int $borderRadius;

  /**
   * The button radius of the widget
   */
  #[JsonProperty('btn_radius')]
  public ?int $btnRadius;

  /**
   * The action text of the widget
   */
  #[JsonProperty('action_text')]
  public ?string $actionText;

  /**
   * The start call text of the widget
   */
  #[JsonProperty('start_call_text')]
  public ?string $startCallText;

  /**
   * The end call text of the widget
   */
  #[JsonProperty('end_call_text')]
  public ?string $endCallText;

  /**
   * The expand text of the widget
   */
  #[JsonProperty('expand_text')]
  public ?string $expandText;

  /**
   * The text to display when the agent is listening
   */
  #[JsonProperty('listening_text')]
  public ?string $listeningText;

  /**
   * The text to display when the agent is speaking
   */
  #[JsonProperty('speaking_text')]
  public ?string $speakingText;

  /**
   * The text to display when sharing
   */
  #[JsonProperty('shareable_page_text')]
  public ?string $shareablePageText;

  /**
   * Whether to show terms and conditions on the shareable page
   */
  #[JsonProperty('shareable_page_show_terms')]
  public ?bool $shareablePageShowTerms;

  /**
   * The text to display for terms and conditions
   */
  #[JsonProperty('terms_text')]
  public ?string $termsText;

  /**
   * The HTML to display for terms and conditions
   */
  #[JsonProperty('terms_html')]
  public ?string $termsHtml;

  /**
   * The key to display for terms and conditions
   */
  #[JsonProperty('terms_key')]
  public ?string $termsKey;

  /**
   * Whether to show the avatar when the widget is collapsed
   */
  #[JsonProperty('show_avatar_when_collapsed')]
  public ?bool $showAvatarWhenCollapsed;

  /**
   * Whether to disable the banner
   */
  #[JsonProperty('disable_banner')]
  public ?bool $disableBanner;

  /**
   * The override link for the widget
   */
  #[JsonProperty('override_link')]
  public ?string $overrideLink;

  /**
   * @var \ElevenLabs\Types\AllowlistItem[]|null
   * List of allowed hostnames for clickable markdown links. Use { hostname: '*' } to allow any domain. Empty means no links are allowed.
   */
  #[
    JsonProperty('markdown_link_allowed_hosts'),
    ArrayType([\ElevenLabs\Types\AllowlistItem::class])
  ]
  public ?array $markdownLinkAllowedHosts;

  /**
   * Whether to automatically include www. variants of allowed hosts
   */
  #[JsonProperty('markdown_link_include_www')]
  public ?bool $markdownLinkIncludeWww;

  /**
   * Whether to allow http:// in addition to https:// for allowed hosts
   */
  #[JsonProperty('markdown_link_allow_http')]
  public ?bool $markdownLinkAllowHttp;

  /**
   * Whether to enable mic muting
   */
  #[JsonProperty('mic_muting_enabled')]
  public ?bool $micMutingEnabled;

  /**
   * Whether the widget should show the conversation transcript as it goes on
   */
  #[JsonProperty('transcript_enabled')]
  public ?bool $transcriptEnabled;

  /**
   * Whether the user should be able to send text messages
   */
  #[JsonProperty('text_input_enabled')]
  public ?bool $textInputEnabled;

  /**
   * Whether to enable the conversation mode toggle in the widget
   */
  #[JsonProperty('conversation_mode_toggle_enabled')]
  public ?bool $conversationModeToggleEnabled;

  /**
   * Whether the widget should be expanded by default
   */
  #[JsonProperty('default_expanded')]
  public ?bool $defaultExpanded;

  /**
   * Whether the widget should always be expanded
   */
  #[JsonProperty('always_expanded')]
  public ?bool $alwaysExpanded;

  /**
   * Whether the widget can be dismissed by the user
   */
  #[JsonProperty('dismissible')]
  public ?bool $dismissible;

  /**
   * Whether to show agent working/done/error status during tool use
   */
  #[JsonProperty('show_agent_status')]
  public ?bool $showAgentStatus;

  /**
   * Whether to show the conversation ID after disconnection.
   */
  #[JsonProperty('show_conversation_id')]
  public ?bool $showConversationId;

  /**
   * Whether to strip audio markup from messages.
   */
  #[JsonProperty('strip_audio_tags')]
  public ?bool $stripAudioTags;

  /**
   * @var ?value-of<\ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme>
   * Theme for code block syntax highlighting. Defaults to auto-detection by the widget when not set.
   */
  #[JsonProperty('syntax_highlight_theme')]
  public ?string $syntaxHighlightTheme;

  #[JsonProperty('text_contents')]
  public ?\ElevenLabs\Types\WidgetTextContents $textContents;

  #[JsonProperty('styles')]
  public ?\ElevenLabs\Types\WidgetStyles $styles;

  /**
   * Whether to show the resize button
   */
  #[JsonProperty('show_resize_button')]
  public ?bool $showResizeButton;

  /**
   * Whether to ask the user to confirm before ending a chat or call
   */
  #[JsonProperty('end_confirmation_enabled')]
  public ?bool $endConfirmationEnabled;

  /**
   * Whether the widget opens fullscreen on mobile
   */
  #[JsonProperty('mobile_fullscreen')]
  public ?bool $mobileFullscreen;

  /**
   * Whether voice call transcripts are revealed as the agent speaks
   */
  #[JsonProperty('transcript_speech_sync_enabled')]
  public ?bool $transcriptSpeechSyncEnabled;

  /**
   * Whether to show the language selector
   */
  #[JsonProperty('language_selector')]
  public ?bool $languageSelector;

  /**
   * Whether the widget can switch to text only mode
   */
  #[JsonProperty('supports_text_only')]
  public ?bool $supportsTextOnly;

  /**
   * The custom avatar path
   */
  #[JsonProperty('custom_avatar_path')]
  public ?string $customAvatarPath;

  /**
   * @var array<string, \ElevenLabs\Types\WidgetLanguagePreset>|null
   * Language presets for the widget
   */
  #[
    JsonProperty('language_presets'),
    ArrayType(['string' => \ElevenLabs\Types\WidgetLanguagePreset::class])
  ]
  public ?array $languagePresets;

  /**
   * @param array{
   *   variant?: ?value-of<\ElevenLabs\Types\EmbedVariant>,
   *   placement?: ?value-of<\ElevenLabs\Types\WidgetPlacement>,
   *   expandable?: ?value-of<\ElevenLabs\Types\WidgetExpandable>,
   *   avatar?: ?\ElevenLabs\Types\WidgetConfigAvatar,
   *   feedbackMode?: ?value-of<\ElevenLabs\Types\WidgetFeedbackMode>,
   *   endFeedback?: ?\ElevenLabs\Types\WidgetEndFeedbackConfig,
   *   bgColor?: ?string,
   *   textColor?: ?string,
   *   btnColor?: ?string,
   *   btnTextColor?: ?string,
   *   borderColor?: ?string,
   *   focusColor?: ?string,
   *   borderRadius?: ?int,
   *   btnRadius?: ?int,
   *   actionText?: ?string,
   *   startCallText?: ?string,
   *   endCallText?: ?string,
   *   expandText?: ?string,
   *   listeningText?: ?string,
   *   speakingText?: ?string,
   *   shareablePageText?: ?string,
   *   shareablePageShowTerms?: ?bool,
   *   termsText?: ?string,
   *   termsHtml?: ?string,
   *   termsKey?: ?string,
   *   showAvatarWhenCollapsed?: ?bool,
   *   disableBanner?: ?bool,
   *   overrideLink?: ?string,
   *   markdownLinkAllowedHosts?: \ElevenLabs\Types\AllowlistItem[]|null,
   *   markdownLinkIncludeWww?: ?bool,
   *   markdownLinkAllowHttp?: ?bool,
   *   micMutingEnabled?: ?bool,
   *   transcriptEnabled?: ?bool,
   *   textInputEnabled?: ?bool,
   *   conversationModeToggleEnabled?: ?bool,
   *   defaultExpanded?: ?bool,
   *   alwaysExpanded?: ?bool,
   *   dismissible?: ?bool,
   *   showAgentStatus?: ?bool,
   *   showConversationId?: ?bool,
   *   stripAudioTags?: ?bool,
   *   syntaxHighlightTheme?: ?value-of<\ElevenLabs\Types\WidgetConfigSyntaxHighlightTheme>,
   *   textContents?: ?\ElevenLabs\Types\WidgetTextContents,
   *   styles?: ?\ElevenLabs\Types\WidgetStyles,
   *   showResizeButton?: ?bool,
   *   endConfirmationEnabled?: ?bool,
   *   mobileFullscreen?: ?bool,
   *   transcriptSpeechSyncEnabled?: ?bool,
   *   languageSelector?: ?bool,
   *   supportsTextOnly?: ?bool,
   *   customAvatarPath?: ?string,
   *   languagePresets?: array<string, \ElevenLabs\Types\WidgetLanguagePreset>|null,
   * } $values
   */
  public function __construct(array $values = [])
  {
    $this->variant = $values['variant'] ?? null;
    $this->placement = $values['placement'] ?? null;
    $this->expandable = $values['expandable'] ?? null;
    $this->avatar = $values['avatar'] ?? null;
    $this->feedbackMode = $values['feedbackMode'] ?? null;
    $this->endFeedback = $values['endFeedback'] ?? null;
    $this->bgColor = $values['bgColor'] ?? null;
    $this->textColor = $values['textColor'] ?? null;
    $this->btnColor = $values['btnColor'] ?? null;
    $this->btnTextColor = $values['btnTextColor'] ?? null;
    $this->borderColor = $values['borderColor'] ?? null;
    $this->focusColor = $values['focusColor'] ?? null;
    $this->borderRadius = $values['borderRadius'] ?? null;
    $this->btnRadius = $values['btnRadius'] ?? null;
    $this->actionText = $values['actionText'] ?? null;
    $this->startCallText = $values['startCallText'] ?? null;
    $this->endCallText = $values['endCallText'] ?? null;
    $this->expandText = $values['expandText'] ?? null;
    $this->listeningText = $values['listeningText'] ?? null;
    $this->speakingText = $values['speakingText'] ?? null;
    $this->shareablePageText = $values['shareablePageText'] ?? null;
    $this->shareablePageShowTerms = $values['shareablePageShowTerms'] ?? null;
    $this->termsText = $values['termsText'] ?? null;
    $this->termsHtml = $values['termsHtml'] ?? null;
    $this->termsKey = $values['termsKey'] ?? null;
    $this->showAvatarWhenCollapsed = $values['showAvatarWhenCollapsed'] ?? null;
    $this->disableBanner = $values['disableBanner'] ?? null;
    $this->overrideLink = $values['overrideLink'] ?? null;
    $this->markdownLinkAllowedHosts = $values['markdownLinkAllowedHosts'] ?? null;
    $this->markdownLinkIncludeWww = $values['markdownLinkIncludeWww'] ?? null;
    $this->markdownLinkAllowHttp = $values['markdownLinkAllowHttp'] ?? null;
    $this->micMutingEnabled = $values['micMutingEnabled'] ?? null;
    $this->transcriptEnabled = $values['transcriptEnabled'] ?? null;
    $this->textInputEnabled = $values['textInputEnabled'] ?? null;
    $this->conversationModeToggleEnabled = $values['conversationModeToggleEnabled'] ?? null;
    $this->defaultExpanded = $values['defaultExpanded'] ?? null;
    $this->alwaysExpanded = $values['alwaysExpanded'] ?? null;
    $this->dismissible = $values['dismissible'] ?? null;
    $this->showAgentStatus = $values['showAgentStatus'] ?? null;
    $this->showConversationId = $values['showConversationId'] ?? null;
    $this->stripAudioTags = $values['stripAudioTags'] ?? null;
    $this->syntaxHighlightTheme = $values['syntaxHighlightTheme'] ?? null;
    $this->textContents = $values['textContents'] ?? null;
    $this->styles = $values['styles'] ?? null;
    $this->showResizeButton = $values['showResizeButton'] ?? null;
    $this->endConfirmationEnabled = $values['endConfirmationEnabled'] ?? null;
    $this->mobileFullscreen = $values['mobileFullscreen'] ?? null;
    $this->transcriptSpeechSyncEnabled = $values['transcriptSpeechSyncEnabled'] ?? null;
    $this->languageSelector = $values['languageSelector'] ?? null;
    $this->supportsTextOnly = $values['supportsTextOnly'] ?? null;
    $this->customAvatarPath = $values['customAvatarPath'] ?? null;
    $this->languagePresets = $values['languagePresets'] ?? null;

    if (array_key_exists('variant', $values)) {
      $this->_dirtyFields['variant'] = true;
    }
    if (array_key_exists('placement', $values)) {
      $this->_dirtyFields['placement'] = true;
    }
    if (array_key_exists('expandable', $values)) {
      $this->_dirtyFields['expandable'] = true;
    }
    if (array_key_exists('avatar', $values)) {
      $this->_dirtyFields['avatar'] = true;
    }
    if (array_key_exists('feedbackMode', $values)) {
      $this->_dirtyFields['feedback_mode'] = true;
    }
    if (array_key_exists('endFeedback', $values)) {
      $this->_dirtyFields['end_feedback'] = true;
    }
    if (array_key_exists('bgColor', $values)) {
      $this->_dirtyFields['bg_color'] = true;
    }
    if (array_key_exists('textColor', $values)) {
      $this->_dirtyFields['text_color'] = true;
    }
    if (array_key_exists('btnColor', $values)) {
      $this->_dirtyFields['btn_color'] = true;
    }
    if (array_key_exists('btnTextColor', $values)) {
      $this->_dirtyFields['btn_text_color'] = true;
    }
    if (array_key_exists('borderColor', $values)) {
      $this->_dirtyFields['border_color'] = true;
    }
    if (array_key_exists('focusColor', $values)) {
      $this->_dirtyFields['focus_color'] = true;
    }
    if (array_key_exists('borderRadius', $values)) {
      $this->_dirtyFields['border_radius'] = true;
    }
    if (array_key_exists('btnRadius', $values)) {
      $this->_dirtyFields['btn_radius'] = true;
    }
    if (array_key_exists('actionText', $values)) {
      $this->_dirtyFields['action_text'] = true;
    }
    if (array_key_exists('startCallText', $values)) {
      $this->_dirtyFields['start_call_text'] = true;
    }
    if (array_key_exists('endCallText', $values)) {
      $this->_dirtyFields['end_call_text'] = true;
    }
    if (array_key_exists('expandText', $values)) {
      $this->_dirtyFields['expand_text'] = true;
    }
    if (array_key_exists('listeningText', $values)) {
      $this->_dirtyFields['listening_text'] = true;
    }
    if (array_key_exists('speakingText', $values)) {
      $this->_dirtyFields['speaking_text'] = true;
    }
    if (array_key_exists('shareablePageText', $values)) {
      $this->_dirtyFields['shareable_page_text'] = true;
    }
    if (array_key_exists('shareablePageShowTerms', $values)) {
      $this->_dirtyFields['shareable_page_show_terms'] = true;
    }
    if (array_key_exists('termsText', $values)) {
      $this->_dirtyFields['terms_text'] = true;
    }
    if (array_key_exists('termsHtml', $values)) {
      $this->_dirtyFields['terms_html'] = true;
    }
    if (array_key_exists('termsKey', $values)) {
      $this->_dirtyFields['terms_key'] = true;
    }
    if (array_key_exists('showAvatarWhenCollapsed', $values)) {
      $this->_dirtyFields['show_avatar_when_collapsed'] = true;
    }
    if (array_key_exists('disableBanner', $values)) {
      $this->_dirtyFields['disable_banner'] = true;
    }
    if (array_key_exists('overrideLink', $values)) {
      $this->_dirtyFields['override_link'] = true;
    }
    if (array_key_exists('markdownLinkAllowedHosts', $values)) {
      $this->_dirtyFields['markdown_link_allowed_hosts'] = true;
    }
    if (array_key_exists('markdownLinkIncludeWww', $values)) {
      $this->_dirtyFields['markdown_link_include_www'] = true;
    }
    if (array_key_exists('markdownLinkAllowHttp', $values)) {
      $this->_dirtyFields['markdown_link_allow_http'] = true;
    }
    if (array_key_exists('micMutingEnabled', $values)) {
      $this->_dirtyFields['mic_muting_enabled'] = true;
    }
    if (array_key_exists('transcriptEnabled', $values)) {
      $this->_dirtyFields['transcript_enabled'] = true;
    }
    if (array_key_exists('textInputEnabled', $values)) {
      $this->_dirtyFields['text_input_enabled'] = true;
    }
    if (array_key_exists('conversationModeToggleEnabled', $values)) {
      $this->_dirtyFields['conversation_mode_toggle_enabled'] = true;
    }
    if (array_key_exists('defaultExpanded', $values)) {
      $this->_dirtyFields['default_expanded'] = true;
    }
    if (array_key_exists('alwaysExpanded', $values)) {
      $this->_dirtyFields['always_expanded'] = true;
    }
    if (array_key_exists('dismissible', $values)) {
      $this->_dirtyFields['dismissible'] = true;
    }
    if (array_key_exists('showAgentStatus', $values)) {
      $this->_dirtyFields['show_agent_status'] = true;
    }
    if (array_key_exists('showConversationId', $values)) {
      $this->_dirtyFields['show_conversation_id'] = true;
    }
    if (array_key_exists('stripAudioTags', $values)) {
      $this->_dirtyFields['strip_audio_tags'] = true;
    }
    if (array_key_exists('syntaxHighlightTheme', $values)) {
      $this->_dirtyFields['syntax_highlight_theme'] = true;
    }
    if (array_key_exists('textContents', $values)) {
      $this->_dirtyFields['text_contents'] = true;
    }
    if (array_key_exists('styles', $values)) {
      $this->_dirtyFields['styles'] = true;
    }
    if (array_key_exists('showResizeButton', $values)) {
      $this->_dirtyFields['show_resize_button'] = true;
    }
    if (array_key_exists('endConfirmationEnabled', $values)) {
      $this->_dirtyFields['end_confirmation_enabled'] = true;
    }
    if (array_key_exists('mobileFullscreen', $values)) {
      $this->_dirtyFields['mobile_fullscreen'] = true;
    }
    if (array_key_exists('transcriptSpeechSyncEnabled', $values)) {
      $this->_dirtyFields['transcript_speech_sync_enabled'] = true;
    }
    if (array_key_exists('languageSelector', $values)) {
      $this->_dirtyFields['language_selector'] = true;
    }
    if (array_key_exists('supportsTextOnly', $values)) {
      $this->_dirtyFields['supports_text_only'] = true;
    }
    if (array_key_exists('customAvatarPath', $values)) {
      $this->_dirtyFields['custom_avatar_path'] = true;
    }
    if (array_key_exists('languagePresets', $values)) {
      $this->_dirtyFields['language_presets'] = true;
    }
  }

  public function toMultipart(): array
  {
    $parts = [];
    if ($this->variant !== null) {
      $parts[] = [
        'name' => 'variant',
        'contents' => $this->variant
      ];
    }

    if ($this->placement !== null) {
      $parts[] = [
        'name' => 'placement',
        'contents' => $this->placement
      ];
    }

    if ($this->expandable !== null) {
      $parts[] = [
        'name' => 'expandable',
        'contents' => $this->expandable
      ];
    }

    if ($this->avatar !== null) {
      $parts[] = [
        'name' => 'avatar',
        'contents' => json_encode($this->avatar),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->feedbackMode !== null) {
      $parts[] = [
        'name' => 'feedback_mode',
        'contents' => $this->feedbackMode
      ];
    }

    if ($this->endFeedback !== null) {
      $parts[] = [
        'name' => 'end_feedback',
        'contents' => json_encode($this->endFeedback),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->bgColor !== null) {
      $parts[] = [
        'name' => 'bg_color',
        'contents' => $this->bgColor
      ];
    }

    if ($this->textColor !== null) {
      $parts[] = [
        'name' => 'text_color',
        'contents' => $this->textColor
      ];
    }

    if ($this->btnColor !== null) {
      $parts[] = [
        'name' => 'btn_color',
        'contents' => $this->btnColor
      ];
    }

    if ($this->btnTextColor !== null) {
      $parts[] = [
        'name' => 'btn_text_color',
        'contents' => $this->btnTextColor
      ];
    }

    if ($this->borderColor !== null) {
      $parts[] = [
        'name' => 'border_color',
        'contents' => $this->borderColor
      ];
    }

    if ($this->focusColor !== null) {
      $parts[] = [
        'name' => 'focus_color',
        'contents' => $this->focusColor
      ];
    }

    if ($this->borderRadius !== null) {
      $parts[] = [
        'name' => 'border_radius',
        'contents' => (string) $this->borderRadius
      ];
    }

    if ($this->btnRadius !== null) {
      $parts[] = [
        'name' => 'btn_radius',
        'contents' => (string) $this->btnRadius
      ];
    }

    if ($this->actionText !== null) {
      $parts[] = [
        'name' => 'action_text',
        'contents' => $this->actionText
      ];
    }

    if ($this->startCallText !== null) {
      $parts[] = [
        'name' => 'start_call_text',
        'contents' => $this->startCallText
      ];
    }

    if ($this->endCallText !== null) {
      $parts[] = [
        'name' => 'end_call_text',
        'contents' => $this->endCallText
      ];
    }

    if ($this->expandText !== null) {
      $parts[] = [
        'name' => 'expand_text',
        'contents' => $this->expandText
      ];
    }

    if ($this->listeningText !== null) {
      $parts[] = [
        'name' => 'listening_text',
        'contents' => $this->listeningText
      ];
    }

    if ($this->speakingText !== null) {
      $parts[] = [
        'name' => 'speaking_text',
        'contents' => $this->speakingText
      ];
    }

    if ($this->shareablePageText !== null) {
      $parts[] = [
        'name' => 'shareable_page_text',
        'contents' => $this->shareablePageText
      ];
    }

    if ($this->shareablePageShowTerms !== null) {
      $parts[] = [
        'name' => 'shareable_page_show_terms',
        'contents' => $this->shareablePageShowTerms ? 'true' : 'false'
      ];
    }

    if ($this->termsText !== null) {
      $parts[] = [
        'name' => 'terms_text',
        'contents' => $this->termsText
      ];
    }

    if ($this->termsHtml !== null) {
      $parts[] = [
        'name' => 'terms_html',
        'contents' => $this->termsHtml
      ];
    }

    if ($this->termsKey !== null) {
      $parts[] = [
        'name' => 'terms_key',
        'contents' => $this->termsKey
      ];
    }

    if ($this->showAvatarWhenCollapsed !== null) {
      $parts[] = [
        'name' => 'show_avatar_when_collapsed',
        'contents' => $this->showAvatarWhenCollapsed ? 'true' : 'false'
      ];
    }

    if ($this->disableBanner !== null) {
      $parts[] = [
        'name' => 'disable_banner',
        'contents' => $this->disableBanner ? 'true' : 'false'
      ];
    }

    if ($this->overrideLink !== null) {
      $parts[] = [
        'name' => 'override_link',
        'contents' => $this->overrideLink
      ];
    }

    if ($this->markdownLinkAllowedHosts !== null) {
      $parts[] = [
        'name' => 'markdown_link_allowed_hosts',
        'contents' => json_encode($this->markdownLinkAllowedHosts),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->markdownLinkIncludeWww !== null) {
      $parts[] = [
        'name' => 'markdown_link_include_www',
        'contents' => $this->markdownLinkIncludeWww ? 'true' : 'false'
      ];
    }

    if ($this->markdownLinkAllowHttp !== null) {
      $parts[] = [
        'name' => 'markdown_link_allow_http',
        'contents' => $this->markdownLinkAllowHttp ? 'true' : 'false'
      ];
    }

    if ($this->micMutingEnabled !== null) {
      $parts[] = [
        'name' => 'mic_muting_enabled',
        'contents' => $this->micMutingEnabled ? 'true' : 'false'
      ];
    }

    if ($this->transcriptEnabled !== null) {
      $parts[] = [
        'name' => 'transcript_enabled',
        'contents' => $this->transcriptEnabled ? 'true' : 'false'
      ];
    }

    if ($this->textInputEnabled !== null) {
      $parts[] = [
        'name' => 'text_input_enabled',
        'contents' => $this->textInputEnabled ? 'true' : 'false'
      ];
    }

    if ($this->conversationModeToggleEnabled !== null) {
      $parts[] = [
        'name' => 'conversation_mode_toggle_enabled',
        'contents' => $this->conversationModeToggleEnabled ? 'true' : 'false'
      ];
    }

    if ($this->defaultExpanded !== null) {
      $parts[] = [
        'name' => 'default_expanded',
        'contents' => $this->defaultExpanded ? 'true' : 'false'
      ];
    }

    if ($this->alwaysExpanded !== null) {
      $parts[] = [
        'name' => 'always_expanded',
        'contents' => $this->alwaysExpanded ? 'true' : 'false'
      ];
    }

    if ($this->dismissible !== null) {
      $parts[] = [
        'name' => 'dismissible',
        'contents' => $this->dismissible ? 'true' : 'false'
      ];
    }

    if ($this->showAgentStatus !== null) {
      $parts[] = [
        'name' => 'show_agent_status',
        'contents' => $this->showAgentStatus ? 'true' : 'false'
      ];
    }

    if ($this->showConversationId !== null) {
      $parts[] = [
        'name' => 'show_conversation_id',
        'contents' => $this->showConversationId ? 'true' : 'false'
      ];
    }

    if ($this->stripAudioTags !== null) {
      $parts[] = [
        'name' => 'strip_audio_tags',
        'contents' => $this->stripAudioTags ? 'true' : 'false'
      ];
    }

    if ($this->syntaxHighlightTheme !== null) {
      $parts[] = [
        'name' => 'syntax_highlight_theme',
        'contents' => $this->syntaxHighlightTheme
      ];
    }

    if ($this->textContents !== null) {
      $parts[] = [
        'name' => 'text_contents',
        'contents' => json_encode($this->textContents),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->styles !== null) {
      $parts[] = [
        'name' => 'styles',
        'contents' => json_encode($this->styles),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    if ($this->showResizeButton !== null) {
      $parts[] = [
        'name' => 'show_resize_button',
        'contents' => $this->showResizeButton ? 'true' : 'false'
      ];
    }

    if ($this->endConfirmationEnabled !== null) {
      $parts[] = [
        'name' => 'end_confirmation_enabled',
        'contents' => $this->endConfirmationEnabled ? 'true' : 'false'
      ];
    }

    if ($this->mobileFullscreen !== null) {
      $parts[] = [
        'name' => 'mobile_fullscreen',
        'contents' => $this->mobileFullscreen ? 'true' : 'false'
      ];
    }

    if ($this->transcriptSpeechSyncEnabled !== null) {
      $parts[] = [
        'name' => 'transcript_speech_sync_enabled',
        'contents' => $this->transcriptSpeechSyncEnabled ? 'true' : 'false'
      ];
    }

    if ($this->languageSelector !== null) {
      $parts[] = [
        'name' => 'language_selector',
        'contents' => $this->languageSelector ? 'true' : 'false'
      ];
    }

    if ($this->supportsTextOnly !== null) {
      $parts[] = [
        'name' => 'supports_text_only',
        'contents' => $this->supportsTextOnly ? 'true' : 'false'
      ];
    }

    if ($this->customAvatarPath !== null) {
      $parts[] = [
        'name' => 'custom_avatar_path',
        'contents' => $this->customAvatarPath
      ];
    }

    if ($this->languagePresets !== null) {
      $parts[] = [
        'name' => 'language_presets',
        'contents' => json_encode($this->languagePresets),
        'headers' => ['Content-Type' => 'application/json']
      ];
    }

    return $parts;
  }

  public function validate(): void
  {
    $this->endFeedback?->validate();
    foreach ($this->markdownLinkAllowedHosts ?? [] as $item) {
      $item->validate();
    }
    $this->textContents?->validate();
    $this->styles?->validate();
  }
}
