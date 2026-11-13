<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;

use ElevenLabs\PronunciationDictionaries\Rules\RulesClient;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class PronunciationDictionariesClient extends BaseService
{
  public RulesClient $rules;

  public function __construct(\ElevenLabs\Core\Client\RawClient $client, ?array $options = null)
  {
    parent::__construct($client, $options);
    $this->rules = new RulesClient($client, $options);
  }

  /** @var array|null Method-level configuration for createFromFile */
  protected ?array $createFromFileConfig = null;

  /** @var array|null Method-level configuration for createFromRules */
  protected ?array $createFromRulesConfig = null;

  /** @var array|null Method-level configuration for get */
  protected ?array $getConfig = null;

  /** @var array|null Method-level configuration for update */
  protected ?array $updateConfig = null;

  /** @var array|null Method-level configuration for download */
  protected ?array $downloadConfig = null;

  /** @var array|null Method-level configuration for list */
  protected ?array $listConfig = null;

  /**
   * Set method-level configuration for createFromFile.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFromFileConfig(array $config): static
  {
    $this->createFromFileConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for createFromRules.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setCreateFromRulesConfig(array $config): static
  {
    $this->createFromRulesConfig = $config;
    return $this;
  }

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
   * Set method-level configuration for download.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setDownloadConfig(array $config): static
  {
    $this->downloadConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for list.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setListConfig(array $config): static
  {
    $this->listConfig = $config;
    return $this;
  }

  /**
   * Creates a new pronunciation dictionary from a lexicon .PLS file
   *
   * @param \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddPronunciationDictionaryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFromFile(
    \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddPronunciationDictionaryResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFromFileConfig, $options);
    $response = $this->sendRequest(
      'post',
      '/v1/pronunciation-dictionaries/add-from-file',
      ['multipart' => $request->toMultipart()],
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddPronunciationDictionaryResponseModel::class
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
   * Creates a new pronunciation dictionary from provided rules.
   *
   * @param \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\AddPronunciationDictionaryResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function createFromRules(
    \ElevenLabs\PronunciationDictionaries\Requests\BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\AddPronunciationDictionaryResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->createFromRulesConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/add-from-rules',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\AddPronunciationDictionaryResponseModel::class
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
   * Get metadata for a pronunciation dictionary
   *
   * @param string $pronunciationDictionaryId The id of the pronunciation dictionary
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function get(
    string $pronunciationDictionaryId,
    ?array $options = null
  ): ?\ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModel {
    $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($pronunciationDictionaryId),
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetPronunciationDictionaryWithRulesResponseModel::class
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
   * Partially update the pronunciation dictionary without changing the version
   *
   * @param string $pronunciationDictionaryId The id of the pronunciation dictionary
   * @param \ElevenLabs\PronunciationDictionaries\Requests\BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function update(
    string $pronunciationDictionaryId,
    \ElevenLabs\PronunciationDictionaries\Requests\BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch $request = new \ElevenLabs\PronunciationDictionaries\Requests\BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($pronunciationDictionaryId),
        method: HttpMethod::PATCH,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetPronunciationDictionaryMetadataResponse::class
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
   * Get a PLS file with a pronunciation dictionary version rules
   *
   * @param string $dictionaryId The id of the pronunciation dictionary
   * @param string $versionId The id of the pronunciation dictionary version
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return \Psr\Http\Message\StreamInterface The response body, read as it arrives. getContents() or (string) returns the whole body. Call close() if you stop reading early.
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function download(
    string $dictionaryId,
    string $versionId,
    ?array $options = null
  ): \Psr\Http\Message\StreamInterface {
    $resolvedConfig = $this->getResolvedConfig($this->downloadConfig, $options);
    $response = $this->sendBinaryStreamJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($dictionaryId) .
          '/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($versionId) .
          '/download',
        method: HttpMethod::GET
      ),
      $resolvedConfig
    );
    $data = $response->getBody();

    return $data;
  }

  /**
   * Get a list of the pronunciation dictionaries you have access to and their metadata
   *
   * @param \ElevenLabs\PronunciationDictionaries\Requests\ListPronunciationDictionariesRequest $request Request parameters
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\GetPronunciationDictionariesMetadataResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function list(
    \ElevenLabs\PronunciationDictionaries\Requests\ListPronunciationDictionariesRequest $request = new \ElevenLabs\PronunciationDictionaries\Requests\ListPronunciationDictionariesRequest(),
    ?array $options = null
  ): ?\ElevenLabs\Types\GetPronunciationDictionariesMetadataResponseModel {
    $cursor = $request->cursor;
    $pageSize = $request->pageSize;
    $sort = $request->sort;
    $sortDirection = $request->sortDirection;
    $includeArchived = $request->includeArchived;

    Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

    $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries',
        method: HttpMethod::GET,
        query: [
          'cursor' => $cursor,
          'page_size' => $pageSize,
          'sort' => $sort,
          'sort_direction' => $sortDirection,
          'include_archived' => $includeArchived
        ]
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\GetPronunciationDictionariesMetadataResponseModel::class
      );
    } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
      throw new \ElevenLabs\Exceptions\ElevenlabsException(
        message: "Failed to deserialize the response: {$e->getMessage()}",
        previous: $e
      );
    }
    return $result;
  }
}
