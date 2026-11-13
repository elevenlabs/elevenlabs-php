<?php

declare(strict_types=1);

namespace ElevenLabs\PronunciationDictionaries\Rules;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;

/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class RulesClient extends BaseService
{
  /** @var array|null Method-level configuration for set */
  protected ?array $setConfig = null;

  /** @var array|null Method-level configuration for add */
  protected ?array $addConfig = null;

  /** @var array|null Method-level configuration for remove */
  protected ?array $removeConfig = null;

  /**
   * Set method-level configuration for set.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setSetConfig(array $config): static
  {
    $this->setConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for add.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setAddConfig(array $config): static
  {
    $this->addConfig = $config;
    return $this;
  }

  /**
   * Set method-level configuration for remove.
   *
   * @param array $config Configuration overrides for this method
   * @return $this
   */
  public function setRemoveConfig(array $config): static
  {
    $this->removeConfig = $config;
    return $this;
  }

  /**
   * Replaces all existing rules on the pronunciation dictionary with the provided ones.
   *
   * @param string $pronunciationDictionaryId The id of the pronunciation dictionary
   * @param \ElevenLabs\PronunciationDictionaries\Rules\Requests\BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPost $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function set(
    string $pronunciationDictionaryId,
    \ElevenLabs\PronunciationDictionaries\Rules\Requests\BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPost $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->setConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($pronunciationDictionaryId) .
          '/set-rules',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PronunciationDictionaryRulesResponseModel::class
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
   * Add rules to the pronunciation dictionary. If a rule with the same string_to_replace already exists, it will be replaced.
   *
   * @param string $pronunciationDictionaryId The id of the pronunciation dictionary
   * @param \ElevenLabs\PronunciationDictionaries\Rules\Requests\PronunciationDictionary $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function add(
    string $pronunciationDictionaryId,
    \ElevenLabs\PronunciationDictionaries\Rules\Requests\PronunciationDictionary $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->addConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($pronunciationDictionaryId) .
          '/add-rules',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PronunciationDictionaryRulesResponseModel::class
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
   * Remove rules from the pronunciation dictionary
   *
   * @param string $pronunciationDictionaryId The id of the pronunciation dictionary
   * @param \ElevenLabs\PronunciationDictionaries\Rules\Requests\RemovePronunciationDictionaryRulesRequest $request Request body
   * @param ?array{
   *   baseUrl?: string,
   *   maxRetries?: int,
   *   timeout?: float,
   *   headers?: array<string, string>,
   *   queryParameters?: array<string, mixed>,
   *   bodyProperties?: array<string, mixed>,
   * } $options
   * @return ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel
   * @throws \ElevenLabs\Exceptions\ElevenlabsException
   * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
   */
  public function remove(
    string $pronunciationDictionaryId,
    \ElevenLabs\PronunciationDictionaries\Rules\Requests\RemovePronunciationDictionaryRulesRequest $request,
    ?array $options = null
  ): ?\ElevenLabs\Types\PronunciationDictionaryRulesResponseModel {
    $request->validate();

    $resolvedConfig = $this->getResolvedConfig($this->removeConfig, $options);
    $response = $this->sendJsonRequest(
      new JsonApiRequest(
        baseUrl: $this->getBaseUrl($resolvedConfig),
        path: '/v1/pronunciation-dictionaries/' .
          \ElevenLabs\Core\Client\RawClient::encodePathParam($pronunciationDictionaryId) .
          '/remove-rules',
        method: HttpMethod::POST,
        body: $request
      ),
      $resolvedConfig
    );
    $data = $response->getBody()->getContents();

    try {
      $result = Serializer::deserialize(
        $data,
        \ElevenLabs\Types\PronunciationDictionaryRulesResponseModel::class
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
