<?php

declare(strict_types=1);

namespace ElevenLabs\Agents\Conversations\Tags;

use ElevenLabs\Services\BaseService;
use ElevenLabs\Core\Json\JsonApiRequest;
use ElevenLabs\Core\Client\HttpMethod;
use ElevenLabs\Utils\Serializer;
use ElevenLabs\Utils\Validator;



/**
 * Service class containing API endpoint methods.
 *
 * This class extends the base service to provide typed methods for specific API operations.
 * Each method corresponds to an API endpoint and handles request serialization,
 * execution, and response deserialization.
 */
class TagsClient extends BaseService
{
    
    /** @var array|null Method-level configuration for assign */
    protected ?array $assignConfig = null;
    
    /** @var array|null Method-level configuration for unassign */
    protected ?array $unassignConfig = null;
    
    /** @var array|null Method-level configuration for list */
    protected ?array $listConfig = null;
    
    /** @var array|null Method-level configuration for create */
    protected ?array $createConfig = null;
    
    /** @var array|null Method-level configuration for get */
    protected ?array $getConfig = null;
    
    /** @var array|null Method-level configuration for update */
    protected ?array $updateConfig = null;
    
    /** @var array|null Method-level configuration for delete */
    protected ?array $deleteConfig = null;
    

    
    /**
     * Set method-level configuration for assign.
     *
     * @param array $config Configuration overrides for this method
     * @return $this
     */
    public function setAssignConfig(array $config): static
    {
        $this->assignConfig = $config;
        return $this;
    }

    
    /**
     * Set method-level configuration for unassign.
     *
     * @param array $config Configuration overrides for this method
     * @return $this
     */
    public function setUnassignConfig(array $config): static
    {
        $this->unassignConfig = $config;
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
     * Set method-level configuration for create.
     *
     * @param array $config Configuration overrides for this method
     * @return $this
     */
    public function setCreateConfig(array $config): static
    {
        $this->createConfig = $config;
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
     * Assign one or more conversation tags to a conversation. Tags that are already assigned are ignored. Tags must belong to the same workspace.
     *
     * @param string $conversationId
     * @param \ElevenLabs\Agents\Conversations\Tags\Requests\AssignConversationTagsRequestModel $request Request body
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return void
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function assign(string $conversationId, \ElevenLabs\Agents\Conversations\Tags\Requests\AssignConversationTagsRequestModel $request, ?array $options = null): void
    {
        
        $request->validate();

        
        $resolvedConfig = $this->getResolvedConfig($this->assignConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/conversations/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) . "/tags",
                method: HttpMethod::POST,
                body: $request
        ), $resolvedConfig);
        
    }
    
