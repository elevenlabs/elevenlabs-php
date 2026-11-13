<?php

declare(strict_types=1);

namespace ElevenLabs\Voices;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

use ElevenLabs\Voices\Pvc\PvcClient;
use ElevenLabs\Voices\Samples\SamplesClient;
use ElevenLabs\Voices\Collections\CollectionsClient;
use ElevenLabs\Voices\Settings\SettingsClient;
use ElevenLabs\Voices\Accents\AccentsClient;
use ElevenLabs\Voices\Ivc\IvcClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class VoicesClient extends BaseService
{
  public PvcClient $pvc;
  public SamplesClient $samples;
  public CollectionsClient $collections;
  public SettingsClient $settings;
  public AccentsClient $accents;
  public IvcClient $ivc;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->pvc = new PvcClient($client, $options);
    $this->samples = new SamplesClient($client, $options);
    $this->collections = new CollectionsClient($client, $options);
    $this->settings = new SettingsClient($client, $options);
    $this->accents = new AccentsClient($client, $options);
    $this->ivc = new IvcClient($client, $options);
  }

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for delete */
  protected ?array $deleteConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for search */
  protected ?array $searchConfig = null;

  /** @var array|null Method-level configuration for replicateToIsolatedEnvironment */
  protected ?array $replicateToIsolatedEnvironmentConfig = null;

  /** @var array|null Method-level configuration for share */
  protected ?array $shareConfig = null;

  /** @var array|null Method-level configuration for findSimilarVoices */
  protected ?array $findSimilarVoicesConfig = null;

  /** @var array|null Method-level configuration for getShared */
  protected ?array $getSharedConfig = null;

  /**
   * Set method-level configuration for get.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetConfig(array $config): static
  {
    $this->getConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for delete.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDeleteConfig(array $config): static
  {
    $this->deleteConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for update.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setUpdateConfig(array $config): static
  {
    $this->updateConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for search.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSearchConfig(array $config): static
  {
    $this->searchConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for replicateToIsolatedEnvironment.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setReplicateToIsolatedEnvironmentConfig(array $config): static
  {
    $this->replicateToIsolatedEnvironmentConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for share.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setShareConfig(array $config): static
  {
    $this->shareConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for findSimilarVoices.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setFindSimilarVoicesConfig(array $config): static
  {
    $this->findSimilarVoicesConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for getShared.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setGetSharedConfig(array $config): static
  {
    $this->getSharedConfig = $config;
    return $this;
  }

  /**
   * Returns metadata about a specific voice.
   *
   * @param string $voiceId ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\Voices\Requests\GetVoicesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\Voice
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $voiceId,
    \ElevenLabs\Voices\Requests\GetVoicesRequest $request = new \ElevenLabs\Voices\Requests\GetVoicesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\Voice {
    $withSettings = $request->withSettings;

    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
        method: HttpMethod::GET,
        query: [
          'with_settings' => $withSettings
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\Voice::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Deletes a voice by its ID.
   *
   * @param string $voiceId ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\DeleteVoiceResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function delete(
    string $voiceId,
    ?array $options = null
  ): ?\ElevenLabs\Types\DeleteVoiceResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
        method: HttpMethod::DELETE
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\DeleteVoiceResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Edit a voice created by you.
   *
   * @param string $voiceId ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\Voices\Requests\BodyEditVoiceV1VoicesVoiceIdEditPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\EditVoiceResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $voiceId,
    \ElevenLabs\Voices\Requests\BodyEditVoiceV1VoicesVoiceIdEditPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\EditVoiceResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/voices/' . \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) . '/edit',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\EditVoiceResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Gets a list of all available voices for a user with search, filtering and pagination.
   *
   * @param \ElevenLabs\Voices\Requests\SearchVoicesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetVoicesV2Response
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function search(
    \ElevenLabs\Voices\Requests\SearchVoicesRequest $request = new \ElevenLabs\Voices\Requests\SearchVoicesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetVoicesV2Response {
    $nextPageToken = $request->nextPageToken;
    $pageSize = $request->pageSize;
    $search = $request->search;
    $sort = $request->sort;
    $sortDirection = $request->sortDirection;
    $voiceType = $request->voiceType;
    $category = $request->category;
    $fineTuningState = $request->fineTuningState;
    $collectionId = $request->collectionId;
    $gender = $request->gender;
    $age = $request->age;
    $language = $request->language;
    $accent = $request->accent;
    $useCases = $request->useCases;
    $minNoticePeriodDays = $request->minNoticePeriodDays;
    $includeCustomRates = $request->includeCustomRates;
    $includeLiveModerated = $request->includeLiveModerated;
    $highQuality = $request->highQuality;
    $includeTotalCount = $request->includeTotalCount;
    $voiceIds = $request->voiceIds;

    $resolvedConfig = $this->getResolvedConfig($this->searchConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v2/voices',
        method: HttpMethod::GET,
        query: [
          'next_page_token' => $nextPageToken,
          'page_size' => $pageSize,
          'search' => $search,
          'sort' => $sort,
          'sort_direction' => $sortDirection,
          'voice_type' => $voiceType,
          'category' => $category,
          'fine_tuning_state' => $fineTuningState,
          'collection_id' => $collectionId,
          'gender' => $gender,
          'age' => $age,
          'language' => $language,
          'accent' => $accent,
          'use_cases' => $useCases,
          'min_notice_period_days' => $minNoticePeriodDays,
          'include_custom_rates' => $includeCustomRates,
          'include_live_moderated' => $includeLiveModerated,
          'high_quality' => $highQuality,
          'include_total_count' => $includeTotalCount,
          'voice_ids' => $voiceIds
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetVoicesV2Response::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Replicates an Instant Voice Clone or Voice Design voice to a workspace in a different data residency. The target workspace must belong to the same consolidated billing group. The user must have VOICES_WRITE in the source workspace, and be an admin on the source voice. Human users (i.e. not service accounts) must also have VOICES_WRITE in the target workspace. This endpoint is available on the central environment only.
   *
   * @param string $voiceId Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
   * @param \ElevenLabs\Voices\Requests\ReplicateVoiceToIsolatedEnvironmentRequestModel $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\ReplicateVoiceToIsolatedEnvironmentResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function replicateToIsolatedEnvironment(
    string $voiceId,
    \ElevenLabs\Voices\Requests\ReplicateVoiceToIsolatedEnvironmentRequestModel $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\ReplicateVoiceToIsolatedEnvironmentResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig(
      $this->replicateToIsolatedEnvironmentConfig,
      $options
    );
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId) .
          '/replicate-to-isolated-environment',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\ReplicateVoiceToIsolatedEnvironmentResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Add a shared voice to your collection of Voices
   *
   * @param string $publicUserId Public user ID used to publicly identify ElevenLabs users.
   * @param string $voiceId ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
   * @param \ElevenLabs\Voices\Requests\BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddVoiceResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function share(
    string $publicUserId,
    string $voiceId,
    \ElevenLabs\Voices\Requests\BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddVoiceResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->shareConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/voices/add/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($publicUserId) .
          '/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($voiceId),
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\AddVoiceResponseModel::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Returns a list of shared voices similar to the provided audio sample. If neither similarity_threshold nor top_k is provided, we will apply default values.
   *
   * @param \ElevenLabs\Voices\Requests\BodyGetSimilarLibraryVoicesV1SimilarVoicesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetLibraryVoicesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function findSimilarVoices(
    \ElevenLabs\Voices\Requests\BodyGetSimilarLibraryVoicesV1SimilarVoicesPost $request = new \ElevenLabs\Voices\Requests\BodyGetSimilarLibraryVoicesV1SimilarVoicesPost(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetLibraryVoicesResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->findSimilarVoicesConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/similar-voices',
      ['multipart' => $request?->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetLibraryVoicesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }

  /**
   * Retrieves a list of shared voices.
   *
   * @param \ElevenLabs\Voices\Requests\GetSharedVoicesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetLibraryVoicesResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function getShared(
    \ElevenLabs\Voices\Requests\GetSharedVoicesRequest $request = new \ElevenLabs\Voices\Requests\GetSharedVoicesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetLibraryVoicesResponse {
    $pageSize = $request->pageSize;
    $category = $request->category;
    $gender = $request->gender;
    $age = $request->age;
    $accent = $request->accent;
    $language = $request->language;
    $locale = $request->locale;
    $search = $request->search;
    $useCases = $request->useCases;
    $descriptives = $request->descriptives;
    $featured = $request->featured;
    $minNoticePeriodDays = $request->minNoticePeriodDays;
    $includeCustomRates = $request->includeCustomRates;
    $includeLiveModerated = $request->includeLiveModerated;
    $readerAppEnabled = $request->readerAppEnabled;
    $ownerId = $request->ownerId;
    $sort = $request->sort;
    $page = $request->page;

    $resolvedConfig = $this->getResolvedConfig($this->getSharedConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/shared-voices',
        method: HttpMethod::GET,
        query: [
          'page_size' => $pageSize,
          'category' => $category,
          'gender' => $gender,
          'age' => $age,
          'accent' => $accent,
          'language' => $language,
          'locale' => $locale,
          'search' => $search,
          'use_cases' => $useCases,
          'descriptives' => $descriptives,
          'featured' => $featured,
          'min_notice_period_days' => $minNoticePeriodDays,
          'include_custom_rates' => $includeCustomRates,
          'include_live_moderated' => $includeLiveModerated,
          'reader_app_enabled' => $readerAppEnabled,
          'owner_id' => $ownerId,
          'sort' => $sort,
          'page' => $page
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize($data, \ElevenLabs\Types\GetLibraryVoicesResponse::class);
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