    /**
     * Remove a single conversation tag from a conversation.
     *
     * @param string $conversationId
     * @param string $tagId
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return void
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function unassign(string $conversationId, string $tagId, ?array $options = null): void
    {
        
        
        $resolvedConfig = $this->getResolvedConfig($this->unassignConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/conversations/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($conversationId) . "/tags/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($tagId),
                method: HttpMethod::DELETE
        ), $resolvedConfig);
        
    }
    
    /**
     * List conversation tags for the workspace, ordered by most recently created first.
     *
     * @param \ElevenLabs\Agents\Conversations\Tags\Requests\ListTagsRequest $request Request parameters
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?\ElevenLabs\Types\GetConversationTagsPageResponseModel
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function list(\ElevenLabs\Agents\Conversations\Tags\Requests\ListTagsRequest $request = new \ElevenLabs\Agents\Conversations\Tags\Requests\ListTagsRequest(), ?array $options = null): ?\ElevenLabs\Types\GetConversationTagsPageResponseModel
    {
        
        $pageSize = $request->pageSize;
        $cursor = $request->cursor;

        Validator::validateNumber($pageSize, 'page_size', min: 1, max: 100);

        
        $resolvedConfig = $this->getResolvedConfig($this->listConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/tags",
                method: HttpMethod::GET,
                query: [
				'page_size' => $pageSize,
				'cursor' => $cursor
			]
        ), $resolvedConfig);
        $data = $response->getBody()->getContents();
        
        try {
        
        $result = Serializer::deserialize($data, \ElevenLabs\Types\GetConversationTagsPageResponseModel::class);
        
        } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
            throw new \ElevenLabs\Exceptions\ElevenlabsException(
                message: "Failed to deserialize the response: {$e->getMessage()}",
                previous: $e,
            );
        }
        return $result;
        
        
    }
    
    /**
     * Create a new conversation tag for the workspace.
     *
     * @param \ElevenLabs\Agents\Conversations\Tags\Requests\CreateConversationTagRequestModel $request Request body
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?\ElevenLabs\Types\ConversationTagResponseModel
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function create(\ElevenLabs\Agents\Conversations\Tags\Requests\CreateConversationTagRequestModel $request, ?array $options = null): ?\ElevenLabs\Types\ConversationTagResponseModel
    {
        
        $request->validate();

        
        $resolvedConfig = $this->getResolvedConfig($this->createConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/tags",
                method: HttpMethod::POST,
                body: $request
        ), $resolvedConfig);
        $data = $response->getBody()->getContents();
        
        try {
        
        $result = Serializer::deserialize($data, \ElevenLabs\Types\ConversationTagResponseModel::class);
        
        } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
            throw new \ElevenLabs\Exceptions\ElevenlabsException(
                message: "Failed to deserialize the response: {$e->getMessage()}",
                previous: $e,
            );
        }
        return $result;
        
        
    }
    
    /**
     * Get a conversation tag by ID.
     *
     * @param string $tagId
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?\ElevenLabs\Types\ConversationTagResponseModel
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function get(string $tagId, ?array $options = null): ?\ElevenLabs\Types\ConversationTagResponseModel
    {
        
        
        $resolvedConfig = $this->getResolvedConfig($this->getConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/tags/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($tagId),
                method: HttpMethod::GET
        ), $resolvedConfig);
        $data = $response->getBody()->getContents();
        
        try {
        
        $result = Serializer::deserialize($data, \ElevenLabs\Types\ConversationTagResponseModel::class);
        
        } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
            throw new \ElevenLabs\Exceptions\ElevenlabsException(
                message: "Failed to deserialize the response: {$e->getMessage()}",
                previous: $e,
            );
        }
        return $result;
        
        
    }
    
    /**
     * Update a conversation tag's title and/or description. Restricted to the tag owner or a workspace admin.
     *
     * @param string $tagId
     * @param \ElevenLabs\Agents\Conversations\Tags\Requests\PatchConversationTagRequestModel $request Request body
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return ?\ElevenLabs\Types\ConversationTagResponseModel
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function update(string $tagId, \ElevenLabs\Agents\Conversations\Tags\Requests\PatchConversationTagRequestModel $request = new \ElevenLabs\Agents\Conversations\Tags\Requests\PatchConversationTagRequestModel(), ?array $options = null): ?\ElevenLabs\Types\ConversationTagResponseModel
    {
        
        $request->validate();

        
        $resolvedConfig = $this->getResolvedConfig($this->updateConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/tags/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($tagId),
                method: HttpMethod::PATCH,
                body: $request
        ), $resolvedConfig);
        $data = $response->getBody()->getContents();
        
        try {
        
        $result = Serializer::deserialize($data, \ElevenLabs\Types\ConversationTagResponseModel::class);
        
        } catch (\JsonException | \TypeError | \InvalidArgumentException $e) {
            throw new \ElevenLabs\Exceptions\ElevenlabsException(
                message: "Failed to deserialize the response: {$e->getMessage()}",
                previous: $e,
            );
        }
        return $result;
        
        
    }
    
    /**
     * Delete a conversation tag. Restricted to the tag owner or a workspace admin.
     *
     * @param string $tagId
     * @param ?array{
     *   baseUrl?: string,
     *   maxRetries?: int,
     *   timeout?: float,
     *   headers?: array<string, string>,
     *   queryParameters?: array<string, mixed>,
     *   bodyProperties?: array<string, mixed>,
     * } $options
     * @return void
     * @throws \ElevenLabs\Exceptions\ElevenlabsException
     * @throws \ElevenLabs\Exceptions\ElevenlabsApiException
     */
    public function delete(string $tagId, ?array $options = null): void
    {
        
        
        $resolvedConfig = $this->getResolvedConfig($this->deleteConfig, $options);
        $response = $this->sendJsonRequest(new JsonApiRequest(
                baseUrl: $this->getBaseUrl($resolvedConfig),
                path: "/v1/convai/tags/" . \ElevenLabs\Core\Client\RawClient::encodePathParam($tagId),
                method: HttpMethod::DELETE
        ), $resolvedConfig);
        
    }
    
}
