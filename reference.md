# Reference
## History
<details><summary><code>$client-&gt;history-&gt;list($request) -> ?GetSpeechHistoryResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of your generated audio (e.g. text to speech, speech to speech, Studio, dubbing). Music and SFX generations are not included and cannot currently be retrieved via the API.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->history->list(
    new ListHistoryRequest([
        'pageSize' => 1,
        'startAfterHistoryItemId' => 'start_after_history_item_id',
        'voiceId' => 'voice_id',
        'modelId' => 'eleven_turbo_v2',
        'dateBeforeUnix' => 1640995200,
        'dateAfterUnix' => 1640995200,
        'sortDirection' => ListHistoryRequestSortDirection::Asc->value,
        'search' => 'In the land far far away',
        'source' => ListHistoryRequestSource::Tts->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many history items to return at maximum. Can not exceed 1000, defaults to 100.
    
</dd>
</dl>

<dl>
<dd>

**$startAfterHistoryItemId:** `?string` — After which ID to start fetching, use this parameter to paginate across a large collection of history items. In case this parameter is not provided history items will be fetched starting from the most recently created one ordered descending by their creation date.
    
</dd>
</dl>

<dl>
<dd>

**$voiceId:** `?string` — ID of the voice to be filtered for. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Search term used for filtering history items. If provided, source becomes required.
    
</dd>
</dl>

<dl>
<dd>

**$dateBeforeUnix:** `?int` — Unix timestamp to filter history items before this date (exclusive).
    
</dd>
</dl>

<dl>
<dd>

**$dateAfterUnix:** `?int` — Unix timestamp to filter history items after this date (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?ListHistoryRequestSortDirection` — Sort direction for the results.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — search term used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$source:** `?ListHistoryRequestSource` — Source of the generated history item
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;history-&gt;get($historyItemId) -> ?SpeechHistoryItemResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a history item.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->history->get(
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$historyItemId:** `string` — ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;history-&gt;delete($historyItemId) -> ?DeleteHistoryItemResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a history item by its ID
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->history->delete(
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$historyItemId:** `string` — ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;history-&gt;getAudio($historyItemId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the audio of an history item.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->history->getAudio(
    'VW7YKqPnjY4h39yTbx2L',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$historyItemId:** `string` — ID of the history item to be used. You can use the [Get generated items](/docs/api-reference/history/list) endpoint to retrieve a list of history items.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;history-&gt;download($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Download one or more history items. If one history item ID is provided, we will return a single audio file. If more than one history item IDs are provided, we will provide the history items packed into a .zip file.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->history->download(
    new DownloadHistoryRequest([
        'historyItemIds' => [
            'history_item_ids',
        ],
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$historyItemIds:** `array` — A list of history items to download, you can get IDs of history items and other metadata using the GET https://api.elevenlabs.io/v1/history endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?string` — Output format to transcode the audio file, can be wav or default.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TextToSoundEffects
<details><summary><code>$client-&gt;textToSoundEffects-&gt;convert($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Turn text into sound effects for your videos, voice-overs or video games using the most advanced sound effects models in the world.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToSoundEffects->convert(
    new CreateSoundEffectRequest([
        'outputFormat' => ConvertTextToSoundEffectsRequestOutputFormat::Alaw8000->value,
        'enableLogging' => true,
        'text' => 'Spacious braam suitable for high-impact movie trailer moments',
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ConvertTextToSoundEffectsRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text that will get converted into a sound effect.
    
</dd>
</dl>

<dl>
<dd>

**$loop:** `?bool` — Whether to create a sound effect that loops smoothly.
    
</dd>
</dl>

<dl>
<dd>

**$durationSeconds:** `?float` — The duration of the sound which will be generated in seconds. Must be at least 0.5 and at most 30. If set to None we will guess the optimal duration using the prompt. Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$promptInfluence:** `?float` — A higher prompt influence makes your generation follow the prompt more closely while also making generations less variable. Must be a value between 0 and 1. Defaults to 0.3.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?SfxModelId` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AudioIsolation
<details><summary><code>$client-&gt;audioIsolation-&gt;convert($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes background noise from audio.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->audioIsolation->convert(
    new BodyAudioIsolationV1AudioIsolationPost([
        'audio' => File::createFromString("example_audio", "example_audio"),
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$audio:** `mixed` — The audio file from which vocals/speech will be isolated from.
    
</dd>
</dl>

<dl>
<dd>

**$fileFormat:** `?AudioIsolationRequestFileFormat` — The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
    
</dd>
</dl>

<dl>
<dd>

**$previewB64:** `?string` — Optional preview image base64 for tracking this generation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioIsolation-&gt;list($request) -> ?GetAudioIsolationHistoryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of all your audio isolation generations.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioIsolation->list(
    new ListAudioIsolationRequest([
        'pageSize' => 1,
        'page' => 1,
        'search' => 'podcast',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many history items to return at maximum. Defaults to 100.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number for search pagination (1-based). Only used when search is provided.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Optional search term used for filtering audio isolation history (title/text).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioIsolation-&gt;delete($historyItemId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a specific audio isolation history item and the associated media files.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioIsolation->delete(
    'history_item_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$historyItemId:** `string` — Identifier of the audio isolation history item.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioIsolation-&gt;stream($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes background noise from audio.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->audioIsolation->stream(
    new BodyAudioIsolationStreamV1AudioIsolationStreamPost([
        'audio' => File::createFromString("example_audio", "example_audio"),
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$audio:** `mixed` — The audio file from which vocals/speech will be isolated from.
    
</dd>
</dl>

<dl>
<dd>

**$fileFormat:** `?AudioIsolationStreamRequestFileFormat` — The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AudioEffects
<details><summary><code>$client-&gt;audioEffects-&gt;getCatalog() -> ?AudioEffectsCatalogResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists the filter presets, reverb environments, and background noises that `audio_effects` can reference in Text to Speech, Text to Dialogue, and agent configurations.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioEffects->getCatalog();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Samples
<details><summary><code>$client-&gt;samples-&gt;delete($voiceId, $sampleId) -> ?DeleteSampleResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes a sample by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->samples->delete(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — ID of the sample to be used. You can use the [Get voices](/docs/api-reference/voices/get) endpoint list all the available samples for a voice.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Voices
<details><summary><code>$client-&gt;voices-&gt;get($voiceId, $request) -> ?Voice</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns metadata about a specific voice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->get(
    '21m00Tcm4TlvDq8ikWAM',
    new GetVoicesRequest([
        'withSettings' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$withSettings:** `?bool` — This parameter is now deprecated. It is ignored and will be removed in a future version.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;delete($voiceId) -> ?DeleteVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a voice by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->delete(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;update($voiceId, $request) -> ?EditVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Edit a voice created by you.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyEditVoiceV1VoicesVoiceIdEditPost([
        'name' => 'John Smith',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The name that identifies this voice. This will be displayed in the dropdown of the website.
    
</dd>
</dl>

<dl>
<dd>

**$files:** `?array` — Audio files to add to the voice
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A description of the voice.
    
</dd>
</dl>

<dl>
<dd>

**$labels:** `?array|string` — Labels for the voice. Keys can be language, accent, gender, or age.
    
</dd>
</dl>

<dl>
<dd>

**$moderateMetadata:** `?bool` — Run synchronous LLM moderation over the voice name and description when they change. Has no effect unless the voice_library_metadata_moderation feature flag is enabled for the user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;search($request) -> ?GetVoicesV2Response</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a list of all available voices for a user with search, filtering and pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->search(
    new SearchVoicesRequest([
        'nextPageToken' => '0',
        'pageSize' => 1,
        'search' => 'search',
        'sort' => 'created_at_unix',
        'sortDirection' => 'desc',
        'voiceType' => 'voice_type',
        'category' => 'category',
        'fineTuningState' => 'fine_tuning_state',
        'collectionId' => 'collection_id',
        'gender' => 'male',
        'age' => 'young',
        'language' => [
            'en',
            'es',
        ],
        'accent' => 'american',
        'useCases' => [
            'conversational',
            'narrative_story',
        ],
        'minNoticePeriodDays' => 30,
        'includeCustomRates' => true,
        'includeLiveModerated' => true,
        'highQuality' => true,
        'includeTotalCount' => true,
        'voiceIds' => [
            'voice_ids',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$nextPageToken:** `?string` — The next page token to use for pagination. Returned from the previous request. Use this in combination with the has_more flag for reliable pagination.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many voices to return at maximum. Can not exceed 100, defaults to 10. Page 0 may include more voices due to default voices being included.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search term to filter voices by. Searches in name, description, labels, category.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?string` — Which field to sort by, one of 'created_at_unix' or 'name'. 'created_at_unix' may not be available for older voices.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?string` — Which direction to sort the voices in. 'asc' or 'desc'.
    
</dd>
</dl>

<dl>
<dd>

**$voiceType:** `?string` — Type of the voice to filter by. One of 'personal', 'community', 'default', 'workspace', 'non-default', 'non-community', 'saved'. 'non-default' is equal to all but 'default'. 'non-community' is equal to 'personal' and 'workspace' combined (excludes library copies). 'saved' is equal to non-default, but includes default voices if they have been added to a collection.
    
</dd>
</dl>

<dl>
<dd>

**$category:** `?string` — Category of the voice to filter by. One of 'premade', 'cloned', 'generated', 'professional'
    
</dd>
</dl>

<dl>
<dd>

**$fineTuningState:** `?string` — State of the voice's fine tuning to filter by. Applicable only to professional voices clones. One of 'draft', 'not_verified', 'not_started', 'queued', 'fine_tuning', 'fine_tuned', 'failed', 'delayed'
    
</dd>
</dl>

<dl>
<dd>

**$collectionId:** `?string` — Collection ID to filter voices by.
    
</dd>
</dl>

<dl>
<dd>

**$gender:** `?string` — Gender used for filtering, based on the voice's 'gender' label.
    
</dd>
</dl>

<dl>
<dd>

**$age:** `?string` — Age used for filtering, based on the voice's 'age' label.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?array` — Languages used for filtering, based on the voice's 'language' label. Voices matching any of the given languages are returned.
    
</dd>
</dl>

<dl>
<dd>

**$accent:** `?string` — Accent used for filtering, based on the voice's 'accent' label.
    
</dd>
</dl>

<dl>
<dd>

**$useCases:** `?array` — Use cases used for filtering, based on the voice's 'use_case' label. Voices matching any of the given use cases are returned.
    
</dd>
</dl>

<dl>
<dd>

**$minNoticePeriodDays:** `?int` — Filter to voices whose sharing notice period is at least the given number of days.
    
</dd>
</dl>

<dl>
<dd>

**$includeCustomRates:** `?bool` — Whether to include voices that have a custom sharing rate. Defaults to including them.
    
</dd>
</dl>

<dl>
<dd>

**$includeLiveModerated:** `?bool` — Whether to include voices that have live moderation enabled. Defaults to including them.
    
</dd>
</dl>

<dl>
<dd>

**$highQuality:** `?bool` — When true, only return studio-quality voices (those whose category is 'high_quality').
    
</dd>
</dl>

<dl>
<dd>

**$includeTotalCount:** `?bool` — Whether to include the total count of voices found in the response. NOTE: The total_count value is a live snapshot and may change between requests as users create, modify, or delete voices. For pagination, rely on the has_more flag instead. Only enable this when you actually need the total count (e.g., for display purposes), as it incurs a performance cost.
    
</dd>
</dl>

<dl>
<dd>

**$voiceIds:** `?array` — Voice IDs to lookup by. Maximum 100 voice IDs.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;replicateToIsolatedEnvironment($voiceId, $request) -> ?ReplicateVoiceToIsolatedEnvironmentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Replicates an Instant Voice Clone or Voice Design voice to a workspace in a different data residency. The target workspace must belong to the same consolidated billing group. The user must have VOICES_WRITE in the source workspace, and be an admin on the source voice. Human users (i.e. not service accounts) must also have VOICES_WRITE in the target workspace. This endpoint is available on the central environment only.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->replicateToIsolatedEnvironment(
    '21m00Tcm4TlvDq8ikWAM',
    new ReplicateVoiceToIsolatedEnvironmentRequestModel([
        'targetWorkspaceId' => 'target_workspace_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$targetWorkspaceId:** `string` — ID of the workspace to replicate the voice into. It must belong to the same consolidated billing group as the calling workspace; the target's data residency is derived from that link.
    
</dd>
</dl>

<dl>
<dd>

**$preserveVoiceId:** `?bool` — When true (default) the replicated voice keeps the same voice ID in the target residency; set to false to assign a new voice ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;share($publicUserId, $voiceId, $request) -> ?AddVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add a shared voice to your collection of Voices
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->share(
    '63e06b7e7cafdc46be4d2e0b3f045940231ae058d508589653d74d1265a574ca',
    '21m00Tcm4TlvDq8ikWAM',
    new BodyAddSharedVoiceV1VoicesAddPublicUserIdVoiceIdPost([
        'newName' => 'John Smith',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$publicUserId:** `string` — Public user ID used to publicly identify ElevenLabs users.
    
</dd>
</dl>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$newName:** `string` — The name that identifies this voice. This will be displayed in the dropdown of the website.
    
</dd>
</dl>

<dl>
<dd>

**$bookmarked:** `?bool` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;findSimilarVoices($request) -> ?GetLibraryVoicesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of shared voices similar to the provided audio sample. If neither similarity_threshold nor top_k is provided, we will apply default values.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->findSimilarVoices(
    new BodyGetSimilarLibraryVoicesV1SimilarVoicesPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$audioFile:** `mixed` 
    
</dd>
</dl>

<dl>
<dd>

**$similarityThreshold:** `?float` — Threshold for voice similarity between provided sample and library voices. Values range from 0 to 2. The smaller the value the more similar voices will be returned.
    
</dd>
</dl>

<dl>
<dd>

**$topK:** `?int` — Number of most similar voices to return. If similarity_threshold is provided, less than this number of voices may be returned. Values range from 1 to 100.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;getShared($request) -> ?GetLibraryVoicesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of shared voices.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->getShared(
    new GetSharedVoicesRequest([
        'pageSize' => 1,
        'category' => GetSharedVoicesRequestCategory::Professional->value,
        'gender' => 'male',
        'age' => 'young',
        'accent' => 'american',
        'language' => 'en',
        'locale' => 'en-US',
        'search' => 'tiktok',
        'useCases' => [
            'use_cases',
        ],
        'descriptives' => [
            'descriptives',
        ],
        'featured' => true,
        'minNoticePeriodDays' => 30,
        'includeCustomRates' => true,
        'includeLiveModerated' => true,
        'readerAppEnabled' => true,
        'ownerId' => '7c9fab611d9a0e1fb2e7448a0c294a8804efc2bcc324b0a366a5d5232b7d1532',
        'sort' => GetSharedVoicesRequestSort::CreatedDate->value,
        'page' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many shared voices to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$category:** `?GetSharedVoicesRequestCategory` — Voice category used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$gender:** `?string` — Gender used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$age:** `?string` — Age used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$accent:** `?string` — Accent used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` — Language used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$locale:** `?string` — Locale used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search term used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$useCases:** `?array` — Use-case used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$descriptives:** `?array` — Search term used for filtering
    
</dd>
</dl>

<dl>
<dd>

**$featured:** `?bool` — Filter featured voices
    
</dd>
</dl>

<dl>
<dd>

**$minNoticePeriodDays:** `?int` — Filter voices with a minimum notice period of the given number of days.
    
</dd>
</dl>

<dl>
<dd>

**$includeCustomRates:** `?bool` — Include/exclude voices with custom rates
    
</dd>
</dl>

<dl>
<dd>

**$includeLiveModerated:** `?bool` — Include/exclude voices that are live moderated
    
</dd>
</dl>

<dl>
<dd>

**$readerAppEnabled:** `?bool` — Filter voices that are enabled for the reader app
    
</dd>
</dl>

<dl>
<dd>

**$ownerId:** `?string` — Filter voices by public owner ID
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?GetSharedVoicesRequestSort` — Sort criteria. Must be one of: created_date, usage_character_count_1y, trending, cloned_by_count.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Pvc
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;create($request) -> ?AddVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new PVC voice with metadata but no samples
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->create(
    new CreatePvcVoiceRequest([
        'name' => 'John Smith',
        'language' => 'en',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name that identifies this voice. This will be displayed in the dropdown of the website.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `string` — Language used in the samples.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Description to use for the created voice.
    
</dd>
</dl>

<dl>
<dd>

**$labels:** `?array` — Labels for the voice. Keys can be language, accent, gender, or age.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;update($voiceId, $request) -> ?AddVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Edit PVC voice metadata
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyEditPvcVoiceV1VoicesPvcVoiceIdPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name that identifies this voice. This will be displayed in the dropdown of the website.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` — Language used in the samples.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Description to use for the created voice.
    
</dd>
</dl>

<dl>
<dd>

**$labels:** `?array` — Labels for the voice. Keys can be language, accent, gender, or age.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;train($voiceId, $request) -> ?StartPvcVoiceTrainingResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start PVC training process for a voice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->train(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyRunPvcTrainingV1VoicesPvcVoiceIdTrainPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — The model ID to use for the conversion.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Samples
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;create($voiceId, $request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add audio samples to a PVC voice
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->create(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyAddSamplesToPvcVoiceV1VoicesPvcVoiceIdSamplesPost([
        'files' => [
            File::createFromString("example_files", "example_files"),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$files:** `array` — Audio files used to create the voice.
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;update($voiceId, $sampleId, $request) -> ?AddVoiceResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a PVC voice sample - apply noise removal, select speaker, change trim times or file name.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->update(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
    new BodyUpdatePvcVoiceSampleV1VoicesPvcVoiceIdSamplesSampleIdPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
    
</dd>
</dl>

<dl>
<dd>

**$selectedSpeakerIds:** `?array` — Speaker IDs to be used for PVC training. Make sure you send all the speaker IDs you want to use for PVC training in one request because the last request will override the previous ones.
    
</dd>
</dl>

<dl>
<dd>

**$trimStartTime:** `?int` — The start time of the audio to be used for PVC training. Time should be in milliseconds
    
</dd>
</dl>

<dl>
<dd>

**$trimEndTime:** `?int` — The end time of the audio to be used for PVC training. Time should be in milliseconds
    
</dd>
</dl>

<dl>
<dd>

**$fileName:** `?string` — The name of the audio file to be used for PVC training.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;delete($voiceId, $sampleId) -> ?DeleteVoiceSampleResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a sample from a PVC voice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->delete(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Audio
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;audio-&gt;get($voiceId, $sampleId, $request) -> ?VoiceSamplePreviewResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the first 30 seconds of voice sample audio with or without noise removal.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->audio->get(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
    new GetAudioRequest([
        'removeBackgroundNoise' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Speakers
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;speakers-&gt;get($voiceId, $sampleId) -> ?SpeakerSeparationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the status of the speaker separation process and the list of detected speakers if complete.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->speakers->get(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;speakers-&gt;separate($voiceId, $sampleId) -> ?StartSpeakerSeparationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start speaker separation process for a sample
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->speakers->separate(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Audio
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;speakers-&gt;audio-&gt;get($voiceId, $sampleId, $speakerId) -> ?SpeakerAudioResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the separated audio for a specific speaker.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->speakers->audio->get(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>

<dl>
<dd>

**$speakerId:** `string` — Speaker ID to be used, you can use GET https://api.elevenlabs.io/v1/voices/{voice_id}/samples/{sample_id}/speakers to list all the available speakers for a sample.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Waveform
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;samples-&gt;waveform-&gt;get($voiceId, $sampleId) -> ?VoiceSampleVisualWaveformResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the visual waveform of a voice sample.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->samples->waveform->get(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — Sample ID to be used
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Verification
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;verification-&gt;request($voiceId, $request) -> ?RequestPvcManualVerificationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Request manual verification for a PVC voice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->verification->request(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyRequestManualVerificationV1VoicesPvcVoiceIdVerificationPost([
        'files' => [
            File::createFromString("example_files", "example_files"),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$files:** `array` — Verification documents
    
</dd>
</dl>

<dl>
<dd>

**$extraText:** `?string` — Extra text to be used in the manual verification process.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Captcha
<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;verification-&gt;captcha-&gt;get($voiceId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get captcha for PVC voice verification.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->verification->captcha->get(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;pvc-&gt;verification-&gt;captcha-&gt;verify($voiceId, $request) -> ?VerifyPvcVoiceCaptchaResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Submit captcha verification for PVC voice.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->pvc->verification->captcha->verify(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyVerifyPvcVoiceCaptchaV1VoicesPvcVoiceIdCaptchaPost([
        'recording' => File::createFromString("example_recording", "example_recording"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$recording:** `mixed` — Audio recording of the user
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Audio
<details><summary><code>$client-&gt;voices-&gt;samples-&gt;audio-&gt;get($voiceId, $sampleId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the audio corresponding to a sample attached to a voice.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->voices->samples->audio->get(
    '21m00Tcm4TlvDq8ikWAM',
    'VW7YKqPnjY4h39yTbx2L',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$sampleId:** `string` — ID of the sample to be used. You can use the [Get voices](/docs/api-reference/voices/get) endpoint list all the available samples for a voice.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Collections
<details><summary><code>$client-&gt;voices-&gt;collections-&gt;list() -> ?GetUserVoiceCollectionsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns all the voice collections the user has access to, sorted by title.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;create($request) -> ?UserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new voice collection. The caller becomes its admin.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->create(
    new BodyCreateVoiceCollectionV1VoicesCollectionsPost([
        'title' => 'title',
        'icon' => 'icon',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$title:** `string` — Title of the collection to create/update.
    
</dd>
</dl>

<dl>
<dd>

**$icon:** `string` — Icon of the collection to create/update.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;get($collectionId) -> ?UserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a voice collection the user has access to.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->get(
    'collection_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$collectionId:** `string` — Collection ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;update($collectionId, $request) -> ?UserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the title and icon of a voice collection. Fields that are omitted are left unchanged. Requires editor access to the collection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->update(
    'collection_id',
    new BodyUpdateVoiceCollectionV1VoicesCollectionsCollectionIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$collectionId:** `string` — Collection ID.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — Title of the collection to create/update.
    
</dd>
</dl>

<dl>
<dd>

**$icon:** `?string` — Icon of the collection to create/update.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;delete($collectionId) -> ?DeleteUserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a voice collection. The voices in it are not deleted. Requires admin access to the collection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->delete(
    'collection_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$collectionId:** `string` — Collection ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;addVoice($collectionId, $voiceId) -> ?AddVoiceToUserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds a voice to a voice collection. Adding a voice that is already in the collection succeeds without changes. Requires editor access to the collection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->addVoice(
    'collection_id',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$collectionId:** `string` — Collection ID.
    
</dd>
</dl>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;collections-&gt;removeVoice($collectionId, $voiceId) -> ?RemoveVoiceFromUserVoiceCollectionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes a voice from a voice collection. The voice itself is not deleted. Requires editor access to the collection.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->collections->removeVoice(
    'collection_id',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$collectionId:** `string` — Collection ID.
    
</dd>
</dl>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Settings
<details><summary><code>$client-&gt;voices-&gt;settings-&gt;getDefault() -> ?VoiceSettings</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the default settings for voices. "similarity_boost" corresponds to"Clarity + Similarity Enhancement" in the web app and "stability" corresponds to "Stability" slider in the web app.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->settings->getDefault();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;settings-&gt;get($voiceId) -> ?VoiceSettings</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the settings for a specific voice. "similarity_boost" corresponds to"Clarity + Similarity Enhancement" in the web app and "stability" corresponds to "Stability" slider in the web app.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->settings->get(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;voices-&gt;settings-&gt;update($voiceId, $request) -> ?EditVoiceSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Edit your settings for a specific voice. "similarity_boost" corresponds to "Clarity + Similarity Enhancement" in the web app and "stability" corresponds to "Stability" slider in the web app.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->settings->update(
    '21m00Tcm4TlvDq8ikWAM',
    new VoiceSettings([
        'stability' => 1,
        'useSpeakerBoost' => true,
        'similarityBoost' => 1,
        'style' => 0,
        'speed' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. You can use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$stability:** `?float` — Determines how stable the voice is and the randomness between each generation. Lower values introduce broader emotional range for the voice. Higher values can result in a monotonous voice with limited emotion.
    
</dd>
</dl>

<dl>
<dd>

**$useSpeakerBoost:** `?bool` — This setting boosts the similarity to the original speaker. Using this setting requires a slightly higher computational load, which in turn increases latency.
    
</dd>
</dl>

<dl>
<dd>

**$similarityBoost:** `?float` — Determines how closely the AI should adhere to the original voice when attempting to replicate it.
    
</dd>
</dl>

<dl>
<dd>

**$style:** `?float` — Determines the style exaggeration of the voice. This setting attempts to amplify the style of the original speaker. It does consume additional computational resources and might increase latency if set to anything other than 0.
    
</dd>
</dl>

<dl>
<dd>

**$speed:** `?float` — Adjusts the speed of the voice. A value of 1.0 is the default speed, while values less than 1.0 slow down the speech, and values greater than 1.0 speed it up.
    
</dd>
</dl>

<dl>
<dd>

**$cloneStrength:** `?float` — Controls how closely the output matches your professional voice clone samples (0–1). Lower values sound more versatile, while higher values preserve more of the original voice characteristics. We recommend 0 for most use cases, but if you do run into issues 0.5 could be a good fallback. Applies only to professional voice clones fine-tuned for the selected v4 model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Accents
<details><summary><code>$client-&gt;voices-&gt;accents-&gt;get($request) -> ?GetVoiceAccentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the list of available accents in the shared voice library.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->accents->get(
    new GetAccentsRequest([
        'language' => 'en',
        'modelId' => 'eleven_v3',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$language:** `?string` — If provided, only accents for this language code are returned.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — If provided, returns the accents available for this model. Defaults to the most complete accent list when omitted.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Ivc
<details><summary><code>$client-&gt;voices-&gt;ivc-&gt;create($request) -> ?AddVoiceIvcResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a voice clone and add it to your Voices
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->voices->ivc->create(
    new BodyAddVoiceV1VoicesAddPost([
        'files' => [
            File::createFromString("example_files", "example_files"),
        ],
        'name' => 'John Smith',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name that identifies this voice. This will be displayed in the dropdown of the website.
    
</dd>
</dl>

<dl>
<dd>

**$files:** `array` — A list of file paths to audio recordings intended for voice cloning.
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set will remove background noise for voice samples using our audio isolation model. If the samples do not include background noise, it can make the quality worse.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A description of the voice.
    
</dd>
</dl>

<dl>
<dd>

**$labels:** `?array|string` — Labels for the voice. Keys can be language, accent, gender, or age.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Dubbing
<details><summary><code>$client-&gt;dubbing-&gt;list($request) -> ?DubbingMetadataPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the dubs you have access to.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->list(
    new ListDubbingRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'dubbingStatus' => ListDubbingRequestDubbingStatus::Dubbing->value,
        'dubbingStatuses' => [
            ListDubbingRequestDubbingStatusesItem::Queued->value,
        ],
        'dubbingModels' => [
            ListDubbingRequestDubbingModelsItem::DubbingV1->value,
        ],
        'targetLanguageCodes' => [
            'target_language_codes',
        ],
        'creationSources' => [
            ListDubbingRequestCreationSourcesItem::FlowNode->value,
        ],
        'filterByCreator' => ListDubbingRequestFilterByCreator::Personal->value,
        'orderBy' => ListDubbingRequestOrderBy::CreatedAt->value,
        'orderDirection' => ListDubbingRequestOrderDirection::Descending->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many dubs to return at maximum. Can not exceed 200, defaults to 100.
    
</dd>
</dl>

<dl>
<dd>

**$dubbingStatus:** `?ListDubbingRequestDubbingStatus` — What state the dub is currently in.
    
</dd>
</dl>

<dl>
<dd>

**$dubbingStatuses:** `?array` — Filter by dubbing status.
    
</dd>
</dl>

<dl>
<dd>

**$dubbingModels:** `?array` — Filter by dubbing model generation.
    
</dd>
</dl>

<dl>
<dd>

**$targetLanguageCodes:** `?array` — Filter by target language code.
    
</dd>
</dl>

<dl>
<dd>

**$creationSources:** `?array` — Filter by dubbing creation source.
    
</dd>
</dl>

<dl>
<dd>

**$filterByCreator:** `?ListDubbingRequestFilterByCreator` — Filters who created the resources being listed, whether it was the user running the request or someone else that shared the resource with them.
    
</dd>
</dl>

<dl>
<dd>

**$orderBy:** `?ListDubbingRequestOrderBy` — The field to use for ordering results from this query.
    
</dd>
</dl>

<dl>
<dd>

**$orderDirection:** `?ListDubbingRequestOrderDirection` — The order direction to use for results from this query.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;create($request) -> ?DoDubbingResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Dubs a provided audio or video file into given language.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->create(
    new BodyDubAVideoOrAnAudioFileV1DubbingPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$file:** `mixed` — A list of file paths to audio recordings intended for voice cloning
    
</dd>
</dl>

<dl>
<dd>

**$csvFile:** `mixed` — CSV file containing transcription/translation metadata
    
</dd>
</dl>

<dl>
<dd>

**$foregroundAudioFile:** `mixed` — For use only with csv input
    
</dd>
</dl>

<dl>
<dd>

**$backgroundAudioFile:** `mixed` — For use only with csv input
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$sourceUrl:** `?string` — URL of the source video/audio file.
    
</dd>
</dl>

<dl>
<dd>

**$sourceLang:** `?string` — Source language. Expects a valid iso639-1 or iso639-3 language code.
    
</dd>
</dl>

<dl>
<dd>

**$targetLang:** `string` — The Target language to dub the content into. Expects a valid iso639-1 or iso639-3 language code.
    
</dd>
</dl>

<dl>
<dd>

**$targetAccent:** `?string` — [Experimental] An accent to apply when selecting voices from the library and to use to inform translation of the dialect to prefer.
    
</dd>
</dl>

<dl>
<dd>

**$numSpeakers:** `?int` — Number of speakers to use for the dubbing. Set to 0 to automatically detect the number of speakers
    
</dd>
</dl>

<dl>
<dd>

**$watermark:** `?bool` — Whether to apply watermark to the output video.
    
</dd>
</dl>

<dl>
<dd>

**$startTime:** `?int` — Start time of the source video/audio file.
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `?int` — End time of the source video/audio file.
    
</dd>
</dl>

<dl>
<dd>

**$highestResolution:** `?bool` — Whether to use the highest resolution available.
    
</dd>
</dl>

<dl>
<dd>

**$dropBackgroundAudio:** `?bool` — An advanced setting. Whether to drop background audio from the final dub. This can improve dub quality where it's known that audio shouldn't have a background track such as for speeches or monologues.
    
</dd>
</dl>

<dl>
<dd>

**$useProfanityFilter:** `?bool` — [BETA] Whether transcripts should have profanities censored with the words '[censored]'
    
</dd>
</dl>

<dl>
<dd>

**$dubbingStudio:** `?bool` — Whether to prepare dub for edits in dubbing studio or edits as a dubbing resource.
    
</dd>
</dl>

<dl>
<dd>

**$disableVoiceCloning:** `?bool` — Instead of using a voice clone in dubbing, use a similar voice from the ElevenLabs Voice Library. Voices used from the library will contribute towards a workspace's custom voices limit, and if there aren't enough available slots the dub will fail. Using this feature requires the caller to have the 'add_voice_from_voice_library' permission on their workspace to access new voices.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?DubRequestMode` — The mode in which to run this Dubbing job. Defaults to automatic, use manual if specifically providing a CSV transcript to use. Note that manual mode is experimental and production use is strongly discouraged.
    
</dd>
</dl>

<dl>
<dd>

**$csvFps:** `?float` — Frames per second to use when parsing a CSV file for dubbing. If not provided, FPS will be inferred from timecodes.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;get($dubbingId) -> ?DubbingMetadataResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns metadata about a dubbing project, including whether it's still in progress or not
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->get(
    'dubbing_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dubbingId:** `string` — ID of the dubbing project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;delete($dubbingId) -> ?DeleteDubbingResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a dubbing project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->delete(
    'dubbing_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dubbingId:** `string` — ID of the dubbing project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Audio
<details><summary><code>$client-&gt;dubbing-&gt;audio-&gt;get($dubbingId, $languageCode) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns dub as a streamed MP3 or MP4 file. If this dub has been edited using Dubbing Studio you need to use the resource render endpoint as this endpoint only returns the original automatic dub result.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->dubbing->audio->get(
    'dubbing_id',
    'language_code',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dubbingId:** `string` — ID of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `string` — ID of the language.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Project
<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;list($request) -> ?DubbingProjectListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the dubbing projects in your workspace that you can access, newest first, cursor-paginated. Listed projects carry no `language_ids`; fetch a project, or list its language targets, to see them.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->list(
    new ListProjectRequest([
        'cursor' => 'cursor',
        'pageSize' => 20,
        'status' => 'status',
        'sortDirection' => ListProjectRequestSortDirection::Ascending->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pass the `next_cursor` from a previous response to fetch the page after it. Omit for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of projects per page. Clamped to between 1 and 100 rather than rejected, so a larger value returns a full page.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter to projects in this status: `queued`, `preparing`, `ready`, or `failed`. Omit to return every status.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?ListProjectRequestSortDirection` — Sort by creation time; newest first by default.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;create($request) -> ?DubbingProjectResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a dubbing project from an uploaded file (`file`) or a source URL (`source_url`).

Returns as soon as the project record exists, before the source has been fetched: the project starts `queued` and reaches `ready` once its source has been transcribed. Add a language target to it for each language you want, or pass `target_language` to queue the first one here.

Creating a project incurs a minimum charge of one language: you are charged for at least one language's dubbing when the project is created, before any output exists. This charge prepays the first language target — the first target you add, or the one queued via `target_language`, consumes it — and each additional language is charged separately.

Preparation can take minutes on a long source, so we recommend passing `webhook_ids` to be notified when the project turns `ready` or `failed`, rather than polling for it.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->create(
    new BodyCreateDubbingProjectV1DubbingProjectPost([
        'sourceUrl' => 'https://example.com/promo.mp4',
        'reference' => 'Q3 marketing video',
        'sourceLanguage' => 'en',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$file:** `mixed` — The source media file to dub: an audio or video file of at most 3 GiB. Provide this or `source_url`, not both.
    
</dd>
</dl>

<dl>
<dd>

**$sourceUrl:** `?string` — Public HTTP(S) URL the source media is fetched from server-side, subject to the same size and format limits as an upload. Provide this or `file`, not both.
    
</dd>
</dl>

<dl>
<dd>

**$reference:** `?string` — Optional free-form string (at most 500 characters) to identify the project on your end. Stored and echoed back verbatim; it does not affect the dub.
    
</dd>
</dl>

<dl>
<dd>

**$sourceLanguage:** `?string` — BCP-47 language tag of the source media; must be a language the transcription model supports. Any region or script subtag is ignored, since transcription is per-language. Omit to auto-detect.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?CreateProjectRequestModelId` — Dubbing model (`dubbing_v1` or `dubbing_v2`) every language target of this project is dubbed with. Defaults to `dubbing_v2`. Fixed at create time — the source is prepared for this model, so neither the project nor an individual target can change it later.
    
</dd>
</dl>

<dl>
<dd>

**$keyterms:** `?array` — Key terms to bias transcription and translation toward (for example, product or brand names). At most 1,000 terms; each term at most 50 characters and 5 words; the characters `<>{}[]\` are not allowed. Terms are trimmed and deduplicated. Repeat the field once per term, or pass a single JSON array.
    
</dd>
</dl>

<dl>
<dd>

**$webhookIds:** `?array` — IDs of workspace webhooks to notify as this project progresses — the alternative to polling, and what we recommend. Each receives a `dubbing_project_ready` or `dubbing_project_failed` event for the project, and a `dubbing_language_completed` or `dubbing_language_failed` event for every language under it; `dubbing_language_completed` carries the output download URLs. At most 3 IDs, each already configured in your workspace — see [Webhooks](https://elevenlabs.io/docs/eleven-api/resources/webhooks) for how to create one and verify its signature. Repeat the field once per ID, or pass a single JSON array or comma-separated string. Delivery is best-effort and can repeat, so we recommend handling events idempotently.
    
</dd>
</dl>

<dl>
<dd>

**$targetLanguage:** `?string` — Optional shortcut: also create a language target in this BCP-47 language, queued to start once the project is ready — equivalent to creating the project and then creating one language target. Must be one of the [languages the dubbing model supports](https://elevenlabs.io/docs/help-center/product/dubbing/which-languages-are-supported-in-dubbing), and a region-qualified tag must be one of the supported dialects. This is the first language target, so it consumes the project's minimum charge rather than adding to it. Its ID is returned in `language_ids`.
    
</dd>
</dl>

<dl>
<dd>

**$transcript:** `mixed` — Enterprise only. Optional JSON transcript to use instead of transcribing the source: a `{"segments": [...]}` document, at most 20,000 segments and 4 MiB. See [Bring your own transcript](https://elevenlabs.io/docs/eleven-api/guides/how-to/dubbing/bring-your-own-transcript) for the segment fields and their constraints. `source_language` is required whenever a transcript is provided. If any segment carries a `translation`, `target_language` is required and every segment must carry one; those translations seed the target created via `target_language`, which then skips machine translation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;get($projectId) -> ?DubbingProjectResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Full project detail, including the IDs of every language target under it. To follow a project to `ready`, we recommend a `webhook_ids` subscription rather than polling this endpoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->get(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project to fetch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;delete($projectId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a project, every language target under it, and their stored media and outputs. This cannot be undone, and a dub already running is still billed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->delete(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Language
<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;list($projectId, $request) -> ?DubbingLanguageListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List a project's language targets, cursor-paginated, each with signed output URLs once it has produced an output.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->list(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    new ListLanguageRequest([
        'cursor' => 'cursor',
        'pageSize' => 20,
        'status' => 'status',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the parent dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Pass the `next_cursor` from a previous response to fetch the page after it. Omit for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of language targets per page. Clamped to between 1 and 100 rather than rejected, so a larger value returns a full page.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?string` — Filter to targets in this status: `queued`, `processing`, `completed`, `stale`, or `failed`. Omit to return every status.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;create($projectId, $request) -> ?DubbingLanguageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add a language to dub a project into, and queue the dub.

This is the call that produces dubbed audio, and it is billed per generation. The target is created `queued` and starts as soon as the project is `ready`, so it can be added at any point after the project is created. It inherits the project's dubbing model and cannot pick another.

A project created with `webhook_ids` sends a `dubbing_language_completed` event carrying the output download URLs, so we recommend subscribing rather than polling this target to completion.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->create(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    new BodyCreateDubbingLanguageTargetV1DubbingProjectProjectIdLanguagePost([
        'targetLanguage' => 'es',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the parent dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$targetLanguage:** `string` — BCP-47 language tag to dub the project into (for example, `fr` or `es-MX`). Must be one of the [languages the project's dubbing model supports](https://elevenlabs.io/docs/help-center/product/dubbing/which-languages-are-supported-in-dubbing), and a region-qualified tag must be one of the supported dialects.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?VoiceSettings` — Voice settings applied to every speaker in this language. Omit to use the defaults.
    
</dd>
</dl>

<dl>
<dd>

**$translations:** `?array` — Enterprise only. Optional translations to use instead of machine translation. A map from each source segment's `external_id` (or its `id`, if you supplied none) to the translated text; every source segment must be covered exactly once. At most 20,000 entries, totaling at most 4 MiB of text. See [Bring your own transcript](https://elevenlabs.io/docs/eleven-api/guides/how-to/dubbing/bring-your-own-transcript).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;get($projectId, $languageId) -> ?DubbingLanguageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Full language-target detail. Once the target reports `completed`, `outputs` carries the signed download URLs. To learn when that happens, we recommend the project's `webhook_ids` subscription rather than polling this endpoint; fetch here when a delivered URL has expired, or to reconcile after an edit.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->get(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the parent dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target to fetch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;delete($projectId, $languageId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a language target and its outputs, leaving the project and its other languages intact. This cannot be undone, and a dub already running is still billed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->delete(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the parent dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target to delete.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Transcript
<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;transcript-&gt;get($projectId, $languageId) -> ?DubbingTargetTranscriptResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

A language target's transcript: source segments with their translations. Available once the target has produced an output. Returns a conflict while the target is still on its first dub, since it has no translations to return yet.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->transcript->get(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;transcript-&gt;updateSegment($projectId, $languageId, $segmentId, $request) -> ?DubbingTargetSegmentUpdateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Edit a segment's translation for a language target. Omitted fields are left unchanged; an explicit null clears the field. Bumps the target's `revision` and marks it `stale` if it had already completed. The source transcript and the project's other languages are untouched, and no audio changes until you regenerate the target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->transcript->updateSegment(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
    '0199a3f0-1c2d-7abc-8def-0123456789ab',
    new DubbingTargetSegmentUpdateRequest([
        'translation' => 'Bienvenido a nuestra última demostración de producto.',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target.
    
</dd>
</dl>

<dl>
<dd>

**$segmentId:** `string` — Identifier of the segment to edit.
    
</dd>
</dl>

<dl>
<dd>

**$translation:** `?string` — New translated text, or null to mark the segment for re-translation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;transcript-&gt;updateSegments($projectId, $languageId, $request) -> ?DubbingBulkTargetSegmentUpdateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Edit several segments' translations for a language target in one atomic request: every edit applies or none does. Bumps the target's `revision` and marks it `stale` if it had already completed. The source transcript and the project's other languages are untouched, and no audio changes until you regenerate the target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->transcript->updateSegments(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
    new DubbingBulkTargetSegmentUpdateRequest([
        'segments' => [
            '0199a3f0-1c2d-7abc-8def-0123456789ab' => new DubbingTargetSegmentUpdateRequest([
                'translation' => 'Bienvenido a nuestra última demostración de producto.',
            ]),
            '0199a3f0-3e4f-7abc-8def-0123456789cd' => new DubbingTargetSegmentUpdateRequest([
                'translation' => 'Empecemos.',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target.
    
</dd>
</dl>

<dl>
<dd>

**$segments:** `array` — Map of segment ID to the translation edit to apply to that segment. At least one entry and at most 500.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;language-&gt;transcript-&gt;regenerate($projectId, $languageId) -> ?DubbingRegenerateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Re-dub a target from its edited transcript, re-synthesizing only the edited regions (charged like a generation, less the free-regeneration allowance). Accepted asynchronously: the target returns to `processing` and sends a `dubbing_language_completed` event to the project's `webhook_ids` when the re-dub lands, carrying the new output URLs. Returns a conflict when the target has no edits to apply — nothing is dispatched and nothing is charged.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->language->transcript->regenerate(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    'lang_1001kwkyxp0je6ktn4knsfrasx5s',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageId:** `string` — Identifier of the language target.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Transcript
<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;transcript-&gt;get($projectId) -> ?DubbingSourceTranscriptResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

The project's source transcript, as editable segments. Available once the project is `ready`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->transcript->get(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;transcript-&gt;updateSegment($projectId, $segmentId, $request) -> ?DubbingSourceSegmentUpdateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Edit a source segment's text, speaker, or timing. Omitted fields are left unchanged. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->transcript->updateSegment(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    '0199a3f0-1c2d-7abc-8def-0123456789ab',
    new DubbingSegmentUpdateRequest([
        'text' => 'Welcome to our latest product demo.',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$segmentId:** `string` — Identifier of the segment to edit.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `?string` — New text for the segment.
    
</dd>
</dl>

<dl>
<dd>

**$speakerId:** `?string` — New speaker ID for the segment.
    
</dd>
</dl>

<dl>
<dd>

**$startS:** `?float` — New start time, in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$endS:** `?float` — New end time, in seconds.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;transcript-&gt;deleteSegment($projectId, $segmentId) -> ?DubbingTranscriptRevisionResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Remove a source segment from the transcript so it is no longer dubbed. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->transcript->deleteSegment(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    '0199a3f0-1c2d-7abc-8def-0123456789ab',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$segmentId:** `string` — Identifier of the segment to remove.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;transcript-&gt;updateSegments($projectId, $request) -> ?DubbingBulkSourceSegmentUpdateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Edit several source segments' text, speaker, or timing in one atomic request: every edit applies or none does. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->transcript->updateSegments(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    new DubbingBulkSegmentUpdateRequest([
        'segments' => [
            '0199a3f0-1c2d-7abc-8def-0123456789ab' => new DubbingSegmentUpdateRequest([
                'text' => 'Welcome to our latest product demo.',
            ]),
            '0199a3f0-3e4f-7abc-8def-0123456789cd' => new DubbingSegmentUpdateRequest([
                'speakerId' => 'narrator',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$segments:** `array` — Map of segment ID to the partial update to apply to that segment. At least one entry and at most 500.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;dubbing-&gt;project-&gt;transcript-&gt;createSegment($projectId, $request) -> ?DubbingSourceSegmentUpdateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Enterprise only. Add a new source segment to the transcript. Its span must lie within the source media, last between 0.1 and 25 seconds, and not overlap another segment by the same speaker. Bumps the project's `revision`, discards the affected translations in every language target, and marks any target that had already completed `stale`. No audio changes until you regenerate a target.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->project->transcript->createSegment(
    'proj_1601kwkyxp0hfzvtmyxwqxx6mcy3',
    new DubbingSegmentCreateRequest([
        'text' => 'Thanks for watching.',
        'speakerId' => 'default_speaker',
        'startS' => 42,
        'endS' => 44,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — Identifier of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text of the new segment.
    
</dd>
</dl>

<dl>
<dd>

**$speakerId:** `string` — Identifier of the segment's speaker.
    
</dd>
</dl>

<dl>
<dd>

**$startS:** `float` — Start time of the segment, in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$endS:** `float` — End time of the segment, in seconds.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Transcripts
<details><summary><code>$client-&gt;dubbing-&gt;transcripts-&gt;get($dubbingId, $languageCode, $formatType) -> ?DubbingTranscriptsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Fetch the transcript for one of the languages in a dub.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->dubbing->transcripts->get(
    'dubbing_id',
    'source',
    GetTranscriptsRequestFormatType::Srt->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dubbingId:** `string` — ID of the dubbing project.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `string` — ISO-693 language code to retrieve the transcript for. Use 'source' to fetch the transcript of the original media.
    
</dd>
</dl>

<dl>
<dd>

**$formatType:** `string` — Format to return transcript in. For subtitles use either 'srt' or 'webvtt', and for a full transcript use 'json'. The 'json' format is not yet supported for Dubbing Studio.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Agents
<details><summary><code>$client-&gt;agents-&gt;create($request) -> ?CreateAgentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an agent from a config object
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->create(
    new BodyCreateAgentV1ConvaiAgentsCreatePost([
        'enableVersioning' => true,
        'conversationConfig' => new ConversationalConfig([]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enableVersioning:** `?bool` — Deprecated: all agents are versioned. This parameter is ignored.
    
</dd>
</dl>

<dl>
<dd>

**$conversationConfig:** `ConversationalConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$platformSettings:** `?AgentPlatformSettingsRequestModel` — Platform settings for the agent are all settings that aren't related to the conversation orchestration and content.
    
</dd>
</dl>

<dl>
<dd>

**$workflow:** `?AgentWorkflowRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A name to make the agent easier to find
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Tags to help classify and filter the agent
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;get($agentId, $request) -> ?GetAgentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve config for an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new GetAgentsRequest([
        'versionId' => 'agtvrsn_8901k4t9z5defmb8vh3e9361y7nj',
        'branchId' => 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
        'includeProcedureGeneratedWorkflowElements' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — The ID of the agent version to use
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — The ID of the branch to use
    
</dd>
</dl>

<dl>
<dd>

**$includeProcedureGeneratedWorkflowElements:** `?bool` — Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;update($agentId, $request) -> ?GetAgentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Patches an Agent settings
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->update(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new UpdateAgentRequest([
        'enableVersioningIfNotEnabled' => true,
        'branchId' => 'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
        'includeProcedureGeneratedWorkflowElements' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$enableVersioningIfNotEnabled:** `?bool` — Deprecated: all agents are versioned. This parameter is ignored.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — The ID of the branch to use
    
</dd>
</dl>

<dl>
<dd>

**$includeProcedureGeneratedWorkflowElements:** `?bool` — Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
    
</dd>
</dl>

<dl>
<dd>

**$conversationConfig:** `?ConversationalConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$platformSettings:** `?AgentPlatformSettingsRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$workflow:** `?AgentWorkflowRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A name to make the agent easier to find
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Tags to help classify and filter the agent
    
</dd>
</dl>

<dl>
<dd>

**$versionDescription:** `?string` — Description for this version when publishing changes (only applicable for versioned agents)
    
</dd>
</dl>

<dl>
<dd>

**$procedures:** `?array` — Procedure versions to publish, keyed by procedure_id. When provided, this map replaces the procedures from the current draft or branch tip. When omitted or null, unpublished procedure edits are used if present; otherwise, the branch tip's procedures are retained. Pass an empty object to remove all procedures.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;delete($agentId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->delete(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new DeleteAgentsRequest([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — If set to true, the agent is deleted even if other agents use it as a subagent, and it is removed from those agents and their branches.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;list($request) -> ?GetAgentsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of your agents and their metadata.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->list(
    new ListAgentsRequest([
        'pageSize' => 1,
        'search' => 'search',
        'archived' => false,
        'showOnlyOwnedAgents' => true,
        'createdByUserId' => 'created_by_user_id',
        'tags' => [
            'Customer Support',
        ],
        'sortDirection' => SortDirection::Asc->value,
        'sortBy' => AgentSortBy::Name->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many Agents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search by agents name.
    
</dd>
</dl>

<dl>
<dd>

**$archived:** `?bool` — Filter agents by archived status
    
</dd>
</dl>

<dl>
<dd>

**$showOnlyOwnedAgents:** `?bool` — If set to true, the endpoint will omit any agents that were shared with you by someone else and include only the ones you own. Deprecated: use created_by_user_id instead.
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter agents by creator user ID. When set, only agents created by this user are returned. Takes precedence over show_only_owned_agents. Use '@me' to refer to the authenticated user.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Filter agents by tag. Repeat the parameter to match any of several tags.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?AgentSortBy` — The field to sort the results by
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;duplicate($agentId, $request) -> ?CreateAgentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new agent by duplicating an existing one. The new agent gets a copy of every unarchived branch of the source agent, each with the same name and description and starting from the latest version on that branch. The live traffic split is copied onto the new branches, with any share held by a branch that was not copied moved to main. Version history, drafts, archived branches, past traffic splits and experiments are not copied.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->duplicate(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyDuplicateAgentV1ConvaiAgentsAgentIdDuplicatePost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A name to make the agent easier to find
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;runTests($agentId, $request) -> ?GetTestSuiteInvocationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Run selected tests on the agent with provided configuration. If the agent configuration is provided, it will be used to override default agent configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->runTests(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new RunAgentTestsRequestModel([
        'tests' => [
            new SingleTestRunRequestModel([
                'testId' => 'test_id',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Optional name for the test invocation.
    
</dd>
</dl>

<dl>
<dd>

**$tests:** `array` — List of tests to run on the agent
    
</dd>
</dl>

<dl>
<dd>

**$agentConfigOverride:** `?AdhocAgentConfigOverrideForTestRequestModel` — Configuration overrides to use for testing. If not provided, the agent's default configuration will be used.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — ID of the branch to run the tests on. If not provided, the tests will be run on the agent's main branch.
    
</dd>
</dl>

<dl>
<dd>

**$repeatCount:** `?int` — Number of times to run each test. When greater than 1, results are grouped and summarized.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;ragIndexOverview() -> ?RagIndexOverviewResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Provides total size and other information of RAG indexes used by knowledgebase documents
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->ragIndexOverview();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;getDocumentRagIndexes($documentationId) -> ?RagDocumentIndexesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Provides information about all RAG indexes of the specified knowledgebase document.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->getDocumentRagIndexes(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;deleteDocumentRagIndex($documentationId, $ragIndexId) -> ?RagDocumentIndexResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete RAG index for the knowledgebase document.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->deleteDocumentRagIndex(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$ragIndexId:** `string` — The id of RAG index of document from the knowledge base.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Conversations
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;getSignedUrl($request) -> ?ConversationSignedUrlResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a signed url to start a conversation with an agent with an agent that requires authorization
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->getSignedUrl(
    new GetSignedUrlConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'includeConversationId' => true,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'environment' => 'environment',
        'debugEventsRequest' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$includeConversationId:** `?bool` — Whether to include a conversation_id with the response. If included, the conversation_signature cannot be used again.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — The ID of the branch to use
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — The ID of the version to use
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — The environment to use for resolving environment variables (e.g. 'production', 'staging'). Defaults to 'production'.
    
</dd>
</dl>

<dl>
<dd>

**$debugEventsRequest:** `?bool` — Whether to enable debug events. Only available for users with editor access to the agent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;getWebrtcToken($request) -> ?TokenResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a WebRTC session token for real-time communication.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->getWebrtcToken(
    new GetWebrtcTokenConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'participantName' => 'participant_name',
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'environment' => 'environment',
        'debugEventsRequest' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$participantName:** `?string` — Optional custom participant name. If not provided, user ID will be used
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — The ID of the branch to use
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — The ID of the version to use
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — The environment to use for resolving environment variables (e.g. 'production', 'staging'). Defaults to 'production'.
    
</dd>
</dl>

<dl>
<dd>

**$debugEventsRequest:** `?bool` — Whether to enable debug events. Only available for users with editor access to the agent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;list($request) -> ?GetConversationsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all conversations of agents that user owns. With option to restrict to a specific agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->list(
    new ListConversationsRequest([
        'cursor' => 'cursor',
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'visitedAgentIds' => [
            'visited_agent_ids',
        ],
        'visitedAgentBranchIds' => [
            'visited_agent_branch_ids',
        ],
        'triggeredProcedureIds' => [
            'triggered_procedure_ids',
        ],
        'callSuccessful' => EvaluationResultFilter::Success->value,
        'callStartBeforeUnix' => 1,
        'callStartAfterUnix' => 1,
        'callDurationMinSecs' => 1,
        'callDurationMaxSecs' => 1,
        'ratingMax' => 1,
        'ratingMin' => 1,
        'hasFeedbackComment' => true,
        'userId' => 'user_id',
        'evaluationParams' => [
            'evaluation_params',
        ],
        'dataCollectionParams' => [
            'data_collection_params',
        ],
        'dynamicVariableParams' => [
            'dynamic_variable_params',
        ],
        'dataCollectionFilter' => 'data_collection_filter',
        'dynamicVariableFilter' => 'dynamic_variable_filter',
        'dataCollectionIds' => [
            'data_collection_ids',
        ],
        'evaluationCriteriaIds' => [
            'evaluation_criteria_ids',
        ],
        'toolNames' => [
            'tool_names',
        ],
        'toolNamesSuccessful' => [
            'tool_names_successful',
        ],
        'toolNamesErrored' => [
            'tool_names_errored',
        ],
        'toolIds' => [
            'tool_ids',
        ],
        'toolIdsSuccessful' => [
            'tool_ids_successful',
        ],
        'toolIdsErrored' => [
            'tool_ids_errored',
        ],
        'includeInvalidToolCalls' => true,
        'mainLanguages' => [
            'main_languages',
        ],
        'phoneNumberIds' => [
            'phone_number_ids',
        ],
        'whatsappPhoneNumberIds' => [
            'whatsapp_phone_number_ids',
        ],
        'pageSize' => 1,
        'summaryMode' => ListConversationsRequestSummaryMode::Exclude->value,
        'search' => 'search',
        'conversationInitiationSource' => ConversationInitiationSource::Unknown->value,
        'textOnly' => true,
        'conversationProductType' => ConversationProduct::Agents->value,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'parentConversationId' => 'parent_conversation_id',
        'topicIds' => [
            'topic_ids',
        ],
        'excludeStatuses' => [
            ListConversationsRequestExcludeStatusesItem::Initiated->value,
        ],
        'tagIds' => [
            'tag_ids',
        ],
        'workflowNodeEnteredId' => 'workflow_node_entered_id',
        'terminationReasons' => [
            'termination_reasons',
        ],
        'guardrailTypes' => [
            GuardrailType::Custom->value,
        ],
        'customGuardrailNames' => [
            'custom_guardrail_names',
        ],
        'sortDirection' => SortDirection::Asc->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$visitedAgentIds:** `?array` — Filter conversations where any of these agents participated. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$visitedAgentBranchIds:** `?array` — Filter conversations where any of these agent branches participated. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$triggeredProcedureIds:** `?array` — Filter conversations where any of these procedures were triggered. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$callSuccessful:** `?EvaluationResultFilter` — The result of the success evaluation
    
</dd>
</dl>

<dl>
<dd>

**$callStartBeforeUnix:** `?int` — Unix timestamp (in seconds) to filter conversations up to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$callStartAfterUnix:** `?int` — Unix timestamp (in seconds) to filter conversations after to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$callDurationMinSecs:** `?int` — Minimum call duration in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$callDurationMaxSecs:** `?int` — Maximum call duration in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$ratingMax:** `?int` — Maximum overall rating (1-5).
    
</dd>
</dl>

<dl>
<dd>

**$ratingMin:** `?int` — Minimum overall rating (1-5).
    
</dd>
</dl>

<dl>
<dd>

**$hasFeedbackComment:** `?bool` — Filter conversations with user feedback comments.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — Filter conversations by the user ID who initiated them.
    
</dd>
</dl>

<dl>
<dd>

**$evaluationParams:** `?array` — Evaluation filters. Repeat param. Format: criteria_id:result where result is one of success|failure|unknown. Example: eval=value_framing:success
    
</dd>
</dl>

<dl>
<dd>

**$dataCollectionParams:** `?array` — Data collection filters. Repeat param. Format: id:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the field was not collected (id:eq:), and neq with an empty value matches where it was (id:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value.
    
</dd>
</dl>

<dl>
<dd>

**$dynamicVariableParams:** `?array` — Dynamic variable filters. Repeat param. Format: name:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the variable was not set (name:eq:), and neq with an empty value matches where it was (name:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value. Names containing ':' cannot be expressed.
    
</dd>
</dl>

<dl>
<dd>

**$dataCollectionFilter:** `?string` — A single data collection filter, for callers that can only send one scalar value per query param. Same format as data_collection_params (id:op:value); combined with it when both are given.
    
</dd>
</dl>

<dl>
<dd>

**$dynamicVariableFilter:** `?string` — A single dynamic variable filter, for callers that can only send one scalar value per query param. Same format as dynamic_variable_params (name:op:value); combined with it when both are given.
    
</dd>
</dl>

<dl>
<dd>

**$dataCollectionIds:** `?array` — Data collection field IDs to include in each conversation summary. Repeat param. When omitted, data_collection_results is not returned.
    
</dd>
</dl>

<dl>
<dd>

**$evaluationCriteriaIds:** `?array` — Evaluation criteria IDs to include in each conversation summary. Repeat param. When omitted, evaluation_criteria_results is not returned.
    
</dd>
</dl>

<dl>
<dd>

**$toolNames:** `?array` — Filter conversations by tool names used during the call.
    
</dd>
</dl>

<dl>
<dd>

**$toolNamesSuccessful:** `?array` — Filter conversations by tool names that had successful calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolNamesErrored:** `?array` — Filter conversations by tool names that had errored calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolIds:** `?array` — Filter conversations by IDs of tools used during the call. Use '__system_<tool_name>' for system tools. Unlike tool_names, distinguishes between tools that share a name.
    
</dd>
</dl>

<dl>
<dd>

**$toolIdsSuccessful:** `?array` — Filter conversations by IDs of tools that had successful calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolIdsErrored:** `?array` — Filter conversations by IDs of tools that had errored calls.
    
</dd>
</dl>

<dl>
<dd>

**$includeInvalidToolCalls:** `?bool` — Also match tool calls that never ran.
    
</dd>
</dl>

<dl>
<dd>

**$mainLanguages:** `?array` — Filter conversations by detected main language (language code).
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumberIds:** `?array` — Filter conversations by agent phone number IDs.
    
</dd>
</dl>

<dl>
<dd>

**$whatsappPhoneNumberIds:** `?array` — Filter conversations by agent WhatsApp number IDs.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many conversations to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$summaryMode:** `?ListConversationsRequestSummaryMode` — Whether to include transcript summaries in the response.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Full-text or fuzzy search over transcript messages
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationSource:** `?ConversationInitiationSource` 
    
</dd>
</dl>

<dl>
<dd>

**$textOnly:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationProductType:** `?ConversationProduct` — Restrict results to a single conversation product surface.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter conversations by branch ID.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — Filter conversations by version ID.
    
</dd>
</dl>

<dl>
<dd>

**$parentConversationId:** `?string` — Filter conversations by parent conversation ID for subagent conversations.
    
</dd>
</dl>

<dl>
<dd>

**$topicIds:** `?array` — Filter conversations by topic IDs assigned during topic discovery.
    
</dd>
</dl>

<dl>
<dd>

**$excludeStatuses:** `?array` — Exclude conversations with the given statuses. Useful for hiding in-progress / processing conversations from list views.
    
</dd>
</dl>

<dl>
<dd>

**$tagIds:** `?array` — Filter conversations by conversation tag IDs assigned via the conversation-tags endpoints.
    
</dd>
</dl>

<dl>
<dd>

**$workflowNodeEnteredId:** `?string` — Filter conversations to only those that entered the given node.
    
</dd>
</dl>

<dl>
<dd>

**$terminationReasons:** `?array` — Filter conversations by their stored termination_reason (metadata.termination_reason). Repeat param to match any of several.
    
</dd>
</dl>

<dl>
<dd>

**$guardrailTypes:** `?array` — Filter to conversations where a guardrail of any of these types triggered (metadata.triggered_guardrails.guardrail_type). Repeat param to match any of several.
    
</dd>
</dl>

<dl>
<dd>

**$customGuardrailNames:** `?array` — Filter to conversations where a custom guardrail with any of these names triggered (metadata.triggered_guardrails.guardrail_name). Only custom guardrails carry a name. Repeat param to match any of several.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort conversations by call start time. Defaults to descending (newest first).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;resolve($request) -> ?GetConversationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resolve a conversation URL (a Slack message URL or a Zendesk ticket URL) to the deterministic conversation ID for the given agent, then confirm the conversation exists.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->resolve(
    new ResolveConversationsRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'reference' => 'https://your-domain.zendesk.com/agent/tickets/12345',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$reference:** `string` — A Slack message URL or a Zendesk ticket URL.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;get($conversationId, $request) -> ?GetConversationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the details of a particular conversation
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->get(
    '21m00Tcm4TlvDq8ikWAM',
    new GetConversationsRequest([
        'format' => GetConversationsRequestFormat::Json->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>

<dl>
<dd>

**$format:** `?GetConversationsRequestFormat` — Response format. Defaults to 'json'. Set to 'opentelemetry' for an OTLP-compatible trace payload using the same structure as the post-call webhook.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;delete($conversationId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a particular conversation
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->delete(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;getSummary($conversationId, $request) -> ?GetConversationSummaryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a lightweight summary of a conversation: its title, the generated transcript summary, whether the call was successful, and — only when the conversation is short — the plain chat messages. Tool calls, tool results, and contextual updates are omitted so the response stays small. Use this instead of the full conversation endpoint when you only need the gist (e.g. an agent reading many conversations); use GET /v1/convai/conversations/{conversation_id} when you need the full transcript with tool calls and contextual updates.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->getSummary(
    '21m00Tcm4TlvDq8ikWAM',
    new GetSummaryConversationsRequest([
        'maxMessages' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>

<dl>
<dd>

**$maxMessages:** `?int` — Maximum number of chat message turns to include inline. When the conversation has more than this, the messages are omitted and messages_omitted is set.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;getSipMessages($conversationId, $request) -> ?GetSipLogMessagesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get SIP messages associated with a conversation's phone call
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->getSipMessages(
    '21m00Tcm4TlvDq8ikWAM',
    new GetSipMessagesConversationsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Audio
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;audio-&gt;get($conversationId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the audio recording of a particular conversation
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->agents->conversations->audio->get(
    '21m00Tcm4TlvDq8ikWAM',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Files
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;files-&gt;get($conversationId, $fileId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Download a file the user attached to a conversation, including while the conversation is still active.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->agents->conversations->files->get(
    '21m00Tcm4TlvDq8ikWAM',
    'file_id',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>

<dl>
<dd>

**$fileId:** `string` — The file ID returned when it was uploaded.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;files-&gt;delete($conversationId, $fileId) -> ?ConvAiFileUploadResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a file upload from a conversation. Only possible if the file hasn't already been used in the conversation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->files->delete(
    'conversation_id',
    'file_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$fileId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;files-&gt;create($conversationId, $request) -> ?ConvAiFileUploadResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Upload an image, PDF, or text file for a conversation. Returns a unique file ID that can be used to reference the file in the conversation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->files->create(
    'conversation_id',
    new BodyUploadFileV1ConvaiConversationsConversationIdFilesPost([
        'file' => File::createFromString("example_file", "example_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — Image, PDF, or text file to upload
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Feedback
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;feedback-&gt;create($conversationId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send the feedback for the given conversation
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->feedback->create(
    '21m00Tcm4TlvDq8ikWAM',
    new ConversationFeedbackRequestModel([
        'feedback' => UserFeedbackScore::Like->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of the conversation you're taking the action on.
    
</dd>
</dl>

<dl>
<dd>

**$feedback:** `?UserFeedbackScore` — Either 'like' or 'dislike' to indicate the feedback for the conversation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Messages
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;messages-&gt;textSearch($request) -> ?MessagesSearchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Search through conversation transcript messages by full-text and fuzzy search
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->messages->textSearch(
    new TextSearchMessagesRequest([
        'textQuery' => 'refund policy',
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'visitedAgentIds' => [
            'visited_agent_ids',
        ],
        'visitedAgentBranchIds' => [
            'visited_agent_branch_ids',
        ],
        'triggeredProcedureIds' => [
            'triggered_procedure_ids',
        ],
        'callSuccessful' => EvaluationResultFilter::Success->value,
        'callStartBeforeUnix' => 1,
        'callStartAfterUnix' => 1,
        'callDurationMinSecs' => 1,
        'callDurationMaxSecs' => 1,
        'ratingMax' => 1,
        'ratingMin' => 1,
        'hasFeedbackComment' => true,
        'userId' => 'user_id',
        'evaluationParams' => [
            'evaluation_params',
        ],
        'dataCollectionParams' => [
            'data_collection_params',
        ],
        'dynamicVariableParams' => [
            'dynamic_variable_params',
        ],
        'toolNames' => [
            'tool_names',
        ],
        'toolNamesSuccessful' => [
            'tool_names_successful',
        ],
        'toolNamesErrored' => [
            'tool_names_errored',
        ],
        'toolIds' => [
            'tool_ids',
        ],
        'toolIdsSuccessful' => [
            'tool_ids_successful',
        ],
        'toolIdsErrored' => [
            'tool_ids_errored',
        ],
        'includeInvalidToolCalls' => true,
        'mainLanguages' => [
            'main_languages',
        ],
        'phoneNumberIds' => [
            'phone_number_ids',
        ],
        'whatsappPhoneNumberIds' => [
            'whatsapp_phone_number_ids',
        ],
        'excludeStatuses' => [
            TextSearchMessagesRequestExcludeStatusesItem::Initiated->value,
        ],
        'terminationReasons' => [
            'termination_reasons',
        ],
        'pageSize' => 1,
        'summaryMode' => TextSearchMessagesRequestSummaryMode::Exclude->value,
        'conversationInitiationSource' => ConversationInitiationSource::Unknown->value,
        'textOnly' => true,
        'conversationProductType' => ConversationProduct::Agents->value,
        'branchId' => 'branch_id',
        'versionId' => 'version_id',
        'topicIds' => [
            'topic_ids',
        ],
        'sortBy' => MessageSearchSortBy::SearchScore->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$textQuery:** `string` — The search query text for full-text and fuzzy matching
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$visitedAgentIds:** `?array` — Filter conversations where any of these agents participated. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$visitedAgentBranchIds:** `?array` — Filter conversations where any of these agent branches participated. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$triggeredProcedureIds:** `?array` — Filter conversations where any of these procedures were triggered. Can not exceed 50 values.
    
</dd>
</dl>

<dl>
<dd>

**$callSuccessful:** `?EvaluationResultFilter` — The result of the success evaluation
    
</dd>
</dl>

<dl>
<dd>

**$callStartBeforeUnix:** `?int` — Unix timestamp (in seconds) to filter conversations up to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$callStartAfterUnix:** `?int` — Unix timestamp (in seconds) to filter conversations after to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$callDurationMinSecs:** `?int` — Minimum call duration in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$callDurationMaxSecs:** `?int` — Maximum call duration in seconds.
    
</dd>
</dl>

<dl>
<dd>

**$ratingMax:** `?int` — Maximum overall rating (1-5).
    
</dd>
</dl>

<dl>
<dd>

**$ratingMin:** `?int` — Minimum overall rating (1-5).
    
</dd>
</dl>

<dl>
<dd>

**$hasFeedbackComment:** `?bool` — Filter conversations with user feedback comments.
    
</dd>
</dl>

<dl>
<dd>

**$userId:** `?string` — Filter conversations by the user ID who initiated them.
    
</dd>
</dl>

<dl>
<dd>

**$evaluationParams:** `?array` — Evaluation filters. Repeat param. Format: criteria_id:result where result is one of success|failure|unknown. Example: eval=value_framing:success
    
</dd>
</dl>

<dl>
<dd>

**$dataCollectionParams:** `?array` — Data collection filters. Repeat param. Format: id:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the field was not collected (id:eq:), and neq with an empty value matches where it was (id:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value.
    
</dd>
</dl>

<dl>
<dd>

**$dynamicVariableParams:** `?array` — Dynamic variable filters. Repeat param. Format: name:op:value where op is one of eq|neq|gt|gte|lt|lte|in. For in, pipe-delimit values. An empty value matches conversations where the variable was not set (name:eq:), and neq with an empty value matches where it was (name:neq:). eq is exact equality. gt|gte|lt|lte require a numeric value. Names containing ':' cannot be expressed.
    
</dd>
</dl>

<dl>
<dd>

**$toolNames:** `?array` — Filter conversations by tool names used during the call.
    
</dd>
</dl>

<dl>
<dd>

**$toolNamesSuccessful:** `?array` — Filter conversations by tool names that had successful calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolNamesErrored:** `?array` — Filter conversations by tool names that had errored calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolIds:** `?array` — Filter conversations by IDs of tools used during the call. Use '__system_<tool_name>' for system tools. Unlike tool_names, distinguishes between tools that share a name.
    
</dd>
</dl>

<dl>
<dd>

**$toolIdsSuccessful:** `?array` — Filter conversations by IDs of tools that had successful calls.
    
</dd>
</dl>

<dl>
<dd>

**$toolIdsErrored:** `?array` — Filter conversations by IDs of tools that had errored calls.
    
</dd>
</dl>

<dl>
<dd>

**$includeInvalidToolCalls:** `?bool` — Also match tool calls that never ran.
    
</dd>
</dl>

<dl>
<dd>

**$mainLanguages:** `?array` — Filter conversations by detected main language (language code).
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumberIds:** `?array` — Filter conversations by agent phone number IDs.
    
</dd>
</dl>

<dl>
<dd>

**$whatsappPhoneNumberIds:** `?array` — Filter conversations by agent WhatsApp number IDs.
    
</dd>
</dl>

<dl>
<dd>

**$excludeStatuses:** `?array` — Exclude conversations with the given statuses. Useful for hiding in-progress / processing conversations from list views.
    
</dd>
</dl>

<dl>
<dd>

**$terminationReasons:** `?array` — Filter conversations by their stored termination_reason (metadata.termination_reason). Repeat param to match any of several.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of results per page. Max 50.
    
</dd>
</dl>

<dl>
<dd>

**$summaryMode:** `?TextSearchMessagesRequestSummaryMode` — Whether to include transcript summaries in the response.
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationSource:** `?ConversationInitiationSource` 
    
</dd>
</dl>

<dl>
<dd>

**$textOnly:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationProductType:** `?ConversationProduct` — Restrict results to a single conversation product surface.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter conversations by branch ID.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — Filter conversations by version ID.
    
</dd>
</dl>

<dl>
<dd>

**$topicIds:** `?array` — Filter conversations by topic IDs assigned during topic discovery.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?MessageSearchSortBy` — Sort order for search results. 'search_score' sorts by search score, 'created_at' sorts by conversation start time.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;messages-&gt;search($request) -> ?MessagesSearchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Search conversation transcripts by semantic similarity to surface relevant messages based on meaning and intent, rather than exact keyword matches
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->messages->search(
    new SearchMessagesRequest([
        'textQuery' => 'Customer asking to cancel and get money back',
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'branchId' => 'branch_id',
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$textQuery:** `string` — The search query text for semantic similarity matching
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter conversations by branch ID.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of results per page. Max 50.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tags
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;assign($conversationId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Assign one or more conversation tags to a conversation. Tags that are already assigned are ignored. Tags must belong to the same workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->assign(
    'conversation_id',
    new AssignConversationTagsRequestModel([
        'tagIds' => [
            'tag_ids',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$tagIds:** `array` — Tag IDs to add to the conversation. Re-assigning an existing tag is a no-op.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;unassign($conversationId, $tagId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a single conversation tag from a conversation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->unassign(
    'conversation_id',
    'tag_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$tagId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;list($request) -> ?GetConversationTagsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List conversation tags for the workspace, ordered by most recently created first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->list(
    new ListTagsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many conversation tags to return. Can not exceed 100.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;create($request) -> ?ConversationTagResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new conversation tag for the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->create(
    new CreateConversationTagRequestModel([
        'title' => 'title',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$title:** `string` — Display title of the tag.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Optional free-text description.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;get($tagId) -> ?ConversationTagResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a conversation tag by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->get(
    'tag_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$tagId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;update($tagId, $request) -> ?ConversationTagResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a conversation tag's title and/or description. Restricted to the tag owner or a workspace admin.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->update(
    'tag_id',
    new PatchConversationTagRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$tagId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — If provided, replaces the tag title. Omit to leave unchanged.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — If provided, replaces the tag description. Omit to leave unchanged.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;tags-&gt;delete($tagId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a conversation tag. Restricted to the tag owner or a workspace admin.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->tags->delete(
    'tag_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$tagId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Topics
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;topics-&gt;get($agentId, $request) -> ?GetAgentTopicsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the latest topic discovery run results for a given agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->topics->get(
    'agent_id',
    new GetTopicsRequest([
        'pageSize' => 1,
        'sortBy' => TopicSortBy::Conversations->value,
        'sortDirection' => SortDirection::Asc->value,
        'fromUnixSecs' => 1,
        'toUnixSecs' => 1,
        'includeEvaluationCriteria' => true,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — ID of the agent
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of top-level topic groups to return.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?TopicSortBy` — Column to rank topics by. Use conversations for volume, sentiment with sort_direction=asc for the most negative topics, and frustration with sort_direction=desc for the most frustrated ones. Topics with no score are always ranked last.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — Direction to sort topics.
    
</dd>
</dl>

<dl>
<dd>

**$fromUnixSecs:** `?int` — Start of the window to view topics for. When set with to_unix_secs, the completed daily topic-discovery runs in the range are aggregated together, so the window scopes the metrics as well as the topic set. Floored to the start of its UTC day because runs cover whole UTC days; aggregated_run_count reports how many runs were summed. Omit both bounds to get the single latest run.
    
</dd>
</dl>

<dl>
<dd>

**$toUnixSecs:** `?int` — End of the window to view topics for.
    
</dd>
</dl>

<dl>
<dd>

**$includeEvaluationCriteria:** `?bool` — Include the per-criteria evaluation breakdown on each topic's metrics. Pass false to drop it: it dominates the payload and the weighted success_rate is returned either way.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Analysis
<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;analysis-&gt;run($conversationId) -> ?GetConversationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Run the analysis for a conversation using the agent's current evaluation criteria and data collection settings.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->analysis->run(
    'conversation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — ID of the conversation
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;conversations-&gt;analysis-&gt;runEvaluation($conversationId, $request) -> ?GetConversationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rerun a specific evaluation for a conversation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->conversations->analysis->runEvaluation(
    'conversation_id',
    new RunConversationEvaluationsRequest([
        'evaluationId' => 'evaluation_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — ID of the conversation
    
</dd>
</dl>

<dl>
<dd>

**$evaluationId:** `string` — ID of the single evaluation criterion to rerun.
    
</dd>
</dl>

<dl>
<dd>

**$scope:** `?AnalysisScope` 
    
</dd>
</dl>

<dl>
<dd>

**$evaluatedAgentId:** `?string` — ID of the agent whose evaluation result to rerun, for conversations that transferred between agents. If omitted, a conversation-scoped evaluation reruns for the agent that started the conversation.
    
</dd>
</dl>

<dl>
<dd>

**$evaluatedBranchId:** `?string` — Branch of `evaluated_agent_id` whose evaluation result to rerun, for conversations that visited the agent on more than one branch. If omitted, the result reruns for every branch of that agent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Settings
<details><summary><code>$client-&gt;agents-&gt;settings-&gt;get() -> ?GetConvAiSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve Convai settings for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->settings->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;settings-&gt;update($request) -> ?GetConvAiSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update Convai settings for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->settings->update(
    new PatchConvAiSettingsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationInitiationClientDataWebhook:** `?ConversationInitiationClientDataWebhook` 
    
</dd>
</dl>

<dl>
<dd>

**$webhooks:** `?ConvAiWebhooks` 
    
</dd>
</dl>

<dl>
<dd>

**$canUseMcpServers:** `?bool` — Whether the workspace can use MCP servers
    
</dd>
</dl>

<dl>
<dd>

**$ragRetentionPeriodDays:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationEmbeddingRetentionDays:** `?int` — Days to retain conversation embeddings. None means use the system default (30 days).
    
</dd>
</dl>

<dl>
<dd>

**$defaultLivekitStack:** `?LivekitStackType` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Settings
<details><summary><code>$client-&gt;agents-&gt;dashboard-&gt;settings-&gt;get() -> ?GetConvAiDashboardSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve Convai dashboard settings for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->dashboard->settings->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;dashboard-&gt;settings-&gt;update($request) -> ?GetConvAiDashboardSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update Convai dashboard settings for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->dashboard->settings->update(
    new PatchConvAiDashboardSettingsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$charts:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Twilio
<details><summary><code>$client-&gt;agents-&gt;twilio-&gt;outboundCall($request) -> ?TwilioOutboundCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Handle an outbound call via Twilio
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->twilio->outboundCall(
    new BodyHandleAnOutboundCallViaTwilioV1ConvaiTwilioOutboundCallPost([
        'agentId' => 'agent_id',
        'agentPhoneNumberId' => 'agent_phone_number_id',
        'toNumber' => 'to_number',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentPhoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$toNumber:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>

<dl>
<dd>

**$callRecordingEnabled:** `?bool` — Whether let Twilio record the call.
    
</dd>
</dl>

<dl>
<dd>

**$telephonyCallConfig:** `?TelephonyCallConfigInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;twilio-&gt;registerCall($request) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Register a Twilio call and return TwiML to connect the call
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->twilio->registerCall(
    new BodyRegisterATwilioCallAndReturnTwiMlV1ConvaiTwilioRegisterCallPost([
        'agentId' => 'agent_id',
        'fromNumber' => 'from_number',
        'toNumber' => 'to_number',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$fromNumber:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$toNumber:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$direction:** `?TelephonyDirection` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Exotel
<details><summary><code>$client-&gt;agents-&gt;exotel-&gt;outboundCall($request) -> ?ExotelOutboundCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Handle an outbound call via Exotel Connect API
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->exotel->outboundCall(
    new BodyHandleAnOutboundCallViaExotelV1ConvaiExotelOutboundCallPost([
        'agentId' => 'agent_id',
        'agentPhoneNumberId' => 'agent_phone_number_id',
        'toNumber' => 'to_number',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentPhoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$toNumber:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>

<dl>
<dd>

**$telephonyCallConfig:** `?TelephonyCallConfigInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Whatsapp
<details><summary><code>$client-&gt;agents-&gt;whatsapp-&gt;outboundCall($request) -> ?WhatsAppOutboundCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Make an outbound call via WhatsApp
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsapp->outboundCall(
    new BodyMakeAnOutboundCallViaWhatsAppV1ConvaiWhatsappOutboundCallPost([
        'whatsappPhoneNumberId' => 'whatsapp_phone_number_id',
        'whatsappUserId' => 'whatsapp_user_id',
        'whatsappCallPermissionRequestTemplateName' => 'whatsapp_call_permission_request_template_name',
        'whatsappCallPermissionRequestTemplateLanguageCode' => 'whatsapp_call_permission_request_template_language_code',
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$whatsappPhoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$whatsappUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$whatsappCallPermissionRequestTemplateName:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$whatsappCallPermissionRequestTemplateLanguageCode:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;whatsapp-&gt;outboundMessage($request) -> ?WhatsAppOutboundMessageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Send an outbound message via WhatsApp
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsapp->outboundMessage(
    new BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePost([
        'whatsappPhoneNumberId' => 'whatsapp_phone_number_id',
        'whatsappUserId' => 'whatsapp_user_id',
        'templateName' => 'template_name',
        'templateLanguageCode' => 'template_language_code',
        'templateParams' => [
            BodySendAnOutboundMessageViaWhatsAppV1ConvaiWhatsappOutboundMessagePostTemplateParamsItem::header(new WhatsAppTemplateHeaderComponentParams([
                'parameters' => [
                    WhatsAppTemplateHeaderComponentParamsParametersItem::text(new WhatsAppTemplateTextParam([
                        'text' => 'text',
                    ])),
                ],
            ])),
        ],
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$whatsappPhoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$whatsappUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$templateName:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$templateLanguageCode:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$templateParams:** `array` 
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Summaries
<details><summary><code>$client-&gt;agents-&gt;summaries-&gt;get($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns summaries for the specified agents.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->summaries->get(
    new GetSummariesRequest([
        'agentIds' => [
            'agent_ids',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentIds:** `array` — List of agent IDs to fetch summaries for
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## KnowledgeBase
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;size($agentId) -> ?GetAgentKnowledgebaseSizeResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the number of pages in the agent's knowledge base.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->size(
    'agent_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;list($request) -> ?GetKnowledgeBaseListResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of available knowledge base documents
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->list(
    new ListKnowledgeBaseRequest([
        'pageSize' => 1,
        'search' => 'search',
        'showOnlyOwnedDocuments' => true,
        'createdByUserId' => 'created_by_user_id',
        'types' => [
            KnowledgeBaseDocumentType::File->value,
        ],
        'parentFolderId' => 'parent_folder_id',
        'ancestorFolderId' => 'ancestor_folder_id',
        'foldersFirst' => true,
        'sortDirection' => SortDirection::Asc->value,
        'sortBy' => KnowledgeBaseSortBy::Name->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — If specified, the endpoint returns only such knowledge base documents whose names start with this string.
    
</dd>
</dl>

<dl>
<dd>

**$showOnlyOwnedDocuments:** `?bool` — If set to true, the endpoint will return only documents owned by you (and not shared from somebody else). Deprecated: use created_by_user_id instead.
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter documents by creator user ID. When set, only documents created by this user are returned. Takes precedence over show_only_owned_documents. Use '@me' to refer to the authenticated user.
    
</dd>
</dl>

<dl>
<dd>

**$types:** `?array` — If present, the endpoint will return only documents of the given types.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the endpoint will return only documents that are direct children of the given folder.
    
</dd>
</dl>

<dl>
<dd>

**$ancestorFolderId:** `?string` — If set, the endpoint will return only documents that are descendants of the given folder.
    
</dd>
</dl>

<dl>
<dd>

**$foldersFirst:** `?bool` — Whether folders should be returned first in the list of documents.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?KnowledgeBaseSortBy` — The field to sort the results by
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;getOrCreateRagIndexes($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves and/or creates RAG indexes for multiple knowledge base documents in a single request. Maximum 100 items per request.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->getOrCreateRagIndexes(
    new BodyComputeRagIndexesInBatchV1ConvaiKnowledgeBaseRagIndexPost([
        'items' => [
            new GetOrCreateRagIndexRequestModel([
                'documentId' => 'document_id',
                'createIfMissing' => true,
                'model' => EmbeddingModelEnum::E5Mistral7BInstruct->value,
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$items:** `array` — List of requested RAG indexes. Minimum 1, maximum 100 items.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;search($request) -> ?KnowledgeBaseContentSearchResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Fuzzy text search over knowledge base document content
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->search(
    new SearchKnowledgeBaseRequest([
        'query' => 'query',
        'pageSize' => 1,
        'types' => [
            KnowledgeBaseDocumentType::File->value,
        ],
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$query:** `string` — The search query text
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$types:** `?array` — If present, the endpoint will return only documents of the given types.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Documents
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;createFromUrl($request) -> ?AddKnowledgeBaseResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a knowledge base document generated by scraping the given webpage.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->createFromUrl(
    new BodyCreateUrlDocumentV1ConvaiKnowledgeBaseUrlPost([
        'url' => 'url',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$url:** `string` — URL to a page of documentation that the agent will have access to in order to interact with users.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A custom, human-readable name for the document.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the created document or folder will be placed inside the given folder.
    
</dd>
</dl>

<dl>
<dd>

**$enableAutoSync:** `?bool` — Whether to enable auto-sync for this URL document.
    
</dd>
</dl>

<dl>
<dd>

**$autoRemove:** `?bool` — Whether to automatically remove the document if the URL becomes unavailable. Only applicable when auto-sync is enabled.
    
</dd>
</dl>

<dl>
<dd>

**$minimumFrequencyDays:** `?int` — Minimum frequency (in days) at which the document is refreshed. The actual interval may be shorter, never longer. Defaults to 7, tightened to the parent folder's frequency if that is stricter. Only applicable when auto-sync is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;createFromFile($request) -> ?AddKnowledgeBaseResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a knowledge base document generated form the uploaded file.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->createFromFile(
    new BodyCreateFileDocumentV1ConvaiKnowledgeBaseFilePost([
        'file' => File::createFromString("example_file", "example_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$file:** `mixed` — Documentation that the agent will have access to in order to interact with users.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A custom, human-readable name for the document.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the created document or folder will be placed inside the given folder.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;createFromText($request) -> ?AddKnowledgeBaseResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a knowledge base document containing the provided text.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->createFromText(
    new BodyCreateTextDocumentV1ConvaiKnowledgeBaseTextPost([
        'text' => 'text',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$text:** `string` — Text content to be added to the knowledge base.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A custom, human-readable name for the document.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the created document or folder will be placed inside the given folder.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;createFolder($request) -> ?AddKnowledgeBaseResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a folder used for grouping documents together.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->createFolder(
    new BodyCreateFolderV1ConvaiKnowledgeBaseFolderPost([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — A custom, human-readable name for the document.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the created document or folder will be placed inside the given folder.
    
</dd>
</dl>

<dl>
<dd>

**$enableAutoSync:** `?bool` — Whether to enable auto-sync for this URL document.
    
</dd>
</dl>

<dl>
<dd>

**$autoRemove:** `?bool` — Whether to automatically remove the document if the URL becomes unavailable. Only applicable when auto-sync is enabled.
    
</dd>
</dl>

<dl>
<dd>

**$minimumFrequencyDays:** `?int` — Minimum frequency (in days) at which the underlying eligible documents are refreshed. The actual interval may be shorter, never longer. Defaults to 7, tightened to the parent folder's frequency if that is stricter. Only applicable when auto-sync is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;get($documentationId, $request) -> ?GetDocumentsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get details about a specific documentation making up the agent's knowledge base
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->get(
    '21m00Tcm4TlvDq8ikWAM',
    new GetDocumentsRequest([
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;update($documentationId, $request) -> ?UpdateDocumentsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the name, content and/or auto-sync settings of a document.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateDocumentV1ConvaiKnowledgeBaseDocumentationIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — A custom, human-readable name for the document.
    
</dd>
</dl>

<dl>
<dd>

**$content:** `?string` — Updated content for the document. Only supported for text documents, URL documents with auto-sync disabled, and file documents that are not synced from an external source.
    
</dd>
</dl>

<dl>
<dd>

**$enableAutoSync:** `?bool` — Whether the document or folder is refreshed automatically. Only applicable to URL documents, folders, and externally-synced files. Leave unset to keep the current value.
    
</dd>
</dl>

<dl>
<dd>

**$autoRemove:** `?bool` — Whether to automatically remove the document once its source is no longer available. Only applicable when auto-sync is enabled. Leave unset to keep the current value.
    
</dd>
</dl>

<dl>
<dd>

**$minimumFrequencyDays:** `?int` — Minimum frequency (in days) at which the document is refreshed. The actual interval may be shorter, never longer. Only applicable when auto-sync is enabled. Leave unset to keep the current value.
    
</dd>
</dl>

<dl>
<dd>

**$tightenOnly:** `?bool` — Folders only. When true, items already in the folder are only tightened to stay at least as strict as the folder, and keep any setting that is stricter than the folder's. When false, they are set to exactly the folder's auto-sync settings. Ignored for externally synced folders, whose contents always follow the folder's schedule.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;delete($documentationId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a document or folder from the knowledge base.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->delete(
    '21m00Tcm4TlvDq8ikWAM',
    new DeleteDocumentsRequest([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — If set to true, the document or folder will be deleted regardless of whether it is used by any agents and it will be removed from the dependent agents. For non-empty folders, this will also delete all child documents and folders.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;getAgents($documentationId, $request) -> ?GetKnowledgeBaseDependentAgentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of agents depending on this knowledge base document
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->getAgents(
    '21m00Tcm4TlvDq8ikWAM',
    new GetAgentsDocumentsRequest([
        'dependentType' => KnowledgeBaseDependentType::Direct->value,
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$dependentType:** `?KnowledgeBaseDependentType` — Type of dependent agents to return.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;getBulkAgents($request) -> ?GetKnowledgeBaseDependentAgentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of agents depending on any of the given knowledge base documents.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->getBulkAgents(
    new BodyGetDependentAgentsForMultipleDocumentsV1ConvaiKnowledgeBaseDependentAgentsPost([
        'dependentType' => KnowledgeBaseDependentType::Direct->value,
        'pageSize' => 1,
        'cursor' => 'cursor',
        'documentIds' => [
            '21m00Tcm4TlvDq8ikWAM',
            '31m00Tcm4TlvDq8ikWBM',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dependentType:** `?KnowledgeBaseDependentType` — Type of dependent agents to return.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$documentIds:** `array` — The ids of documents or folders from the knowledge base.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;getContent($documentationId) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the entire content of a document from the knowledge base
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->getContent(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;getSourceFileUrl($documentationId) -> ?KnowledgeBaseSourceFileUrlResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a signed URL to download the original source file of a file-type document from the knowledge base
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->getSourceFileUrl(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;move($documentId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Moves the entity from one folder to another.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->move(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyMoveEntityToFolderV1ConvaiKnowledgeBaseDocumentIdMovePost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$moveTo:** `?string` — The folder to move the entities to. If not set, the entities will be moved to the root folder.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;bulkMove($request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Moves multiple entities from one folder to another.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->bulkMove(
    new BodyBulkMoveEntitiesToFolderV1ConvaiKnowledgeBaseBulkMovePost([
        'documentIds' => [
            '21m00Tcm4TlvDq8ikWAM',
            '31m00Tcm4TlvDq8ikWBM',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentIds:** `array` — The ids of documents or folders from the knowledge base.
    
</dd>
</dl>

<dl>
<dd>

**$moveTo:** `?string` — The folder to move the entities to. If not set, the entities will be moved to the root folder.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;bulkDelete($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete multiple documents or folders from the knowledge base. Each id succeeds or fails independently.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->bulkDelete(
    new BodyBulkDeleteKnowledgeBaseDocumentsV1ConvaiKnowledgeBaseBulkDeletePost([
        'documentIds' => [
            '21m00Tcm4TlvDq8ikWAM',
            '31m00Tcm4TlvDq8ikWBM',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentIds:** `array` — The ids of documents or folders from the knowledge base.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — If set to true, documents or folders will be deleted regardless of whether they are used by any agents and will be removed from the dependent agents. For non-empty folders, this will also delete all child documents and folders.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Summaries
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;summaries-&gt;get($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets multiple knowledge base document summaries by their IDs.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->summaries->get(
    new GetSummariesRequest([
        'documentIds' => [
            '21m00Tcm4TlvDq8ikWAM',
            '31n11Udm5UmwEr9jkXBN',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentIds:** `array` — The ids of knowledge base documents.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Chunk
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;chunk-&gt;get($documentationId, $chunkId, $request) -> ?KnowledgeBaseDocumentChunkResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get details about a specific documentation part used by RAG.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->chunk->get(
    '21m00Tcm4TlvDq8ikWAM',
    'chunk_id',
    new GetChunkRequest([
        'embeddingModel' => EmbeddingModelEnum::E5Mistral7BInstruct->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$chunkId:** `string` — The id of a document RAG chunk from the knowledge base.
    
</dd>
</dl>

<dl>
<dd>

**$embeddingModel:** `?EmbeddingModelEnum` — The embedding model used to retrieve the chunk.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Chunks
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;documents-&gt;chunks-&gt;list($documentationId, $request) -> ?KnowledgeBaseDocumentChunksResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all RAG chunks for a specific knowledge base document.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->documents->chunks->list(
    '21m00Tcm4TlvDq8ikWAM',
    new ListChunksRequest([
        'embeddingModel' => EmbeddingModelEnum::E5Mistral7BInstruct->value,
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$embeddingModel:** `EmbeddingModelEnum` — The embedding model used to retrieve the chunk.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## CrawlJobs
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;crawlJobs-&gt;list($request) -> ?ListCrawlJobsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of ongoing and recent crawl jobs for the user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->crawlJobs->list(
    new ListCrawlJobsRequest([
        'includeJobIds' => [
            'include_job_ids',
        ],
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$includeJobIds:** `?array` — Ids of additional crawl jobs to retrieve
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;crawlJobs-&gt;create($request) -> ?CreateCrawlJobResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a crawl job to crawl the given URL with specified depth and page limits.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->crawlJobs->create(
    new BodyCreateCrawlJobV1ConvaiKnowledgeBaseCrawlPost([
        'url' => 'url',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$url:** `string` — URL to a page of documentation that the agent will have access to in order to interact with users.
    
</dd>
</dl>

<dl>
<dd>

**$maxDepth:** `?int` — Deprecated - this field is a no-op and will be removed in a future version.
    
</dd>
</dl>

<dl>
<dd>

**$maxPages:** `?int` — Maximum number of pages to crawl (1-10,000), defaults to 1000.
    
</dd>
</dl>

<dl>
<dd>

**$pattern:** `?string` — If set, only URLs that match this pattern are included.
    
</dd>
</dl>

<dl>
<dd>

**$excludePatterns:** `?array` — If set, URLs that match any of these patterns are skipped, even if they match `pattern`.
    
</dd>
</dl>

<dl>
<dd>

**$sitemapUrls:** `?array` — List of URLs to crawl from sitemap (optional, overrides automatic URL discovery).
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — If set, the created document or folder will be placed inside the given folder.
    
</dd>
</dl>

<dl>
<dd>

**$enableAutoSync:** `?bool` — Whether to enable auto-sync for this URL document.
    
</dd>
</dl>

<dl>
<dd>

**$autoRemove:** `?bool` — Whether to automatically remove the document if the URL becomes unavailable. Only applicable when auto-sync is enabled.
    
</dd>
</dl>

<dl>
<dd>

**$autoDiscover:** `?bool` — Automatically discover and add new pages during auto-sync: pages linked from already-crawled pages for website crawls, or new sitemap entries matching `pattern` and `exclude_patterns` for sitemap crawls. Requires enable_auto_sync=true.
    
</dd>
</dl>

<dl>
<dd>

**$minimumFrequencyDays:** `?int` — Minimum frequency (in days) at which the underlying eligible documents are refreshed. The actual interval may be shorter, never longer. Defaults to 7, tightened to the parent folder's frequency if that is stricter. Only applicable when auto-sync is enabled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;crawlJobs-&gt;get($crawlJobId) -> ?GetCrawlJobResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get details about a specific crawl job including status and progress.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->crawlJobs->get(
    'crawl_job_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$crawlJobId:** `string` — The id of the crawl job to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;crawlJobs-&gt;cancel($crawlJobId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a crawl job and delete all associated documents and folders.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->crawlJobs->cancel(
    'crawl_job_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$crawlJobId:** `string` — The id of the crawl job to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Document
<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;document-&gt;updateFile($documentationId, $request) -> ?UpdateFileDocumentResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the source file of a file document. The document name, content, and metadata are updated to reflect the new file. Any manual content edits will be overwritten.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->document->updateFile(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateFileDocumentV1ConvaiKnowledgeBaseDocumentationIdUpdateFilePatch([
        'file' => File::createFromString("example_file", "example_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — Documentation that the agent will have access to in order to interact with users.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;document-&gt;refresh($documentationId) -> ?RefreshDocumentResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Manually refresh a URL document by re-fetching its content from the source URL.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->document->refresh(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;knowledgeBase-&gt;document-&gt;computeRagIndex($documentationId, $request) -> ?RagDocumentIndexResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

In case the document is not RAG indexed, it triggers rag indexing task, otherwise it just returns the current status.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->knowledgeBase->document->computeRagIndex(
    '21m00Tcm4TlvDq8ikWAM',
    new RagIndexRequestModel([
        'model' => EmbeddingModelEnum::E5Mistral7BInstruct->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$documentationId:** `string` — The id of a document from the knowledge base. This is returned on document addition.
    
</dd>
</dl>

<dl>
<dd>

**$model:** `EmbeddingModelEnum` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Widget
<details><summary><code>$client-&gt;agents-&gt;widget-&gt;get($agentId, $request) -> ?GetAgentEmbedResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the widget configuration for an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->widget->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new GetWidgetRequest([
        'conversationSignature' => 'conversation_signature',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$conversationSignature:** `?string` — An expiring token that enables a websocket conversation to start. These can be generated for an agent using the /v1/convai/conversation/get_signed_url endpoint
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Avatar
<details><summary><code>$client-&gt;agents-&gt;widget-&gt;avatar-&gt;create($agentId, $request) -> ?PostAgentAvatarResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sets the avatar for an agent displayed in the widget
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->widget->avatar->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyPostAgentAvatarV1ConvaiAgentsAgentIdAvatarPost([
        'avatarFile' => File::createFromString("example_avatar_file", "example_avatar_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$avatarFile:** `mixed` — An image file to be used as the agent's avatar.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Link
<details><summary><code>$client-&gt;agents-&gt;link-&gt;get($agentId) -> ?GetAgentLinkResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the current link used to share the agent with others
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->link->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## HoldAudio
<details><summary><code>$client-&gt;agents-&gt;holdAudio-&gt;create($agentId, $request) -> ?PostAgentHoldAudioResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sets the custom hold audio played on loop to callers waiting in the agent's concurrency wait queue. Replaces any previously uploaded clip.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->holdAudio->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyPostAgentHoldAudioV1ConvaiAgentsAgentIdHoldAudioPost([
        'holdAudioFile' => File::createFromString("example_hold_audio_file", "example_hold_audio_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$holdAudioFile:** `mixed` — An MP3 or WAV file played on loop to callers waiting in the agent's concurrency wait queue. Maximum size 40 MB, maximum duration 180 seconds.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;holdAudio-&gt;delete($agentId) -> ?DeleteAgentHoldAudioResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes the agent's custom hold audio; queued callers hear the default hold tone again.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->holdAudio->delete(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## LlmUsage
<details><summary><code>$client-&gt;agents-&gt;llmUsage-&gt;calculateForAgent($agentId, $request) -> ?LlmUsageCalculatorResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Calculates expected number of LLM tokens needed for the specified agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->llmUsage->calculateForAgent(
    'agent_id',
    new LlmUsageCalculatorRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$promptLength:** `?int` — Length of the prompt in characters.
    
</dd>
</dl>

<dl>
<dd>

**$numberOfPages:** `?int` — Pages of content in pdf documents OR urls in agent's Knowledge Base.
    
</dd>
</dl>

<dl>
<dd>

**$ragEnabled:** `?bool` — Whether RAG is enabled.
    
</dd>
</dl>

<dl>
<dd>

**$serviceTier:** `?LlmServiceTier` — Service tier to price against. Only affects models that offer the tier; others fall back to their standard price.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;llmUsage-&gt;calculate($request) -> ?LlmUsageCalculatorResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of LLM models and the expected cost for using them based on the provided values.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->llmUsage->calculate(
    new LlmUsageCalculatorPublicRequestModel([
        'promptLength' => 1,
        'numberOfPages' => 1,
        'ragEnabled' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$promptLength:** `int` — Length of the prompt in characters.
    
</dd>
</dl>

<dl>
<dd>

**$numberOfPages:** `int` — Pages of content in PDF documents or URLs in the agent's knowledge base.
    
</dd>
</dl>

<dl>
<dd>

**$ragEnabled:** `bool` — Whether RAG is enabled.
    
</dd>
</dl>

<dl>
<dd>

**$serviceTier:** `?LlmServiceTier` — Service tier to price against. Only affects models that offer the tier; others fall back to their standard price.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tests
<details><summary><code>$client-&gt;agents-&gt;tests-&gt;create($request) -> ?CreateAgentTestResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new agent response test.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->create(
    new CreateResponseUnitTestRequest([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateTestsRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;move($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Moves multiple tests or folders from one folder to another.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->move(
    new BodyBulkMoveTestsToFolderV1ConvaiAgentTestingBulkMovePost([
        'entityIds' => [
            'entity_ids',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$entityIds:** `array` — The IDs of tests or folders to move.
    
</dd>
</dl>

<dl>
<dd>

**$moveTo:** `?string` — The folder to move the entities to. If not set, the entities will be moved to the root folder.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;get($testId) -> ?GetTestsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an agent response test by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->get(
    'TeaqRRdTcIfIu2i7BYfT',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testId:** `string` — The id of a chat response test. This is returned on test creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;update($testId, $request) -> ?UpdateTestsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates an agent response test by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->update(
    'TeaqRRdTcIfIu2i7BYfT',
    new UpdateResponseUnitTestRequest([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testId:** `string` — The id of a chat response test. This is returned on test creation.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UpdateTestsRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;delete($testId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an agent response test by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->delete(
    'TeaqRRdTcIfIu2i7BYfT',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testId:** `string` — The id of a chat response test. This is returned on test creation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;summaries($request) -> ?GetTestsSummariesByIdsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets agent response test summaries for the requested test IDs.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->summaries(
    new ListTestsByIdsRequestModel([
        'testIds' => [
            'test_id_1',
            'test_id_2',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testIds:** `array` — List of test IDs to fetch. No duplicates allowed. Prefer at most 1000 IDs per request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;list($request) -> ?GetTestsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists all agent response tests with pagination support and optional search filtering.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->list(
    new ListTestsRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'search' => 'search',
        'parentFolderId' => 'parent_folder_id',
        'types' => [
            TestType::Llm->value,
        ],
        'includeFolders' => true,
        'sortMode' => ListTestsRequestSortMode::Default_->value,
        'sharingMode' => TestSharingMode::All->value,
        'createdByUserId' => 'created_by_user_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many Tests to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search query to filter tests and folders by name.
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — Filter by parent folder ID. Use 'root' to get items in the root folder.
    
</dd>
</dl>

<dl>
<dd>

**$types:** `?array` — If present, the endpoint will return only tests/folders of the given types.
    
</dd>
</dl>

<dl>
<dd>

**$includeFolders:** `?bool` — Deprecated. Use the `types` query param and include `folder` instead.
    
</dd>
</dl>

<dl>
<dd>

**$sortMode:** `?ListTestsRequestSortMode` — Sort mode for listing tests. Use 'folders_first' to place folders before tests.
    
</dd>
</dl>

<dl>
<dd>

**$sharingMode:** `?TestSharingMode` — Filter test visibility. Use `shared_with_me` to return only tests/folders shared with the current user that they did not create.
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter tests and folders by creator user ID. Use '@me' to refer to the authenticated user.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Folders
<details><summary><code>$client-&gt;agents-&gt;tests-&gt;folders-&gt;create($request) -> ?CreateAgentTestFolderResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a folder for organizing agent tests.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->folders->create(
    new BodyCreateAgentTestFolderV1ConvaiAgentTestingFoldersPost([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the folder to create
    
</dd>
</dl>

<dl>
<dd>

**$parentFolderId:** `?string` — The ID of the parent folder. If not provided, the folder will be created at the root level.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;folders-&gt;get($folderId) -> ?GetAgentTestFolderResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets an agent test folder by ID, including its folder path.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->folders->get(
    'tfld_7301khxdkycse5f88fzjdtrterzm',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$folderId:** `string` — The folder ID.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;folders-&gt;update($folderId, $request) -> ?GetAgentTestFolderResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates an agent test folder. Currently only supports updating the folder name.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->folders->update(
    'tfld_7301khxdkycse5f88fzjdtrterzm',
    new BodyUpdateAgentTestFolderV1ConvaiAgentTestingFoldersFolderIdPatch([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$folderId:** `string` — The folder ID.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The new name for the folder
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;folders-&gt;delete($folderId, $request)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes an agent test folder by ID. Use force=true to delete a non-empty folder and all its contents.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->folders->delete(
    'tfld_7301khxdkycse5f88fzjdtrterzm',
    new DeleteFoldersRequest([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$folderId:** `string` — The folder ID.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — Force delete. Required for deleting non-empty folders.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Invocations
<details><summary><code>$client-&gt;agents-&gt;tests-&gt;invocations-&gt;list($request) -> ?GetTestInvocationsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists all test invocations with pagination support and optional search filtering.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->invocations->list(
    new ListInvocationsRequest([
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'createdByUserId' => 'created_by_user_id',
        'testId' => 'test_id',
        'startTime' => 1,
        'endTime' => 1,
        'versionId' => 'version_id',
        'pageSize' => 1,
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `?string` — Filter by agent ID
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter by branch ID
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter by test run creator user ID
    
</dd>
</dl>

<dl>
<dd>

**$testId:** `?string` — Filter to invocations that include a run of this test id
    
</dd>
</dl>

<dl>
<dd>

**$startTime:** `?int` — Inclusive lower bound on created_at, in unix seconds
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `?int` — Inclusive upper bound on created_at, in unix seconds
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — Filter by the agent version the tests ran against
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many Tests to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search query to filter tests and folders by name.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;invocations-&gt;get($testInvocationId) -> ?GetTestSuiteInvocationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a test invocation by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->invocations->get(
    'test_invocation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testInvocationId:** `string` — The id of a test invocation. This is returned when tests are run.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;invocations-&gt;update($testInvocationId, $request) -> ?GetTestSuiteInvocationResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the user-provided name of a test invocation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->invocations->update(
    'test_invocation_id',
    new UpdateTestSuiteInvocationRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testInvocationId:** `string` — The id of a test invocation. This is returned when tests are run.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — New name for the test invocation. Set to null to restore the generated title.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;invocations-&gt;cancel($testInvocationId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancels all pending runs in a test invocation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->invocations->cancel(
    'test_invocation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testInvocationId:** `string` — The id of a test invocation. This is returned when tests are run.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tests-&gt;invocations-&gt;resubmit($testInvocationId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resubmits specific test runs from a test invocation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tests->invocations->resubmit(
    'test_invocation_id',
    new ResubmitTestsRequestModel([
        'testRunIds' => [
            'test_run_ids',
        ],
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$testInvocationId:** `string` — The id of a test invocation. This is returned when tests are run.
    
</dd>
</dl>

<dl>
<dd>

**$testRunIds:** `array` — List of test run IDs to resubmit
    
</dd>
</dl>

<dl>
<dd>

**$agentConfigOverride:** `?AdhocAgentConfigOverrideForTestRequestModel` — Configuration overrides to use for testing. If not provided, the agent's default configuration will be used.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `string` — Agent ID to resubmit tests for
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — ID of the branch to run the tests on. If not provided, the tests will be run on the agent's main branch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Users
<details><summary><code>$client-&gt;agents-&gt;users-&gt;list($request) -> ?GetConversationUsersPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get distinct users from conversations with pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->users->list(
    new ListUsersRequest([
        'agentId' => 'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
        'branchId' => 'branch_id',
        'callStartBeforeUnix' => 1,
        'callStartAfterUnix' => 1,
        'search' => 'search',
        'pageSize' => 1,
        'sortBy' => UsersSortBy::LastContactUnixSecs->value,
        'sortDirection' => SortDirection::Asc->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `?string` — Agent id (agent_…) or speech engine external id (seng_), resolved to the same underlying resource.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter conversations by branch ID.
    
</dd>
</dl>

<dl>
<dd>

**$callStartBeforeUnix:** `?int` — Unix timestamp (in seconds) to filter conversations up to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$callStartAfterUnix:** `?int` — Unix timestamp (in seconds) to filter conversations after to this start date.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search/filter by user ID (exact match).
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many users to return at maximum. Defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?UsersSortBy` — The field to sort the results by. Defaults to last_contact_unix_secs.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TriageTickets
<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;list($agentId, $request) -> ?GetAgentConversationTicketsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List an agent's conversation triage tickets, ordered by most recently created first unless sorted by priority. These are tickets about the agent's own performance on a conversation (for triage with Architect), not tickets an agent opens for end users.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->list(
    'agent_id',
    new ListTriageTicketsRequest([
        'pageSize' => 1,
        'conversationId' => 'conversation_id',
        'status' => AgentConversationTicketStatus::Open->value,
        'sources' => [
            AgentConversationTicketSource::Qa->value,
        ],
        'priorities' => [
            AgentConversationTicketPriority::Low->value,
        ],
        'sortBy' => AgentConversationTicketSortBy::CreatedAt->value,
        'ownerUserId' => 'owner_user_id',
        'assigneeUserId' => 'assignee_user_id',
        'issueType' => AgentConversationTicketIssueType::KnowledgeGap->value,
        'label' => 'label',
        'mergedIntoTicketId' => 'merged_into_ticket_id',
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many agent conversation tickets to return. Can not exceed 100.
    
</dd>
</dl>

<dl>
<dd>

**$conversationId:** `?string` — Filter tickets by conversation id.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?AgentConversationTicketStatus` — Filter tickets by status.
    
</dd>
</dl>

<dl>
<dd>

**$sources:** `?array` — Filter tickets by how they were raised (qa, agent, manual). Repeat the parameter to filter by multiple sources.
    
</dd>
</dl>

<dl>
<dd>

**$priorities:** `?array` — Filter tickets by priority. Repeat the parameter to filter by multiple priorities.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?AgentConversationTicketSortBy` — Order by most recently created, by priority (most urgent first, then most recently created), or by most recently reported (the newest report merged into the issue, else its creation).
    
</dd>
</dl>

<dl>
<dd>

**$ownerUserId:** `?string` — Filter tickets by creator. Use 'agent' for agent-raised tickets.
    
</dd>
</dl>

<dl>
<dd>

**$assigneeUserId:** `?string` — Filter tickets by assignee. Use 'unassigned' for tickets with no assignee.
    
</dd>
</dl>

<dl>
<dd>

**$issueType:** `?AgentConversationTicketIssueType` — Filter clusters by issue type.
    
</dd>
</dl>

<dl>
<dd>

**$label:** `?string` — Filter tickets by an exact label.
    
</dd>
</dl>

<dl>
<dd>

**$mergedIntoTicketId:** `?string` — Filter tickets merged into this ticket.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Case-insensitive free-text search across the ticket's title, description, comments, and turn comments.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;createManual($agentId, $request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Manually raise a follow-up ticket against an agent, not tied to any conversation (for example a task like 'add the KB about X'). Without a title, one is derived from the comment. Requires viewer access to the agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->createManual(
    'agent_id',
    new CreateManualTicketRequestModel([
        'qaComment' => 'qa_comment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — One-line headline shown in the triage list. Defaults to one derived from qa_comment.
    
</dd>
</dl>

<dl>
<dd>

**$qaComment:** `string` — What the ticket is about, e.g. a follow-up task for the agent.
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?AgentConversationTicketPriority` — How urgently the ticket needs attention.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;listForWorkspace($request) -> ?GetAgentConversationTicketsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List conversation triage tickets across every agent in the workspace, ordered by most recently created first. Use this to build a workspace-wide view (for example, tickets assigned to the caller). Supports the same filters, sorting and search as the per-agent endpoint. Tickets for agents the caller cannot access are omitted.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->listForWorkspace(
    new ListForWorkspaceTriageTicketsRequest([
        'pageSize' => 1,
        'agentId' => 'agent_id',
        'status' => AgentConversationTicketStatus::Open->value,
        'sources' => [
            AgentConversationTicketSource::Qa->value,
        ],
        'priorities' => [
            AgentConversationTicketPriority::Low->value,
        ],
        'sortBy' => AgentConversationTicketSortBy::CreatedAt->value,
        'ownerUserId' => 'owner_user_id',
        'assigneeUserId' => 'assignee_user_id',
        'issueType' => AgentConversationTicketIssueType::KnowledgeGap->value,
        'label' => 'label',
        'mergedIntoTicketId' => 'merged_into_ticket_id',
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many agent conversation tickets to return. Can not exceed 100.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Only tickets for this agent.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?AgentConversationTicketStatus` — Filter tickets by status.
    
</dd>
</dl>

<dl>
<dd>

**$sources:** `?array` — Filter tickets by how they were raised (qa, agent, manual). Repeat the parameter to filter by multiple sources.
    
</dd>
</dl>

<dl>
<dd>

**$priorities:** `?array` — Filter tickets by priority. Repeat the parameter to filter by multiple priorities.
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?AgentConversationTicketSortBy` — Order by most recently created, by priority (most urgent first, then most recently created), or by most recently reported (the newest report merged into the issue, else its creation).
    
</dd>
</dl>

<dl>
<dd>

**$ownerUserId:** `?string` — Filter tickets by creator. Use 'agent' for agent-raised tickets.
    
</dd>
</dl>

<dl>
<dd>

**$assigneeUserId:** `?string` — Filter tickets by assignee. Use 'unassigned' for tickets with no assignee.
    
</dd>
</dl>

<dl>
<dd>

**$issueType:** `?AgentConversationTicketIssueType` — Filter clusters by issue type.
    
</dd>
</dl>

<dl>
<dd>

**$label:** `?string` — Filter tickets by an exact label.
    
</dd>
</dl>

<dl>
<dd>

**$mergedIntoTicketId:** `?string` — Filter tickets merged into this ticket.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Case-insensitive free-text search across the ticket's title, description, comments, and turn comments.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;create($request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Raise a ticket about an agent's performance on a conversation, for triage with Architect. Provide an overall comment and/or turn-level comments describing what went wrong.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->create(
    new CreateAgentConversationTicketRequestModel([
        'conversationId' => 'conversation_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — Conversation this ticket is about.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — One-line headline shown in the triage list. Defaults to one derived from the comments, falling back to the conversation's summary title. Ignored when the comment is added to the conversation's open ticket.
    
</dd>
</dl>

<dl>
<dd>

**$qaComment:** `?string` — The issue this ticket is about, covering the whole conversation rather than a single turn.
    
</dd>
</dl>

<dl>
<dd>

**$turnComments:** `?array` — Optional turn-level comments on what went wrong.
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?AgentConversationTicketPriority` — How urgently the ticket needs attention. If the conversation already has an open ticket, it is raised to this priority when lower.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;listAssignableUsers($agentId) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

All non-service-account workspace members, each flagged with whether they currently have at least viewer access to the agent. Members without access are included (not filtered out) so the UI can offer them as an assignee and prompt to grant access first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->listAssignableUsers(
    'agent_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;get($agentqaTicketId) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get an agent conversation ticket by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->get(
    'agentqa_ticket_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;update($agentqaTicketId, $request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a ticket's title, comment, status, priority, and/or assignee. Requires viewer access to the ticket's agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->update(
    'agentqa_ticket_id',
    new PatchAgentConversationTicketRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — If provided, updates the ticket title. Omit to leave unchanged.
    
</dd>
</dl>

<dl>
<dd>

**$qaComment:** `?string` — If provided, updates the ticket description. Omit to leave unchanged.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?AgentConversationTicketStatus` — If provided, updates the ticket status. Omit to leave unchanged.
    
</dd>
</dl>

<dl>
<dd>

**$assigneeUserId:** `?string` — If provided, updates who is responsible for resolving this ticket. Must be a workspace member with at least viewer access to the agent. Pass null to unassign. Omit to leave unchanged.
    
</dd>
</dl>

<dl>
<dd>

**$priority:** `?AgentConversationTicketPriority` — If provided, updates how urgently the ticket needs attention. Pass null to clear it. Omit to leave unchanged.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;delete($agentqaTicketId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an agent conversation ticket. Restricted to the ticket creator or a workspace admin.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->delete(
    'agentqa_ticket_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;addComment($agentqaTicketId, $request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Append a comment discussing how to resolve the ticket. Requires viewer access to the ticket's agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->addComment(
    'agentqa_ticket_id',
    new AddTicketCommentRequestModel([
        'comment' => 'comment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$comment:** `string` — A comment discussing how to resolve the ticket.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;merge($agentqaTicketId, $request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Merge other open tickets of the same agent into this pending, in-progress, or resolved one. Their conversations move onto this ticket, its priority is raised to the highest among them, and they are kept with status 'merged'. Requires viewer access to the ticket's agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->merge(
    'agentqa_ticket_id',
    new MergeAgentConversationTicketsRequestModel([
        'sourceTicketIds' => [
            'source_ticket_ids',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$sourceTicketIds:** `array` — Open tickets of the same agent to fold into this one. They are kept with status 'merged', pointing at this ticket.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;triageTickets-&gt;addTurnComment($agentqaTicketId, $request) -> ?AgentConversationTicketResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Append a turn-level comment to a ticket. Requires viewer access to the ticket's agent.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->triageTickets->addTurnComment(
    'agentqa_ticket_id',
    new AddTurnCommentRequestModel([
        'turnIndex' => 1,
        'comment' => 'comment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentqaTicketId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$turnIndex:** `int` — Zero-based index of the transcript turn this comment refers to.
    
</dd>
</dl>

<dl>
<dd>

**$comment:** `string` — What went wrong at this turn.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## PhoneNumbers
<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;list($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all Phone Numbers
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->list(
    new ListPhoneNumbersRequest([
        'provider' => TelephonyProvider::Twilio->value,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$provider:** `?TelephonyProvider` — Filter by telephony provider
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Filter by assigned agent ID
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter by assigned branch ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;create($request) -> ?CreatePhoneNumberResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Import Phone Number from provider configuration (Twilio, Exotel, or SIP trunk)
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->create(
    new CreateTwilioPhoneNumberRequest([
        'phoneNumber' => 'phone_number',
        'label' => 'label',
        'sid' => 'sid',
        'token' => 'token',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreatePhoneNumbersRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;get($phoneNumberId) -> ?GetPhoneNumbersResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve Phone Number details by ID
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->get(
    'TeaqRRdTcIfIu2i7BYfT',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` — The phone number ID. This is returned when a phone number is imported.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;update($phoneNumberId, $request) -> ?UpdatePhoneNumbersResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update assigned agent of a phone number
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->update(
    'TeaqRRdTcIfIu2i7BYfT',
    new UpdatePhoneNumberRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` — The phone number ID. This is returned when a phone number is imported.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$label:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$inboundTrunkConfig:** `?InboundSipTrunkConfigRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$outboundTrunkConfig:** `?OutboundSipTrunkConfigRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$livekitStack:** `?LivekitStackType` 
    
</dd>
</dl>

<dl>
<dd>

**$storeSipMessages:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Environment to use for resolving environment variables on calls to this number.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Agent branch to use for calls to this number.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;delete($phoneNumberId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete Phone Number by ID
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->delete(
    'TeaqRRdTcIfIu2i7BYfT',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` — The phone number ID. This is returned when a phone number is imported.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;listV2($request) -> ?GetPhoneNumbersPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a page of Phone Numbers
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->listV2(
    new ListV2PhoneNumbersRequest([
        'pageSize' => 1,
        'search' => 'search',
        'label' => 'label',
        'phoneNumber' => 'phone_number',
        'provider' => TelephonyProvider::Twilio->value,
        'supportsOutbound' => true,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'sortBy' => PhoneNumberSortBy::Label->value,
        'sortDirection' => SortDirection::Asc->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — Number of phone numbers per page
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Filter by phone number ID, label, or phone number. A phone number ID must match exactly; label and phone number matching is a case-insensitive substring.
    
</dd>
</dl>

<dl>
<dd>

**$label:** `?string` — Filter by label. Matching is a case-insensitive substring.
    
</dd>
</dl>

<dl>
<dd>

**$phoneNumber:** `?string` — Filter by phone number
    
</dd>
</dl>

<dl>
<dd>

**$provider:** `?TelephonyProvider` — Filter by telephony provider
    
</dd>
</dl>

<dl>
<dd>

**$supportsOutbound:** `?bool` — Filter by whether the phone number can place outbound calls
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Filter by assigned agent ID
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter by assigned branch ID
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?PhoneNumberSortBy` — The field to sort the results by
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;phoneNumbers-&gt;getSipMessages($phoneNumberId, $request) -> ?GetSipLogMessagesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get SIP messages for a phone number
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->phoneNumbers->getSipMessages(
    'TeaqRRdTcIfIu2i7BYfT',
    new GetSipMessagesPhoneNumbersRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` — The phone number ID. This is returned when a phone number is imported.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Llm
<details><summary><code>$client-&gt;agents-&gt;llm-&gt;list() -> ?LlmListResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of available LLM models that can be used with agents, including their capabilities and any deprecation status. The response is filtered based on the data residency of the deployment and any compliance requirements (e.g. HIPAA) of the workspace subscription.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->llm->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## LiveCount
<details><summary><code>$client-&gt;agents-&gt;analytics-&gt;liveCount-&gt;get($request) -> ?GetLiveCountResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the live count of the ongoing conversations.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analytics->liveCount->get(
    new GetLiveCountRequest([
        'agentId' => '21m00Tcm4TlvDq8ikWAM',
        'agentIds' => [
            '21m00Tcm4TlvDq8ikWAM',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `?string` — The id of an agent to restrict the analytics to.
    
</dd>
</dl>

<dl>
<dd>

**$agentIds:** `?array` — Restrict analytics to the union of the given agents. Takes precedence over `agent_id` when both are supplied.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tools
<details><summary><code>$client-&gt;agents-&gt;tools-&gt;list($request) -> ?ToolsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all available tools in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->list(
    new ListToolsRequest([
        'search' => 'search',
        'pageSize' => 1,
        'showOnlyOwnedDocuments' => true,
        'createdByUserId' => 'created_by_user_id',
        'types' => [
            ToolTypeFilter::Webhook->value,
        ],
        'sortDirection' => SortDirection::Asc->value,
        'sortBy' => ToolSortBy::Name->value,
        'usedByAgentId' => 'used_by_agent_id',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$search:** `?string` — If specified, the endpoint returns only tools whose names start with this string.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$showOnlyOwnedDocuments:** `?bool` — If set to true, the endpoint will return only tools owned by you (and not shared from somebody else). Deprecated: use created_by_user_id instead.
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter tools by creator user ID. When set, only tools created by this user are returned. Takes precedence over show_only_owned_documents. Use '@me' to refer to the authenticated user.
    
</dd>
</dl>

<dl>
<dd>

**$types:** `?array` — If present, the endpoint will return only tools of the given types.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?ToolSortBy` — The field to sort the results by
    
</dd>
</dl>

<dl>
<dd>

**$usedByAgentId:** `?string` — Filter to tools referenced by this agent's main branch: tools attached to the agent, tools on authored workflow nodes, and tools referenced by procedures.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tools-&gt;create($request) -> ?ToolResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add a new tool to the available tools in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->create(
    new ToolRequestModel([
        'toolConfig' => ToolRequestModelToolConfig::webhook(new WebhookToolConfigInput([
            'type' => WebhookToolConfigInputType::Webhook->value,
            'name' => 'name',
            'description' => 'description',
            'responseTimeoutSecs' => 20,
            'apiSchema' => new WebhookToolApiSchemaConfigInput([
                'requestHeaders' => [
                    'Authorization' => WebhookToolApiSchemaConfigInputRequestHeadersValue::fromMultiple([
                        new ConvAiSecretLocator([
                            'secretId' => 'secret_id',
                        ]),
                    ]),
                ],
                'url' => 'https://example.com/agents/{agent_id}',
                'method' => WebhookToolApiSchemaConfigInputMethod::Get->value,
                'pathParamsSchema' => [
                    'agent_id' => new LiteralJsonSchemaProperty([
                        'type' => Type11::String->value,
                    ]),
                ],
                'queryParamsSchema' => new QueryParamsJsonSchemaInput([
                    'properties' => [
                        'key' => new LiteralJsonSchemaProperty([
                            'type' => Type11::String->value,
                            'description' => 'A user-provided message',
                        ]),
                    ],
                ]),
            ]),
        ])),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolConfig:** `ToolRequestModelToolConfig` — Configuration for the tool
    
</dd>
</dl>

<dl>
<dd>

**$responseMocks:** `?array` — Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tools-&gt;get($toolId, $request) -> ?ToolResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get tool that is available in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->get(
    'tool_id',
    new GetToolsRequest([
        'environment' => 'environment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolId:** `string` — ID of the requested tool.
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Environment whose values are used when the MCP server URL, headers, or auth connection reference environment variables. Mirrors the environment a conversation would run in; defaults to production.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tools-&gt;update($toolId, $request) -> ?ToolResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update tool that is available in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->update(
    'tool_id',
    new ToolRequestModel([
        'toolConfig' => ToolRequestModelToolConfig::webhook(new WebhookToolConfigInput([
            'type' => WebhookToolConfigInputType::Webhook->value,
            'name' => 'name',
            'description' => 'description',
            'responseTimeoutSecs' => 20,
            'apiSchema' => new WebhookToolApiSchemaConfigInput([
                'requestHeaders' => [
                    'Authorization' => WebhookToolApiSchemaConfigInputRequestHeadersValue::fromMultiple([
                        new ConvAiSecretLocator([
                            'secretId' => 'secret_id',
                        ]),
                    ]),
                ],
                'url' => 'https://example.com/agents/{agent_id}',
                'method' => WebhookToolApiSchemaConfigInputMethod::Get->value,
                'pathParamsSchema' => [
                    'agent_id' => new LiteralJsonSchemaProperty([
                        'type' => Type11::String->value,
                    ]),
                ],
                'queryParamsSchema' => new QueryParamsJsonSchemaInput([
                    'properties' => [
                        'key' => new LiteralJsonSchemaProperty([
                            'type' => Type11::String->value,
                            'description' => 'A user-provided message',
                        ]),
                    ],
                ]),
            ]),
        ])),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolId:** `string` — ID of the requested tool.
    
</dd>
</dl>

<dl>
<dd>

**$toolConfig:** `ToolRequestModelToolConfig` — Configuration for the tool
    
</dd>
</dl>

<dl>
<dd>

**$responseMocks:** `?array` — Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tools-&gt;delete($toolId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete tool from the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->delete(
    'tool_id',
    new DeleteToolsRequest([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolId:** `string` — ID of the requested tool.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — If set to true, the tool will be deleted regardless of whether it is used by any agents and it will be removed from the dependent agents and branches.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;tools-&gt;getDependentAgents($toolId, $request) -> ?GetToolDependentAgentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of agents depending on this tool
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->getDependentAgents(
    'tool_id',
    new GetDependentAgentsToolsRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolId:** `string` — ID of the requested tool.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Executions
<details><summary><code>$client-&gt;agents-&gt;tools-&gt;executions-&gt;get($toolId, $request) -> ?GetToolExecutionsPageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get paginated list of tool executions for a specific tool.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->tools->executions->get(
    'tool_id',
    new GetExecutionsRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'isError' => true,
        'agentId' => 'agent_id',
        'branchId' => 'branch_id',
        'startTime' => 1.1,
        'endTime' => 1.1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$toolId:** `string` — ID of the requested tool.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$isError:** `?bool` — Filter by error status. If not provided, returns all executions.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Filter by agent ID.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — Filter by agent branch ID.
    
</dd>
</dl>

<dl>
<dd>

**$startTime:** `?float` — Filter executions from this Unix timestamp (inclusive).
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `?float` — Filter executions until this Unix timestamp (inclusive).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## McpServers
<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;list() -> ?McpServersResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all MCP server configurations available in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;create($request) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new MCP server configuration in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->create(
    new McpServerRequestModel([
        'config' => new McpServerConfigInput([
            'url' => 'url',
            'name' => 'name',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$config:** `McpServerConfigInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;get($mcpServerId) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a specific MCP server configuration from the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->get(
    'mcp_server_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;update($mcpServerId, $request) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the configuration settings for an MCP server.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->update(
    'mcp_server_id',
    new McpServerConfigUpdateRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$approvalPolicy:** `?McpApprovalPolicy` — The approval mode to set for the MCP server
    
</dd>
</dl>

<dl>
<dd>

**$forcePreToolSpeech:** `?bool` — DEPRECATED: use `pre_tool_speech` instead. If set, overrides the server's force_pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$preToolSpeech:** `?PreToolSpeechMode` — If set, overrides the server's pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$disableInterruptions:** `?bool` — DEPRECATED: use `interruption_mode` instead. If set, overrides the server's disable_interruptions setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$interruptionMode:** `?ToolInterruptionMode` — If set, overrides the server's interruption_mode setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSound:** `?ToolCallSoundType` — Predefined tool call sound type to play during tool execution for all tools from this MCP server
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSoundBehavior:** `?ToolCallSoundBehavior` — Determines when the tool call sound should play for all tools from this MCP server
    
</dd>
</dl>

<dl>
<dd>

**$executionMode:** `?ToolExecutionMode` — If set, overrides the server's execution_mode setting for this tool
    
</dd>
</dl>

<dl>
<dd>

**$responseTimeoutSecs:** `?int` — The maximum time in seconds to wait for each MCP tool call to complete.
    
</dd>
</dl>

<dl>
<dd>

**$requestHeaders:** `?array` — The headers to include in requests to the MCP server
    
</dd>
</dl>

<dl>
<dd>

**$requestMeta:** `?array` — Entries sent in the MCP `_meta` field of tools/call requests. Values may be JSON scalars, or references to a workspace secret, dynamic variable, or environment variable resolved per call.
    
</dd>
</dl>

<dl>
<dd>

**$disableCompression:** `?bool` — Whether to disable HTTP compression for this MCP server
    
</dd>
</dl>

<dl>
<dd>

**$secretToken:** `?ConvAiSecretLocator` — Optional secret token for authentication with this MCP server
    
</dd>
</dl>

<dl>
<dd>

**$authConnection:** `?McpServerConfigUpdateRequestModelAuthConnection` — Optional auth connection to use for authentication with this MCP server
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;delete($mcpServerId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a specific MCP server configuration from the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->delete(
    'mcp_server_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Tools
<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;tools-&gt;list($mcpServerId, $request) -> ?ListMcpToolsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve all tools available for a specific MCP server configuration.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->tools->list(
    'mcp_server_id',
    new ListToolsRequest([
        'environment' => 'environment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Environment whose values are used when the MCP server URL, headers, or auth connection reference environment variables. Mirrors the environment a conversation would run in; defaults to production.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ToolApprovals
<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolApprovals-&gt;create($mcpServerId, $request) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add approval for a specific MCP tool when using per-tool approval mode.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolApprovals->create(
    'mcp_server_id',
    new McpToolAddApprovalRequestModel([
        'toolName' => 'tool_name',
        'toolDescription' => 'tool_description',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — The name of the MCP tool
    
</dd>
</dl>

<dl>
<dd>

**$toolDescription:** `string` — The description of the MCP tool
    
</dd>
</dl>

<dl>
<dd>

**$inputSchema:** `?array` — The input schema of the MCP tool (the schema defined on the MCP server before ElevenLabs does any extra processing)
    
</dd>
</dl>

<dl>
<dd>

**$approvalPolicy:** `?McpToolApprovalPolicy` — Defines the tool-level approval policy.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolApprovals-&gt;delete($mcpServerId, $toolName) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove approval for a specific MCP tool when using per-tool approval mode.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolApprovals->delete(
    'mcp_server_id',
    'tool_name',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — Name of the MCP tool to remove approval for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ToolConfigs
<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolConfigs-&gt;create($mcpServerId, $request) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create configuration overrides for a specific MCP tool.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolConfigs->create(
    'mcp_server_id',
    new McpToolConfigOverrideCreateRequestModel([
        'environment' => 'environment',
        'toolName' => 'tool_name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Environment whose values are used when the MCP server URL, headers, or auth connection reference environment variables. Mirrors the environment a conversation would run in; defaults to production.
    
</dd>
</dl>

<dl>
<dd>

**$forcePreToolSpeech:** `?bool` — DEPRECATED: use `pre_tool_speech` instead. If set, overrides the server's force_pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$preToolSpeech:** `?PreToolSpeechMode` — If set, overrides the server's pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$disableInterruptions:** `?bool` — DEPRECATED: use `interruption_mode` instead. If set, overrides the server's disable_interruptions setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$interruptionMode:** `?ToolInterruptionMode` — If set, overrides the server's interruption_mode setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSound:** `?McpToolConfigOverrideCreateRequestModelToolCallSound` — Overrides the server's tool_call_sound setting for this tool. A sound name plays that sound; 'off' overrides to no sound (silence); null means do not override (inherit the server default).
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSoundBehavior:** `?ToolCallSoundBehavior` — If set, overrides the server's tool_call_sound_behavior setting for this tool
    
</dd>
</dl>

<dl>
<dd>

**$executionMode:** `?ToolExecutionMode` — If set, overrides the server's execution_mode setting for this tool
    
</dd>
</dl>

<dl>
<dd>

**$responseTimeoutSecs:** `?int` — If set, overrides the server's response timeout for this MCP tool.
    
</dd>
</dl>

<dl>
<dd>

**$assignments:** `?array` — Dynamic variable assignments for this MCP tool
    
</dd>
</dl>

<dl>
<dd>

**$inputOverrides:** `?array` — Mapping of json path to input override configuration
    
</dd>
</dl>

<dl>
<dd>

**$responseMocks:** `?array` — Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — The name of the MCP tool
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolConfigs-&gt;get($mcpServerId, $toolName) -> ?McpToolConfigOverrideOutput</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve configuration overrides for a specific MCP tool.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolConfigs->get(
    'mcp_server_id',
    'tool_name',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — Name of the MCP tool to retrieve config overrides for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolConfigs-&gt;update($mcpServerId, $toolName, $request) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update configuration overrides for a specific MCP tool.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolConfigs->update(
    'mcp_server_id',
    'tool_name',
    new McpToolConfigOverrideUpdateRequestModel([
        'environment' => 'environment',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — Name of the MCP tool to update config overrides for.
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Environment whose values are used when the MCP server URL, headers, or auth connection reference environment variables. Mirrors the environment a conversation would run in; defaults to production.
    
</dd>
</dl>

<dl>
<dd>

**$forcePreToolSpeech:** `?bool` — DEPRECATED: use `pre_tool_speech` instead. If set, overrides the server's force_pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$preToolSpeech:** `?PreToolSpeechMode` — If set, overrides the server's pre_tool_speech setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$disableInterruptions:** `?bool` — DEPRECATED: use `interruption_mode` instead. If set, overrides the server's disable_interruptions setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$interruptionMode:** `?ToolInterruptionMode` — If set, overrides the server's interruption_mode setting for this tool.
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSound:** `?McpToolConfigOverrideUpdateRequestModelToolCallSound` — Overrides the server's tool_call_sound setting for this tool. A sound name plays that sound; 'off' overrides to no sound (silence); null means do not override (inherit the server default).
    
</dd>
</dl>

<dl>
<dd>

**$toolCallSoundBehavior:** `?ToolCallSoundBehavior` — If set, overrides the server's tool_call_sound_behavior setting for this tool
    
</dd>
</dl>

<dl>
<dd>

**$executionMode:** `?ToolExecutionMode` — If set, overrides the server's execution_mode setting for this tool
    
</dd>
</dl>

<dl>
<dd>

**$responseTimeoutSecs:** `?int` — If set, overrides the server's response timeout for this MCP tool.
    
</dd>
</dl>

<dl>
<dd>

**$assignments:** `?array` — Dynamic variable assignments for this MCP tool
    
</dd>
</dl>

<dl>
<dd>

**$inputOverrides:** `?array` — Mapping of json path to input override configuration
    
</dd>
</dl>

<dl>
<dd>

**$responseMocks:** `?array` — Mock responses with optional parameter conditions. Evaluated top-to-bottom; first match wins.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mcpServers-&gt;toolConfigs-&gt;delete($mcpServerId, $toolName) -> ?McpServerResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove configuration overrides for a specific MCP tool.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mcpServers->toolConfigs->delete(
    'mcp_server_id',
    'tool_name',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$mcpServerId:** `string` — ID of the MCP Server.
    
</dd>
</dl>

<dl>
<dd>

**$toolName:** `string` — Name of the MCP tool to remove config overrides for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AnalysisItems
<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;list($request) -> ?AnalysisItemsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List analysis items available in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->list(
    new ListAnalysisItemsRequest([
        'search' => 'search',
        'pageSize' => 1,
        'kind' => AnalysisItemKind::Evaluation->value,
        'analysisItemIds' => [
            'analysis_item_ids',
        ],
        'createdByUserId' => 'created_by_user_id',
        'sortDirection' => SortDirection::Asc->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$search:** `?string` — If specified, only analysis items whose names start with this string are returned, ordered by relevance rather than sort_direction.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$kind:** `?AnalysisItemKind` — If specified, only analysis items of this kind are returned.
    
</dd>
</dl>

<dl>
<dd>

**$analysisItemIds:** `?array` — If specified, only analysis items with these IDs are returned.
    
</dd>
</dl>

<dl>
<dd>

**$createdByUserId:** `?string` — Filter by creator user ID. Use '@me' to refer to the authenticated user.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;create($request) -> ?AnalysisItemResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new analysis item (evaluation criterion or data collection) in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->create(
    new UserEvaluationAnalysisItem([
        'name' => 'name',
        'conversationGoalPrompt' => 'conversation_goal_prompt',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateAnalysisItemsRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;updateAttachments($analysisItemId, $request) -> ?UpdateAnalysisItemAttachmentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Attach or detach one analysis item on multiple agent branches.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->updateAttachments(
    'analysis_item_id',
    new UpdateAnalysisItemAttachmentsRequestModel([
        'source' => AnalysisItemSource::User->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>

<dl>
<dd>

**$source:** `AnalysisItemSource` 
    
</dd>
</dl>

<dl>
<dd>

**$attach:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$detach:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;get($analysisItemId) -> ?AnalysisItemResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get an analysis item available in the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->get(
    'analysis_item_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;update($analysisItemId, $request) -> ?AnalysisItemResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an analysis item. Publishes a new version when the content changes.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->update(
    'analysis_item_id',
    new UserEvaluationAnalysisItem([
        'name' => 'name',
        'conversationGoalPrompt' => 'conversation_goal_prompt',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UpdateAnalysisItemsRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;delete($analysisItemId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an analysis item and all of its versions from the workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->delete(
    'analysis_item_id',
    new DeleteAnalysisItemsRequest([
        'force' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — If set to true, the analysis item will be deleted regardless of whether it is used by any agents and it will be removed from the dependent agents and branches.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;listVersions($analysisItemId, $request) -> ?AnalysisItemVersionsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the published versions of an analysis item, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->listVersions(
    'analysis_item_id',
    new ListVersionsAnalysisItemsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;copy($analysisItemId) -> ?AnalysisItemResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new analysis item from this item's current definition.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->copy(
    'analysis_item_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## DependentAgents
<details><summary><code>$client-&gt;agents-&gt;analysisItems-&gt;dependentAgents-&gt;get($analysisItemId, $request) -> ?GetAnalysisItemDependentAgentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of agents (and branches) that reference this analysis item.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->analysisItems->dependentAgents->get(
    'analysis_item_id',
    new GetDependentAgentsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$analysisItemId:** `string` — ID of the requested analysis item.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Secrets
<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;list($request) -> ?GetWorkspaceSecretsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all workspace secrets for the user
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->list(
    new ListSecretsRequest([
        'pageSize' => 1,
        'dependencyLimit' => 1,
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many documents to return at maximum. Can not exceed 100. If not provided, returns all secrets.
    
</dd>
</dl>

<dl>
<dd>

**$dependencyLimit:** `?int` — Maximum number of dependent resources (tools, agents, phone numbers) to return per secret. Can not exceed 100.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — If specified, returns only secrets whose names start with this string.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;create($request) -> ?PostWorkspaceSecretResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new secret for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->create(
    new PostWorkspaceSecretRequest([
        'type' => PostWorkspaceSecretRequestType::New_->value,
        'name' => 'name',
        'value' => 'value',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$type:** `PostWorkspaceSecretRequestType` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$value:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;get($secretId) -> ?ConvAiWorkspaceStoredSecretConfig</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a workspace secret by ID
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->get(
    'secret_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$secretId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;update($secretId, $request) -> ?PostWorkspaceSecretResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an existing secret for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->update(
    'secret_id',
    new PatchWorkspaceSecretRequest([
        'type' => PatchWorkspaceSecretRequestType::Update->value,
        'name' => 'name',
        'value' => 'value',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$secretId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$type:** `PatchWorkspaceSecretRequestType` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$value:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;delete($secretId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a workspace secret if it's not in use
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->delete(
    'secret_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$secretId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;secrets-&gt;getDependencies($secretId, $resourceType, $request) -> ?GetSecretDependenciesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get paginated list of resources that depend on a specific secret, filtered by resource type.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->secrets->getDependencies(
    'secret_id',
    SecretDependencyResourceType::Tools->value,
    new GetDependenciesSecretsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$secretId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resourceType:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many dependency items to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## BatchCalls
<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;create($request) -> ?BatchCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Submit a batch call request to schedule calls for multiple recipients.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->create(
    new BodySubmitABatchCallRequestV1ConvaiBatchCallingSubmitPost([
        'callName' => 'call_name',
        'agentId' => 'agent_id',
        'recipients' => [
            new OutboundCallRecipient([]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$callName:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$recipients:** `array` 
    
</dd>
</dl>

<dl>
<dd>

**$scheduledTimeUnix:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$agentPhoneNumberId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$whatsappParams:** `?BatchCallWhatsAppParams` 
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$telephonyCallConfig:** `?TelephonyCallConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$targetConcurrencyLimit:** `?int` — Maximum number of simultaneous calls for this batch. When set, dispatch is governed by this limit rather than workspace/agent capacity percentages.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;list($request) -> ?WorkspaceBatchCallsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all batch calls for the current workspace.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->list(
    new ListBatchCallsRequest([
        'limit' => 1,
        'lastDoc' => 'last_doc',
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$limit:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$lastDoc:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Filter batch calls to a single agent.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;get($batchId) -> ?BatchCallDetailedResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get detailed information about a batch call including all recipients.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->get(
    'batch_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$batchId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;delete($batchId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Permanently delete a batch call and all recipient records. Conversations remain in history.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->delete(
    'batch_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$batchId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;cancel($batchId) -> ?BatchCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Cancel a running batch call and set all recipients to cancelled status.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->cancel(
    'batch_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$batchId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;retry($batchId) -> ?BatchCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retry a batch call, calling failed and no-response recipients again.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->batchCalls->retry(
    'batch_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$batchId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;batchCalls-&gt;export($batchId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Download all recipients and conversation results for a batch call as CSV, including calls that are still in progress.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->agents->batchCalls->export(
    'batch_id',
    new ExportBatchCallsRequest([
        'limit' => 1,
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$batchId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Only export the first N recipients; used to preview the columns. Omit to export every recipient.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SipTrunk
<details><summary><code>$client-&gt;agents-&gt;sipTrunk-&gt;outboundCall($request) -> ?SipTrunkOutboundCallResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Handle an outbound call via SIP trunk
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->sipTrunk->outboundCall(
    new BodyHandleAnOutboundCallViaSipTrunkV1ConvaiSipTrunkOutboundCallPost([
        'agentId' => 'agent_id',
        'agentPhoneNumberId' => 'agent_phone_number_id',
        'toNumber' => 'to_number',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$agentPhoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$toNumber:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$conversationInitiationClientData:** `?ConversationInitiationClientDataRequestInput` 
    
</dd>
</dl>

<dl>
<dd>

**$telephonyCallConfig:** `?TelephonyCallConfigInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## WhatsappAccounts
<details><summary><code>$client-&gt;agents-&gt;whatsappAccounts-&gt;get($phoneNumberId) -> ?GetWhatsAppAccountResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a WhatsApp account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsappAccounts->get(
    'phone_number_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;whatsappAccounts-&gt;update($phoneNumberId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a WhatsApp account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsappAccounts->update(
    'phone_number_id',
    new UpdateWhatsAppAccountRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$assignedAgentId:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$enableMessaging:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$enableAudioMessageResponse:** `?bool` 
    
</dd>
</dl>

<dl>
<dd>

**$enableTypingIndicator:** `?bool` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;whatsappAccounts-&gt;delete($phoneNumberId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a WhatsApp account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsappAccounts->delete(
    'phone_number_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$phoneNumberId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;whatsappAccounts-&gt;list($request) -> ?ListWhatsAppAccountsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all WhatsApp accounts
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->whatsappAccounts->list(
    new ListWhatsappAccountsRequest([
        'agentId' => 'agent_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `?string` — Filter by assigned agent ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Branches
<details><summary><code>$client-&gt;agents-&gt;branches-&gt;list($agentId, $request) -> ?ListResponseAgentBranchSummary</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of branches an agent has
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->list(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new ListBranchesRequest([
        'includeArchived' => true,
        'limit' => 1,
        'includeCommitStatus' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$includeArchived:** `?bool` — Whether archived branches should be included
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — How many results at most should be returned
    
</dd>
</dl>

<dl>
<dd>

**$includeCommitStatus:** `?bool` — Whether to compute how far each branch has diverged from main (commits_ahead/commits_behind). This walks the version DAG of every branch, so it is slow on agents with long histories and is off by default, leaving those fields null.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;create($agentId, $request) -> ?CreateAgentBranchResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new branch from a given version of any branch
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyCreateANewBranchV1ConvaiAgentsAgentIdBranchesPost([
        'parentVersionId' => 'parent_version_id',
        'name' => 'name',
        'description' => 'description',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$parentVersionId:** `string` — ID of the version to branch from
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — Name of the branch. It is unique within the agent.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `string` — Description for the branch
    
</dd>
</dl>

<dl>
<dd>

**$conversationConfig:** `?array` — Changes to apply to conversation config
    
</dd>
</dl>

<dl>
<dd>

**$platformSettings:** `?array` — Changes to apply to platform settings
    
</dd>
</dl>

<dl>
<dd>

**$workflow:** `?AgentWorkflowRequestModel` — Updated workflow definition
    
</dd>
</dl>

<dl>
<dd>

**$includeDraft:** `?bool` — When true, the new branch uses the caller's draft procedure set instead of the branch tip. Requires parent_version_id to be the branch tip.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;get($agentId, $branchId) -> ?AgentBranchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get information about a single agent branch
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Unique identifier for the branch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;update($agentId, $branchId, $request) -> ?AgentBranchResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update agent branch properties such as name, description, archiving status, protection level, and auto-rebase onto main
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->update(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    new BodyUpdateAgentBranchV1ConvaiAgentsAgentIdBranchesBranchIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Unique identifier for the branch.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — New name for the branch. Must be unique within the agent.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — New description for the branch. Pass an empty string to clear it.
    
</dd>
</dl>

<dl>
<dd>

**$isArchived:** `?bool` — Whether the branch should be archived
    
</dd>
</dl>

<dl>
<dd>

**$protectionStatus:** `?BranchProtectionStatus` — The protection level for the branch
    
</dd>
</dl>

<dl>
<dd>

**$autoRebase:** `?bool` — When true, rebase this branch onto main automatically after each new main version. Cannot be enabled on the main branch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;previewMerge($agentId, $sourceBranchId, $request) -> ?MergePreviewResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the result of merging the source branch into the target branch without performing the merge. Useful for showing an accurate diff before confirming.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->previewMerge(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    new PreviewMergeBranchesRequest([
        'targetBranchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
        'force' => true,
        'includeProcedureGeneratedWorkflowElements' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `string` — Unique identifier for the source branch to merge from.
    
</dd>
</dl>

<dl>
<dd>

**$targetBranchId:** `string` — The ID of the target branch to merge into.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — When true, source branch changes always win conflicts regardless of timestamps
    
</dd>
</dl>

<dl>
<dd>

**$includeProcedureGeneratedWorkflowElements:** `?bool` — Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;merge($agentId, $sourceBranchId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Merge a branch into a target branch
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->merge(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyMergeABranchIntoATargetBranchV1ConvaiAgentsAgentIdBranchesSourceBranchIdMergePost([
        'targetBranchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `string` — Unique identifier for the source branch to merge from.
    
</dd>
</dl>

<dl>
<dd>

**$targetBranchId:** `string` — The ID of the target branch to merge into.
    
</dd>
</dl>

<dl>
<dd>

**$archiveSourceBranch:** `?bool` — Whether to archive the source branch after merging
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — Force source branch changes onto the target, overriding timestamp-based conflict resolution
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;previewRebase($agentId, $branchId, $request) -> ?MergePreviewResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the result of pulling changes from a source branch (defaults to main) into the given branch without performing it, preserving the given branch's own changes. Useful for showing an accurate diff before confirming.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->previewRebase(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    new PreviewRebaseBranchesRequest([
        'sourceBranchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
        'includeProcedureGeneratedWorkflowElements' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Unique identifier for the source branch to merge from.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `?string` — The ID of the branch to pull changes from. Defaults to the agent's main branch.
    
</dd>
</dl>

<dl>
<dd>

**$includeProcedureGeneratedWorkflowElements:** `?bool` — Whether to include the workflow nodes and edges generated from structured procedures. When false, the workflow contains only authored elements.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;branches-&gt;rebase($agentId, $branchId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Pull changes from a source branch (defaults to main) into this branch as a new version, preserving this branch's own changes on conflicts.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->branches->rebase(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyRebaseABranchOntoMainV1ConvaiAgentsAgentIdBranchesBranchIdRebasePost([
        'sourceBranchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Unique identifier for the source branch to merge from.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `?string` — The ID of the branch to pull changes from. Defaults to the agent's main branch.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Versions
<details><summary><code>$client-&gt;agents-&gt;versions-&gt;get($agentId, $versionId) -> ?AgentVersionMetadata</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get metadata for a specific agent version
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->versions->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtvrsn_0901k4aafjxxfxt93gd841r7tv5t',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `string` — Unique identifier for the version.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Deployments
<details><summary><code>$client-&gt;agents-&gt;deployments-&gt;list($agentId, $request) -> ?ListResponseAgentDeploymentHistoryItem</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the traffic split history of an agent, newest first
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->deployments->list(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new ListDeploymentsRequest([
        'page' => 1,
        'pageSize' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$page:** `?int` — Page number, starting at 1
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many results at most should be returned
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;deployments-&gt;create($agentId, $request) -> ?AgentDeploymentResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new deployment for an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->deployments->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyCreateOrUpdateDeploymentsV1ConvaiAgentsAgentIdDeploymentsPost([
        'deploymentRequest' => new AgentDeploymentRequest([
            'requests' => [
                new AgentDeploymentRequestItem([
                    'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
                    'deploymentStrategy' => new AgentDeploymentPercentageStrategy([
                        'type' => AgentDeploymentPercentageStrategyType::Percentage->value,
                        'trafficPercentage' => 0.5,
                    ]),
                ]),
            ],
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$deploymentRequest:** `AgentDeploymentRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Drafts
<details><summary><code>$client-&gt;agents-&gt;drafts-&gt;create($agentId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new draft for an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->drafts->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyCreateAgentDraftV1ConvaiAgentsAgentIdDraftsPost([
        'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
        'conversationConfig' => [
            'key' => "value",
        ],
        'platformSettings' => [
            'key' => "value",
        ],
        'workflow' => new AgentWorkflowRequestModel([
            'edges' => [
                'entry_to_tool_a' => new WorkflowEdgeModelInput([
                    'source' => 'entry_node',
                    'target' => 'tool_node_a',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::llm(new WorkflowLlmConditionModelInput([
                        'condition' => "User's last message contains a question about our pricing.",
                    ])),
                ]),
                'start_to_entry' => new WorkflowEdgeModelInput([
                    'source' => 'start_node',
                    'target' => 'entry_node',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::unconditional(new WorkflowUnconditionalModelInput([])),
                ]),
                'tool_a_to_failure' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_a',
                    'target' => 'failure_node',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::result(new WorkflowResultConditionModelInput([
                        'successful' => true,
                    ])),
                ]),
                'tool_a_to_tool_b' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_a',
                    'target' => 'tool_node_b',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::result(new WorkflowResultConditionModelInput([
                        'successful' => true,
                    ])),
                ]),
                'tool_b_to_agent_transfer' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_b',
                    'target' => 'success_transfer',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::unconditional(new WorkflowUnconditionalModelInput([])),
                ]),
                'tool_b_to_conversation' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_b',
                    'target' => 'success_conversation',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::llm(new WorkflowLlmConditionModelInput([
                        'condition' => "User's last message contains a question about our pricing.",
                    ])),
                ]),
                'tool_b_to_end' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_b',
                    'target' => 'success_end',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::llm(new WorkflowLlmConditionModelInput([
                        'condition' => "User's last message contains a question about our pricing.",
                    ])),
                ]),
                'tool_b_to_phone' => new WorkflowEdgeModelInput([
                    'source' => 'tool_node_b',
                    'target' => 'success_phone',
                    'forwardCondition' => WorkflowEdgeModelInputForwardCondition::expression(new WorkflowExpressionConditionModelInput([
                        'expression' => AstNodeInput::stringLiteral(new AstStringNodeInput([
                            'value' => 'value',
                        ])),
                    ])),
                ]),
            ],
            'nodes' => [
                'entry_node' => AgentWorkflowRequestModelNodesValue::start(new WorkflowStartNodeModelInput([])),
                'failure_node' => AgentWorkflowRequestModelNodesValue::overrideAgent(new WorkflowOverrideAgentNodeModelInput([
                    'label' => 'label',
                ])),
                'start_node' => AgentWorkflowRequestModelNodesValue::start(new WorkflowStartNodeModelInput([])),
                'success_conversation' => AgentWorkflowRequestModelNodesValue::overrideAgent(new WorkflowOverrideAgentNodeModelInput([
                    'label' => 'label',
                ])),
                'success_end' => AgentWorkflowRequestModelNodesValue::start(new WorkflowStartNodeModelInput([])),
                'success_phone' => AgentWorkflowRequestModelNodesValue::phoneNumber(new WorkflowPhoneNumberNodeModelInput([
                    'transferDestination' => WorkflowPhoneNumberNodeModelInputTransferDestination::phone(new PhoneNumberTransferDestination([
                        'phoneNumber' => 'phone_number',
                    ])),
                ])),
                'success_transfer' => AgentWorkflowRequestModelNodesValue::standaloneAgent(new WorkflowStandaloneAgentNodeModelInput([])),
                'tool_node_a' => AgentWorkflowRequestModelNodesValue::start(new WorkflowStartNodeModelInput([])),
                'tool_node_b' => AgentWorkflowRequestModelNodesValue::start(new WorkflowStartNodeModelInput([])),
            ],
        ]),
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — The ID of the agent branch to use
    
</dd>
</dl>

<dl>
<dd>

**$conversationConfig:** `array` — Conversation config for the draft
    
</dd>
</dl>

<dl>
<dd>

**$platformSettings:** `array` — Platform settings for the draft
    
</dd>
</dl>

<dl>
<dd>

**$workflow:** `AgentWorkflowRequestModel` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — Name for the draft
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Tags to help classify and filter the agent
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;drafts-&gt;delete($agentId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a draft for an agent
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->drafts->delete(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new DeleteDraftsRequest([
        'branchId' => 'agtbrch_8901k4t9z5defmb8vh3e9361y7nj',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — The ID of the agent branch to use
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Procedures
<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;list($agentId, $branchId, $request) -> ?ListProceduresResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the procedures attached to this agent branch. By default, unpublished drafts take precedence over the latest committed version. Pass agent_version_id to list a published snapshot instead. has_draft is true when a procedure has unpublished draft changes on this branch. Procedure content is not included; use Get Procedure to read a procedure's body.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->list(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    new ListProceduresRequest([
        'agentVersionId' => 'agtvrsn_8901k4t9z5defmb8vh3e9361y7nj',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$agentVersionId:** `?string` — The agent version ID to retrieve the procedure for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;create($agentId, $branchId, $request) -> ?CreateProcedureResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new procedure for the agent on a branch.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    new CreateProcedureRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Procedure name
    
</dd>
</dl>

<dl>
<dd>

**$content:** `?string` — Initial procedure content
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?ProcedureType` 
    
</dd>
</dl>

<dl>
<dd>

**$trigger:** `?string` — When the agent should use this procedure. Empty string means this is a sub-procedure that should only start when another procedure references it. Omit this field (or send null) to keep the stored trigger, which is empty on create. Send `""` to clear it. `description` is accepted as an alias.
    
</dd>
</dl>

<dl>
<dd>

**$folderParentId:** `?string` — Procedure ID of the folder to create this procedure in, or null for root.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;compile($agentId, $branchId) -> ?CompileProceduresResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Legacy. Do not use. Saving an agent draft (`POST /v1/convai/agents/{agent_id}/drafts`) and publishing an agent (`PATCH /v1/convai/agents/{agent_id}`) compile structured procedures into workflow nodes and edges, save the compiled workflow with the draft or version, and return validation errors, so a separate compile call is no longer needed. This endpoint remains available for the time being so existing callers do not break, as a dry-run that compiles the current procedure drafts into a workflow without persisting anything. It will eventually be deprecated.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->compile(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;get($agentId, $branchId, $procedureId, $request) -> ?ProcedureAtVersionResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a procedure at a specific version or the current branch HEAD.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3',
    new GetProceduresRequest([
        'versionId' => 'agtprcv_7rbqxer9o12cyxi55ckw6sgz1dl4',
        'agentVersionId' => 'agtvrsn_8901k4t9z5defmb8vh3e9361y7nj',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$procedureId:** `string` — The procedure ID
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — The version ID to retrieve. If omitted, returns the version at branch HEAD.
    
</dd>
</dl>

<dl>
<dd>

**$agentVersionId:** `?string` — The agent version ID to retrieve the procedure for.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;remove($agentId, $branchId, $procedureId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a procedure from the agent's draft working set. Removing a folder cascades to its entire subtree, rejected if any procedure outside the subtree hands off into it.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->remove(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$procedureId:** `string` — The procedure ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Drafts
<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;drafts-&gt;get($agentId, $branchId, $procedureId) -> ?ProcedureDraftResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get user's draft for a procedure
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->drafts->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$procedureId:** `string` — The procedure ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;drafts-&gt;update($agentId, $branchId, $procedureId, $request) -> ?ProcedureDraftResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create or update user's draft for a procedure
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->drafts->update(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3',
    new UpdateProcedureDraftRequestModel([
        'name' => 'name',
        'content' => 'content',
        'type' => ProcedureType::FreeForm->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$procedureId:** `string` — The procedure ID
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — Procedure name
    
</dd>
</dl>

<dl>
<dd>

**$content:** `string` — Procedure content
    
</dd>
</dl>

<dl>
<dd>

**$type:** `ProcedureType` 
    
</dd>
</dl>

<dl>
<dd>

**$trigger:** `?string` — When the agent should use this procedure. Empty string means this is a sub-procedure that should only start when another procedure references it. Omit this field (or send null) to keep the stored trigger, which is empty on create. Send `""` to clear it. `description` is accepted as an alias.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;procedures-&gt;drafts-&gt;delete($agentId, $branchId, $procedureId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete user's draft for a procedure, resetting to the committed version
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->procedures->drafts->delete(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtbranch_0901k4aafjxxfxt93gd841r7tv5t',
    'agtprc_6qbpwdq8n01bxhk44bgjy6f10ck3',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — Agent ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `string` — Branch ID to get the procedure draft from
    
</dd>
</dl>

<dl>
<dd>

**$procedureId:** `string` — The procedure ID
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## MergeProposals
<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;list($agentId, $request) -> ?PaginatedResultAgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the proposals for an agent, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->list(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new ListMergeProposalsRequest([
        'status' => MergeProposalStatus::Open->value,
        'sourceBranchId' => 'source_branch_id',
        'targetBranchId' => 'target_branch_id',
        'search' => 'search',
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?MergeProposalStatus` — Only return proposals with this status.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `?string` — Only return proposals with this source branch.
    
</dd>
</dl>

<dl>
<dd>

**$targetBranchId:** `?string` — Only return proposals with this target branch.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Case-insensitive substring match over title and description.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many results at most should be returned
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;create($agentId, $request) -> ?CreateAgentMergeProposalResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Record a request to merge a source branch into a target branch. Anyone with edit access can open one; merging it later is gated on write access to the target branch, so this is how a change reaches a protected branch the author cannot merge into themselves.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->create(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    new BodyCreateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsPost([
        'sourceBranchId' => 'source_branch_id',
        'targetBranchId' => 'target_branch_id',
        'title' => 'title',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$sourceBranchId:** `string` — Branch whose changes should be merged.
    
</dd>
</dl>

<dl>
<dd>

**$targetBranchId:** `string` — Branch that should receive the changes.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `string` — Short title for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Optional longer description for reviewers.
    
</dd>
</dl>

<dl>
<dd>

**$requestedReviewerUserIds:** `?array` — User IDs to request a review from.
    
</dd>
</dl>

<dl>
<dd>

**$triageTicketId:** `?string` — Triage ticket of this agent that the merge_proposal resolves. Merging it resolves the ticket if still open.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;get($agentId, $mergeProposalId) -> ?AgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a single merge_proposal.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->get(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtmprop_8901k4t9z5defmb8vh3e9361y7nj',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$mergeProposalId:** `string` — Unique identifier for the merge_proposal.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;update($agentId, $mergeProposalId, $request) -> ?AgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Edit an open merge_proposal's title or description, or close it. The author closing it is recorded as withdrawn; anyone else as rejected.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->update(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtmprop_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyUpdateAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$mergeProposalId:** `string` — Unique identifier for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — New title for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — New description for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$requestedReviewerUserIds:** `?array` — Replacement list of user IDs to request a review from.
    
</dd>
</dl>

<dl>
<dd>

**$close:** `?bool` — When true, close the merge_proposal without merging.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;submitReview($agentId, $mergeProposalId, $request) -> ?AgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Approve a merge_proposal or request changes on it. A user's latest review replaces their previous one. Non-admins need an approval from another user before the merge is allowed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->submitReview(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtmprop_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyReviewAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdReviewsPost([
        'state' => MergeProposalReviewState::Approved->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$mergeProposalId:** `string` — Unique identifier for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$state:** `MergeProposalReviewState` 
    
</dd>
</dl>

<dl>
<dd>

**$comment:** `?string` — Optional comment to leave with the review.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;addComment($agentId, $mergeProposalId, $request) -> ?AgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Leave a comment on a merge_proposal without recording a review verdict. Unlike reviews, comments accumulate and can still be added once the merge_proposal is merged or closed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->addComment(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtmprop_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyCommentOnAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdCommentsPost([
        'body' => 'body',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$mergeProposalId:** `string` — Unique identifier for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$body:** `string` — The comment text. Markdown is supported.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;mergeProposals-&gt;merge($agentId, $mergeProposalId, $request) -> ?AgentMergeProposalResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Execute the merge. The caller must have write access to the target branch (admins only, for a protected branch), so this is where a reviewer approves and merges a request opened by someone who could not.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->mergeProposals->merge(
    'agent_3701k3ttaq12ewp8b7qv5rfyszkz',
    'agtmprop_8901k4t9z5defmb8vh3e9361y7nj',
    new BodyMergeAMergeProposalV1ConvaiAgentsAgentIdMergeProposalsMergeProposalIdMergePost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$agentId:** `string` — The id of an agent. This is returned on agent creation.
    
</dd>
</dl>

<dl>
<dd>

**$mergeProposalId:** `string` — Unique identifier for the merge_proposal.
    
</dd>
</dl>

<dl>
<dd>

**$archiveSourceBranch:** `?bool` — Whether to archive the source branch after merging.
    
</dd>
</dl>

<dl>
<dd>

**$force:** `?bool` — Force source branch changes onto the target, overriding timestamp-based conflict resolution.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## OutboundCampaigns
<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;list($request) -> ?CampaignPageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the workspace's outbound campaigns, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->list(
    new ListOutboundCampaignsRequest([
        'pageSize' => 1,
        'status' => [
            CampaignStatus::Active->value,
        ],
        'agentId' => 'agent_id',
        'channel' => OutboundChannel::Phone->value,
        'mode' => ListOutboundCampaignsRequestMode::Voice->value,
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many items to return at most.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?array` — Only campaigns in one of these statuses.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `?string` — Only campaigns run by this agent.
    
</dd>
</dl>

<dl>
<dd>

**$channel:** `?OutboundChannel` — Only campaigns on this channel.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `?ListOutboundCampaignsRequestMode` — Only voice or only message campaigns.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Only campaigns whose name contains this text.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;pauseAll() -> ?PauseAllCampaignsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Pause every running outbound campaign in the workspace. Paused campaigns place no new calls until resumed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->pauseAll();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;stopAll() -> ?StopAllCampaignsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stop every outbound campaign in the workspace that hasn't finished. Returns `202` while calls already placed are still finishing.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->stopAll();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;create($request) -> ?SubmitCampaignResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an outbound campaign that calls or messages each recipient with the agent, within the policy's calling windows, retrying and following up as it allows. Returns `201` for a new campaign. A repeated request, matched by `idempotency_key` or else by its body, returns the existing campaign with `created` false.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->create(
    new SubmitCampaignRequest([
        'callName' => 'call_name',
        'agentId' => 'agent_id',
        'recipients' => [
            new SubmitCampaignRecipient([]),
        ],
        'channelConfig' => SubmitCampaignRequestChannelConfig::phone(new PhoneChannelConfigInput([
            'agentPhoneNumberId' => 'agent_phone_number_id',
        ])),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$callName:** `string` — The campaign's name.
    
</dd>
</dl>

<dl>
<dd>

**$agentId:** `string` — The agent that places the calls.
    
</dd>
</dl>

<dl>
<dd>

**$recipients:** `array` — Who to call. Each recipient becomes a lead of the campaign.
    
</dd>
</dl>

<dl>
<dd>

**$scheduledTimeUnix:** `?int` — When to start calling; omit to start now. Calls still wait for the next calling window.
    
</dd>
</dl>

<dl>
<dd>

**$timezone:** `?string` — IANA timezone to read the calling windows in, overriding the policy's.
    
</dd>
</dl>

<dl>
<dd>

**$branchId:** `?string` — The agent branch to call with.
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — The environment to resolve the agent's environment variables in.
    
</dd>
</dl>

<dl>
<dd>

**$targetConcurrencyLimit:** `?int` — The most calls to place at once.
    
</dd>
</dl>

<dl>
<dd>

**$idempotencyKey:** `?string` — Makes the request safe to retry: a repeat with the same key returns the campaign it created.
    
</dd>
</dl>

<dl>
<dd>

**$policy:** `?PolicyConfigInput` — Policy to snapshot onto the campaign. When set, it wins over the workspace default and any per-agent override; when omitted, the workspace configuration must exist and supplies the policy.
    
</dd>
</dl>

<dl>
<dd>

**$variant:** `?CampaignVariant` — `simple` runs one attempt per recipient with always-on calling windows and nothing collected, and cannot be combined with `policy`. `advanced` uses `policy` or the workspace configuration, and is the default for phone campaigns.
    
</dd>
</dl>

<dl>
<dd>

**$channelConfig:** `SubmitCampaignRequestChannelConfig` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;get($campaignId) -> ?CampaignResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get an outbound campaign and its lead counts.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->get(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;getProgress($campaignId) -> ?CampaignProgressResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get where an outbound campaign's leads and calls stand, and when its next call is due.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->getProgress(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;getFollowUpRequests($campaignId) -> ?CampaignFollowUpRequestsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Count the callbacks and redirects contacts asked for during an outbound campaign's calls.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->getFollowUpRequests(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;pause($campaignId) -> ?CampaignResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Pause an outbound campaign. It places no new calls until resumed; calls already placed carry on.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->pause(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;resume($campaignId) -> ?CampaignResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Resume a paused outbound campaign, including calls an attention item held back.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->resume(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;stop($campaignId) -> ?CampaignResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stop an outbound campaign for good: queued calls are cancelled and no lead is called again. Returns `202` with the campaign `stopping` while calls already placed are still finishing.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->stop(
    'campaign_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Config
<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;config-&gt;get() -> ?WorkspaceConfigResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get the workspace's outbound campaign configuration: the default policy new campaigns take, and per-agent overrides.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->config->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;config-&gt;update($request) -> ?WorkspaceConfigResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create or replace the workspace's outbound campaign configuration. Send the `version` you last read as `expected_version`, or omit it to create the first configuration. A configuration changed since you read it is not replaced. Campaigns keep the policy they started with.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->config->update(
    new ReplaceWorkspaceConfigRequest([
        'config' => new CampaignConfigInput([]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$expectedVersion:** `?int` — The `version` of the configuration being replaced. Omit it only to create the first configuration.
    
</dd>
</dl>

<dl>
<dd>

**$config:** `CampaignConfigInput` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Leads
<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;leads-&gt;list($campaignId, $request) -> ?CampaignLeadsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the leads of an outbound campaign, one per recipient.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->leads->list(
    'campaign_id',
    new ListLeadsRequest([
        'pageSize' => 1,
        'search' => 'search',
        'status' => ListLeadsRequestStatus::InProgress->value,
        'disposition' => [
            TerminalDisposition::CampaignEnded->value,
        ],
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many items to return at most.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Only leads whose ID, user ID or phone number contains this text.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?ListLeadsRequestStatus` — `in_progress` for leads still being called, `finished` for leads that won't be called again.
    
</dd>
</dl>

<dl>
<dd>

**$disposition:** `?array` — Only leads that finished in one of these ways.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;leads-&gt;get($campaignId, $leadId) -> ?LeadDetailResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get one lead of an outbound campaign.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->leads->get(
    'campaign_id',
    'lead_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$leadId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;leads-&gt;delete($campaignId, $leadId) -> ?SuppressLeadResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a lead from an outbound campaign so it is never called again. Returns `202` when a call already placed may still go through.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->leads->delete(
    'campaign_id',
    'lead_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$leadId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Calls
<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;calls-&gt;list($campaignId, $request) -> ?CampaignCallsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the calls of an outbound campaign, newest first: first contacts, retries, callbacks and redirects, whether queued, under way or done.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->calls->list(
    'campaign_id',
    new ListCallsRequest([
        'pageSize' => 1,
        'leadId' => 'lead_id',
        'status' => CallStatus::Queued->value,
        'callResult' => [
            CallResult::Answered->value,
        ],
        'stage' => ListCallsRequestStage::Queued->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many items to return at most.
    
</dd>
</dl>

<dl>
<dd>

**$leadId:** `?string` — Only this lead's calls.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?CallStatus` — Only calls in this status.
    
</dd>
</dl>

<dl>
<dd>

**$callResult:** `?array` — Only calls that ended in one of these results.
    
</dd>
</dl>

<dl>
<dd>

**$stage:** `?ListCallsRequestStage` — Only messages at this delivery stage. Message campaigns only.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;calls-&gt;export($campaignId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Download every call of a campaign, with its lead and conversation results, as CSV.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->agents->outboundCampaigns->calls->export(
    'campaign_id',
    new ExportCallsRequest([
        'limit' => 1,
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` — Only export the first N calls; used to preview the columns. Omit to export every call.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Attention
<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;attention-&gt;list($request) -> ?AttentionPageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List problems in the workspace's outbound campaigns that need you to act, such as an agent or phone number that can no longer be used, newest first. A campaign with an open item holds back the calls it affects.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->attention->list(
    new ListAttentionRequest([
        'campaignId' => 'campaign_id',
        'includeResolved' => true,
        'pageSize' => 1,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$campaignId:** `?string` — Only this campaign's items.
    
</dd>
</dl>

<dl>
<dd>

**$includeResolved:** `?bool` — Include items that are already resolved.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many items to return at most.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;attention-&gt;retry($attentionId) -> ?AttentionView</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Place the calls a retryable attention item holds back, once its cause is fixed. Resumes the campaign.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->attention->retry(
    'attention_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$attentionId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;outboundCampaigns-&gt;attention-&gt;resolve($attentionId, $request) -> ?AttentionView</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Close an attention item that can't be retried, recording how it was handled.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->outboundCampaigns->attention->resolve(
    'attention_id',
    new AttentionResolutionRequest([
        'resolution' => 'resolution',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$attentionId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$resolution:** `string` — How the item was handled.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Realtime
<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;listConversationGroups($request) -> ?RealtimeConversationGroupsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the realtime conversation groups the current user can view.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->listConversationGroups(
    new ListConversationGroupsRealtimeRequest([
        'pageSize' => 1,
        'search' => 'search',
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many conversation groups to return. Can not exceed 100.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — If specified, only conversation groups whose title or description contains this string (case-insensitive) are returned.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;createConversationGroup($request) -> ?RealtimeConversationGroupResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a realtime conversation group owned by the current user.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->createConversationGroup(
    new CreateRealtimeConversationGroupRequestModel([
        'title' => 'title',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$title:** `string` — Name of the conversation group. Names are unique per workspace, ignoring case and extra whitespace, and at most 64 characters.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Optional description of the conversation group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;getConversationGroup($conversationGroupId) -> ?RealtimeConversationGroupResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a realtime conversation group by id.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->getConversationGroup(
    'conversation_group_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationGroupId:** `string` — The id of a realtime conversation group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;updateConversationGroup($conversationGroupId, $request) -> ?RealtimeConversationGroupResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Rename or re-describe a realtime conversation group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->updateConversationGroup(
    'conversation_group_id',
    new UpdateRealtimeConversationGroupRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationGroupId:** `string` — The id of a realtime conversation group.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — Name of the conversation group. Names are unique per workspace, ignoring case and extra whitespace, and at most 64 characters.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — New description of the conversation group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;deleteConversationGroup($conversationGroupId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a realtime conversation group. Every conversation in it becomes ungrouped, so access granted through the group is revoked.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->deleteConversationGroup(
    'conversation_group_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationGroupId:** `string` — The id of a realtime conversation group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;setConversationGroup($conversationId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Place a realtime conversation in a conversation group, moving it out of its current group if it has one.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->setConversationGroup(
    'conversation_id',
    new SetConversationGroupRequestModel([
        'conversationGroupId' => 'conversation_group_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of a realtime conversation.
    
</dd>
</dl>

<dl>
<dd>

**$conversationGroupId:** `string` — The conversation group to place the conversation in. A conversation belongs to at most one group, so this moves it out of any current group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;clearConversationGroup($conversationId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove a realtime conversation from its conversation group.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->clearConversationGroup(
    'conversation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$conversationId:** `string` — The id of a realtime conversation.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;agents-&gt;realtime-&gt;createClientSecret($request) -> ?ClientSecretResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create an ephemeral client secret for authenticating browser-based Realtime API sessions.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->agents->realtime->createClientSecret(
    new CreateClientSecretRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$session:** `?OpenAiSessionConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$expiresAfter:** `?ExpiresAfter` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TextToSpeech
<details><summary><code>$client-&gt;textToSpeech-&gt;convert($voiceId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts text into speech using a voice of your choice and returns audio.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToSpeech->convert(
    'JBFqnCBsd6RMkjVDRZzb',
    new BodyTextToSpeechFull([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => ConvertTextToSpeechRequestOutputFormat::Mp344100128->value,
        'text' => 'The first move is what sets everything in motion.',
        'modelId' => 'eleven_multilingual_v2',
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?ConvertTextToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text that will get converted into speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?VoiceSettings` — Voice settings overriding stored settings for the given voice. They are applied only on the given request.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that came before the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$nextText:** `?string` — The text that comes after the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_id of the samples that were generated before this generation. Can be used to improve the speech's continuity when splitting up a large task into multiple requests. The results will be best when the same model is used across the generations. In case both previous_text and previous_request_ids is send, previous_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_id of the samples that come after this generation. next_request_ids is especially useful for maintaining the speech's continuity when regenerating a sample that has had some audio quality issues. For example, if you have generated 3 speech clips, and you want to improve clip 2, passing the request id of clip 3 as a next_request_id (and that of clip 1 as a previous_request_id) will help maintain natural flow in the combined speech. The results will be best when the same model is used across the generations. In case both next_text and next_request_ids is send, next_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToSpeechFullApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$applyLanguageTextNormalization:** `?bool` — This parameter controls language text normalization. This helps with proper pronunciation of text in some supported languages. WARNING: This parameter can heavily increase the latency of the request. Currently only supported for Japanese.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToSpeech-&gt;convertWithTimestamps($voiceId, $request) -> ?AudioWithTimestampsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generate speech from text with precise character-level timing information for audio-text synchronization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToSpeech->convertWithTimestamps(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyTextToSpeechFullWithTimestamps([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => ConvertWithTimestampsTextToSpeechRequestOutputFormat::Alaw8000->value,
        'text' => 'This is a test for the API of ElevenLabs.',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?ConvertWithTimestampsTextToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text that will get converted into speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?VoiceSettings` — Voice settings overriding stored settings for the given voice. They are applied only on the given request.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that came before the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$nextText:** `?string` — The text that comes after the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_id of the samples that were generated before this generation. Can be used to improve the speech's continuity when splitting up a large task into multiple requests. The results will be best when the same model is used across the generations. In case both previous_text and previous_request_ids is send, previous_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_id of the samples that come after this generation. next_request_ids is especially useful for maintaining the speech's continuity when regenerating a sample that has had some audio quality issues. For example, if you have generated 3 speech clips, and you want to improve clip 2, passing the request id of clip 3 as a next_request_id (and that of clip 1 as a previous_request_id) will help maintain natural flow in the combined speech. The results will be best when the same model is used across the generations. In case both next_text and next_request_ids is send, next_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToSpeechFullWithTimestampsApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$applyLanguageTextNormalization:** `?bool` — This parameter controls language text normalization. This helps with proper pronunciation of text in some supported languages. WARNING: This parameter can heavily increase the latency of the request. Currently only supported for Japanese.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToSpeech-&gt;stream($voiceId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts text into speech using a voice of your choice and returns audio as an audio stream.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToSpeech->stream(
    'JBFqnCBsd6RMkjVDRZzb',
    new StreamTextToSpeechRequest([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => StreamTextToSpeechRequestOutputFormat::Mp344100128->value,
        'text' => 'The first move is what sets everything in motion.',
        'modelId' => 'eleven_multilingual_v2',
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?StreamTextToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text that will get converted into speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?VoiceSettings` — Voice settings overriding stored settings for the given voice. They are applied only on the given request.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that came before the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$nextText:** `?string` — The text that comes after the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_id of the samples that were generated before this generation. Can be used to improve the speech's continuity when splitting up a large task into multiple requests. The results will be best when the same model is used across the generations. In case both previous_text and previous_request_ids is send, previous_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_id of the samples that come after this generation. next_request_ids is especially useful for maintaining the speech's continuity when regenerating a sample that has had some audio quality issues. For example, if you have generated 3 speech clips, and you want to improve clip 2, passing the request id of clip 3 as a next_request_id (and that of clip 1 as a previous_request_id) will help maintain natural flow in the combined speech. The results will be best when the same model is used across the generations. In case both next_text and next_request_ids is send, next_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToSpeechStreamApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$applyLanguageTextNormalization:** `?bool` — This parameter controls language text normalization. This helps with proper pronunciation of text in some supported languages. WARNING: This parameter can heavily increase the latency of the request. Currently only supported for Japanese.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToSpeech-&gt;streamWithTimestamps($voiceId, $request) -> StreamingAudioChunkWithTimestampsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts text into speech using a voice of your choice and returns a stream of JSONs containing audio as a base64 encoded string together with information on when which character was spoken.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToSpeech->streamWithTimestamps(
    'JBFqnCBsd6RMkjVDRZzb',
    new StreamTextToSpeechWithTimestampsRequest([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => StreamWithTimestampsTextToSpeechRequestOutputFormat::Mp344100128->value,
        'text' => 'The first move is what sets everything in motion.',
        'modelId' => 'eleven_multilingual_v2',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?StreamWithTimestampsTextToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text that will get converted into speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?VoiceSettings` — Voice settings overriding stored settings for the given voice. They are applied only on the given request.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that came before the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$nextText:** `?string` — The text that comes after the text of the current request. Can be used to improve the speech's continuity when concatenating together multiple generations or to influence the speech's continuity in the current generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_id of the samples that were generated before this generation. Can be used to improve the speech's continuity when splitting up a large task into multiple requests. The results will be best when the same model is used across the generations. In case both previous_text and previous_request_ids is send, previous_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_id of the samples that come after this generation. next_request_ids is especially useful for maintaining the speech's continuity when regenerating a sample that has had some audio quality issues. For example, if you have generated 3 speech clips, and you want to improve clip 2, passing the request id of clip 3 as a next_request_id (and that of clip 1 as a previous_request_id) will help maintain natural flow in the combined speech. The results will be best when the same model is used across the generations. In case both next_text and next_request_ids is send, next_text will be ignored. A maximum of 3 request_ids can be sent.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToSpeechStreamWithTimestampsApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$applyLanguageTextNormalization:** `?bool` — This parameter controls language text normalization. This helps with proper pronunciation of text in some supported languages. WARNING: This parameter can heavily increase the latency of the request. Currently only supported for Japanese.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TextToSpeech
<details><summary><code>$client-&gt;flows-&gt;textToSpeech-&gt;list($request) -> ?MediaGenerationListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the speech generations created through this API, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->textToSpeech->list(
    new ListTextToSpeechRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'status' => ListTextToSpeechRequestStatus::Pending->value,
        'modelId' => 'model_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many generations to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?ListTextToSpeechRequestStatus` — Only return generations with this lifecycle status.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Only return generations of this model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;textToSpeech-&gt;create($request) -> ?MediaGenerationCreateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start a speech generation with the selected model. Charged per character via text-to-speech billing. Use this over `/v1/text-to-speech` for the asynchronous generation lifecycle or for models not offered there; for direct, synchronous speech synthesis, prefer `/v1/text-to-speech`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->textToSpeech->create(
    new ElevenFlashV25Request([
        'text' => 'The first move is what sets everything in motion.',
        'voice' => 'JBFqnCBsd6RMkjVDRZzb',
        'modelId' => ElevenFlashV25RequestModelId::ElevenFlashV25->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `TextToSpeechGenerationRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;textToSpeech-&gt;get($generationId) -> ?MediaGenerationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the status of a speech generation, and retrieve its output URL once completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->textToSpeech->get(
    'generation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$generationId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Video
<details><summary><code>$client-&gt;flows-&gt;video-&gt;list($request) -> ?MediaGenerationListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the video generations created through this API, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->video->list(
    new ListVideoRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'status' => ListVideoRequestStatus::Pending->value,
        'modelId' => 'model_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many generations to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?ListVideoRequestStatus` — Only return generations with this lifecycle status.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Only return generations of this model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;video-&gt;create($request) -> ?MediaGenerationCreateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start a video generation with the selected model.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->video->create(
    new CreatifyAuroraRequest([
        'modelId' => CreatifyAuroraRequestModelId::CreatifyAurora->value,
        'image' => ImageReference::generation(new GenerationReference([
            'type' => GenerationReferenceType::Generation->value,
            'generationId' => 'JWr5N6X9ZTqf8jD2LmQb',
        ])),
        'audio' => AudioReference::generation(new GenerationReference([
            'type' => GenerationReferenceType::Generation->value,
            'generationId' => 'JWr5N6X9ZTqf8jD2LmQb',
        ])),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `VideoGenerationRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;video-&gt;get($generationId) -> ?MediaGenerationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the status of a video generation, and retrieve its output URL once completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->video->get(
    'generation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$generationId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Image
<details><summary><code>$client-&gt;flows-&gt;image-&gt;list($request) -> ?MediaGenerationListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the image generations created through this API, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->image->list(
    new ListImageRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'status' => ListImageRequestStatus::Pending->value,
        'modelId' => 'model_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many generations to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?ListImageRequestStatus` — Only return generations with this lifecycle status.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Only return generations of this model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;image-&gt;create($request) -> ?MediaGenerationCreateResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start an image generation with the selected model.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->image->create(
    new GptImage1Request([
        'prompt' => 'A corgi in a tiny lifeguard chair on a sunlit beach at golden hour, photorealistic',
        'modelId' => GptImage1RequestModelId::GptImage1->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `ImageGenerationRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;image-&gt;get($generationId) -> ?MediaGenerationResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve the status of an image generation, and retrieve its output URL once completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->image->get(
    'generation_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$generationId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Templates
<details><summary><code>$client-&gt;flows-&gt;templates-&gt;list($request) -> ?TemplateListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the published flows templates in your workspace, together with each runnable version's inputs and outputs. Use the ids here as `template_id` / `version_id` on `POST /v1/flows/templates/{template_id}/runs`. Versions built on models that are not available to you through the API are left out, so `versions` is empty when none of a template's published versions is runnable through this API. Templates shared with you by link, or published to Explore from another workspace, are not listed but can still be fetched and run by `template_id`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->templates->list(
    new ListTemplatesRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'versionsPerTemplate' => 1,
        'search' => 'search',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many templates to return per page. Lower than the run list's ceiling because each row expands its versions' input and output schemas.
    
</dd>
</dl>

<dl>
<dd>

**$versionsPerTemplate:** `?int` — How many of each template's published versions to return, newest first. `has_more_versions` tells you when a template has more.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Only return templates whose name or description contains this text.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;templates-&gt;get($templateId, $request) -> ?TemplateSummary</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve one flows template, together with each runnable version's inputs and outputs. `versions` is empty when no published version is runnable through this API. Works for any template you can open, including templates shared with you by link or published to Explore from another workspace, which `GET /v1/flows/templates` does not list.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->templates->get(
    'template_id',
    new GetTemplatesRequest([
        'versionsPerTemplate' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `string` — The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
    
</dd>
</dl>

<dl>
<dd>

**$versionsPerTemplate:** `?int` — How many of each template's published versions to return, newest first. `has_more_versions` tells you when a template has more.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Runs
<details><summary><code>$client-&gt;flows-&gt;templates-&gt;runs-&gt;list($templateId, $request) -> ?TemplateRunListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List this template's runs created through this API, newest first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->templates->runs->list(
    'template_id',
    new ListRunsRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'versionId' => 'version_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `string` — The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor: the `next_cursor` value of the previous page's response. Omit it for the first page.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many runs to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — Only return runs of this template version id.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;templates-&gt;runs-&gt;create($templateId, $request) -> ?TemplateRunResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Start a run of a flows template. Pass `version_id` to pin a snapshot, or omit it / pass `latest` to run the latest published version. Set input values under `inputs`, keyed by input port id. The response is the run in its initial state, with every output already listed under its port id in `outputs`. Include `webhook` to receive a `flows_template_run` event carrying the finished run once its `status` is `completed` or `failed`; this is the recommended way to wait. Without one, fetch `GET /v1/flows/templates/{template_id}/runs/{run_id}` at a modest interval until the `status` is terminal.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->templates->runs->create(
    'template_id',
    new TemplateRunCreateRequest([
        'inputs' => [
            'prompt' => TemplateRunInput::fromMultiple([
                TemplateInputReference::generation(new GenerationReference([
                    'type' => GenerationReferenceType::Generation->value,
                    'generationId' => 'JWr5N6X9ZTqf8jD2LmQb',
                ])),
            ]),
            'reference' => TemplateRunInput::fromMultiple([
                TemplateInputReference::asset(new StaticAssetReference([
                    'type' => StaticAssetReferenceType::Asset->value,
                    'assetId' => '5xM2KqOnZyce22SPZ9d4',
                ])),
            ]),
        ],
        'versionId' => 'latest',
        'webhook' => WebhookTarget::all(new WebhookTargetAll([
            'type' => WebhookTargetAllType::All->value,
        ])),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `string` — The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
    
</dd>
</dl>

<dl>
<dd>

**$inputs:** `array` — Input values keyed by input port id. Every input port of the version being run must be given; a missing or unknown id is rejected. Pass `{}` for a template with no inputs.
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `?string` — The template snapshot to run. Pass a specific version id to pin that snapshot, or `latest` (the default when omitted) to run the template's most recently published version. Only published versions can be pinned, except by the template's owner, who may also pin an unpublished saved snapshot to try it out before publishing. The live draft is never run through this API.
    
</dd>
</dl>

<dl>
<dd>

**$webhook:** `?WebhookTarget` — Include to send the run's result to the workspace's configured flows webhooks once the run's `status` reaches `completed` or `failed`. One event for the whole run: the `flows_template_run` event's `data` matches the terminal response of `GET /v1/flows/templates/{template_id}/runs/{run_id}`.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;flows-&gt;templates-&gt;runs-&gt;get($templateId, $runId) -> ?TemplateRunResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a template run: its `status`, rolled up from its outputs, and each output's own status and download URL once completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->flows->templates->runs->get(
    'template_id',
    'run_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$templateId:** `string` — The ID of the template, as shown in the ElevenLabs app or by `GET /v1/flows/templates`.
    
</dd>
</dl>

<dl>
<dd>

**$runId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TextToDialogue
<details><summary><code>$client-&gt;textToDialogue-&gt;convert($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts a list of text and voice ID pairs into speech (dialogue) and returns audio.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToDialogue->convert(
    new BodyTextToDialogueMultiVoiceV1TextToDialoguePost([
        'outputFormat' => ConvertTextToDialogueRequestOutputFormat::Alaw8000->value,
        'enableLogging' => true,
        'inputs' => [
            new DialogueInput([
                'text' => '[giggling] Knock knock',
                'voiceId' => 'JBFqnCBsd6RMkjVDRZzb',
            ]),
            new DialogueInput([
                'text' => '[curious] Who is there?',
                'voiceId' => 'Aw4FAjKCGjjNkVhN1Xmq',
            ]),
        ],
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ConvertTextToDialogueRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$inputs:** `array` — A list of dialogue inputs, each containing text and a voice ID which will be converted into speech. The maximum number of unique voice IDs is 10. For reliable generation, keep the total character count across all `inputs[].text` values at or below 2,000 characters per request. Longer requests can terminate early in streaming responses or return a validation error.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?ToDialogueSettingsResponseModel` — Settings controlling the dialogue generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that comes immediately before this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$futureText:** `?string` — The text that comes immediately after this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToDialogueMultiVoiceV1TextToDialoguePostApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_ids of dialogue generations that came before this one. Used to condition the model for continuity when splitting a large task into multiple requests. A maximum of 3 request_ids can be sent. The last request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_ids of dialogue generations that come after this one. Useful for maintaining continuity when regenerating a clip in the middle of a sequence. A maximum of 3 request_ids can be sent. The first request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToDialogue-&gt;stream($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts a list of text and voice ID pairs into speech (dialogue) and returns an audio stream.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToDialogue->stream(
    new BodyTextToDialogueMultiVoiceStreamingV1TextToDialogueStreamPost([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'enableLogging' => true,
        'inputs' => [
            new DialogueInput([
                'text' => '[giggling] Knock knock',
                'voiceId' => 'JBFqnCBsd6RMkjVDRZzb',
            ]),
            new DialogueInput([
                'text' => '[curious] Who is there?',
                'voiceId' => 'Aw4FAjKCGjjNkVhN1Xmq',
            ]),
        ],
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$inputs:** `array` — A list of dialogue inputs, each containing text and a voice ID which will be converted into speech. The maximum number of unique voice IDs is 10. For reliable generation, keep the total character count across all `inputs[].text` values at or below 2,000 characters per request. Longer requests can terminate early in streaming responses or return a validation error.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?ToDialogueSettingsResponseModel` — Settings controlling the dialogue generation.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that comes immediately before this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$futureText:** `?string` — The text that comes immediately after this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToDialogueMultiVoiceStreamingV1TextToDialogueStreamPostApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_ids of dialogue generations that came before this one. Used to condition the model for continuity when splitting a large task into multiple requests. A maximum of 3 request_ids can be sent. The last request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_ids of dialogue generations that come after this one. Useful for maintaining continuity when regenerating a clip in the middle of a sequence. A maximum of 3 request_ids can be sent. The first request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToDialogue-&gt;streamWithTimestamps($request) -> StreamingAudioChunkWithTimestampsAndVoiceSegmentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Converts a list of text and voice ID pairs into speech (dialogue) and returns a stream of JSON blobs containing audio as a base64 encoded string and timestamps
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToDialogue->streamWithTimestamps(
    new BodyTextToDialogueStreamWithTimestamps([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'enableLogging' => true,
        'inputs' => [
            new DialogueInput([
                'text' => 'Hello, how are you?',
                'voiceId' => 'bYTqZQo3Jz7LQtmGTgwi',
            ]),
            new DialogueInput([
                'text' => "I'm doing well, thank you!",
                'voiceId' => '6lCwbsX1yVjD49QmpkTR',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$inputs:** `array` — A list of dialogue inputs, each containing text and a voice ID which will be converted into speech. The maximum number of unique voice IDs is 10. For reliable generation, keep the total character count across all `inputs[].text` values at or below 2,000 characters per request. Longer requests can terminate early in streaming responses or return a validation error.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?ToDialogueSettingsResponseModel` — Settings controlling the dialogue generation.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToDialogueStreamWithTimestampsApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_ids of dialogue generations that came before this one. Used to condition the model for continuity when splitting a large task into multiple requests. A maximum of 3 request_ids can be sent. The last request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_ids of dialogue generations that come after this one. Useful for maintaining continuity when regenerating a clip in the middle of a sequence. A maximum of 3 request_ids can be sent. The first request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that comes immediately before this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$futureText:** `?string` — The text that comes immediately after this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToDialogue-&gt;convertWithTimestamps($request) -> ?AudioWithTimestampsAndVoiceSegmentsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generate dialogue from text with precise character-level timing information for audio-text synchronization.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToDialogue->convertWithTimestamps(
    new BodyTextToDialogueFullWithTimestamps([
        'outputFormat' => ConvertWithTimestampsTextToDialogueRequestOutputFormat::Alaw8000->value,
        'enableLogging' => true,
        'inputs' => [
            new DialogueInput([
                'text' => 'Hello, how are you?',
                'voiceId' => 'bYTqZQo3Jz7LQtmGTgwi',
            ]),
            new DialogueInput([
                'text' => "I'm doing well, thank you!",
                'voiceId' => '6lCwbsX1yVjD49QmpkTR',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ConvertWithTimestampsTextToDialogueRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$inputs:** `array` — A list of dialogue inputs, each containing text and a voice ID which will be converted into speech. The maximum number of unique voice IDs is 10. For reliable generation, keep the total character count across all `inputs[].text` values at or below 2,000 characters per request. Longer requests can terminate early in streaming responses or return a validation error.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for text to speech, you can check this using the can_do_text_to_speech property.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — Language code (ISO 639-1) used to enforce a language for the model and text normalization. If the model does not support the provided language code, it will be ignored. This parameter is not supported for multilingual_v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$settings:** `?ToDialogueSettingsResponseModel` — Settings controlling the dialogue generation.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (id, version_id) to be applied to the text. They will be applied in order. You may have up to 3 locators per request
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyTextToDialogueFullWithTimestampsApplyTextNormalization` — This parameter controls text normalization with three modes: 'auto', 'on', and 'off'. When set to 'auto', the system will automatically decide whether to apply text normalization (e.g., spelling out numbers). With 'on', text normalization will always be applied, while with 'off', it will be skipped.
    
</dd>
</dl>

<dl>
<dd>

**$usePvcAsIvc:** `?bool` — Whether to use the IVC version of a professional voice. This may improve expressiveness and reduce latency.
    
</dd>
</dl>

<dl>
<dd>

**$previousRequestIds:** `?array` — A list of request_ids of dialogue generations that came before this one. Used to condition the model for continuity when splitting a large task into multiple requests. A maximum of 3 request_ids can be sent. The last request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$nextRequestIds:** `?array` — A list of request_ids of dialogue generations that come after this one. Useful for maintaining continuity when regenerating a clip in the middle of a sequence. A maximum of 3 request_ids can be sent. The first request_id is the audio which is closest to the current request. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$previousText:** `?string` — The text that comes immediately before this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$futureText:** `?string` — The text that comes immediately after this generation, used to condition the model for prosodic continuity. A maximum of 100 characters can be sent. Not supported by every model.
    
</dd>
</dl>

<dl>
<dd>

**$audioEffects:** `?EffectsSpecInput` — Audio effects applied to the generated audio. Unknown IDs return 404 with `param` naming the field. Reverb (`environment_id` with `send_level` above 0) and a non-zero `pan` produce stereo audio and are rejected with 400 for `ulaw_*`, `alaw_*`, and `pcm_*` output formats. Effects don't change the cost of the request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SpeechToSpeech
<details><summary><code>$client-&gt;speechToSpeech-&gt;convert($voiceId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Transform audio from one voice to another. Maintain full control over emotion, timing and delivery.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->speechToSpeech->convert(
    'JBFqnCBsd6RMkjVDRZzb',
    new BodyVoiceChangerV1VoiceChangerVoiceIdPost([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => ConvertSpeechToSpeechRequestOutputFormat::Mp344100128->value,
        'audio' => File::createFromString("example_audio", "example_audio"),
        'modelId' => 'eleven_multilingual_sts_v2',
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?ConvertSpeechToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM and WAV formats with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$audio:** `mixed` — The audio file which holds the content and emotion that will control the generated speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for speech to speech, you can check this using the can_do_voice_conversion property.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?string` — Voice settings overriding stored settings for the given voice. They are applied only on the given request. Needs to be send as a JSON encoded string.
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set, will remove the background noise from your audio input using our audio isolation model. Only applies to Voice Changer.
    
</dd>
</dl>

<dl>
<dd>

**$fileFormat:** `?SpeechToSpeechRequestFileFormat` — The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechToSpeech-&gt;stream($voiceId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream audio from one voice to another. Maintain full control over emotion, timing and delivery.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->speechToSpeech->stream(
    'JBFqnCBsd6RMkjVDRZzb',
    new BodyVoiceChangerStreamingV1VoiceChangerVoiceIdStreamPost([
        'enableLogging' => true,
        'optimizeStreamingLatency' => 1,
        'outputFormat' => StreamSpeechToSpeechRequestOutputFormat::Mp344100128->value,
        'audio' => File::createFromString("example_audio", "example_audio"),
        'modelId' => 'eleven_multilingual_sts_v2',
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — ID of the voice to be used. Use the [Get voices](/docs/api-reference/voices/search) endpoint list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean history features are unavailable for this request, including request stitching. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$optimizeStreamingLatency:** `?int` 

You can turn on latency optimizations at some cost of quality. The best possible final latency varies by model. Possible values:
0 - default mode (no latency optimizations)
1 - normal latency optimizations (about 50% of possible latency improvement of option 3)
2 - strong latency optimizations (about 75% of possible latency improvement of option 3)
3 - max latency optimizations
4 - max latency optimizations, but also with text normalizer turned off for even more latency savings (best latency, but can mispronounce eg numbers and dates).

Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?StreamSpeechToSpeechRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$audio:** `mixed` — The audio file which holds the content and emotion that will control the generated speech.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — Identifier of the model that will be used, you can query them using GET /v1/models. The model needs to have support for speech to speech, you can check this using the can_do_voice_conversion property.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?string` — Voice settings overriding stored settings for the given voice. They are applied only on the given request. Needs to be send as a JSON encoded string.
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be integer between 0 and 4294967295.
    
</dd>
</dl>

<dl>
<dd>

**$removeBackgroundNoise:** `?bool` — If set, will remove the background noise from your audio input using our audio isolation model. Only applies to Voice Changer.
    
</dd>
</dl>

<dl>
<dd>

**$fileFormat:** `?SpeechToSpeechStreamRequestFileFormat` — The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## TextToVoice
<details><summary><code>$client-&gt;textToVoice-&gt;create($request) -> ?Voice</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a voice from previously generated voice preview. This endpoint should be called after you fetched a generated_voice_id using POST /v1/text-to-voice/design or POST /v1/text-to-voice/:voice_id/remix.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToVoice->create(
    new BodyCreateANewVoiceFromVoicePreviewV1TextToVoicePost([
        'voiceName' => 'Sassy squeaky mouse',
        'voiceDescription' => 'A sassy squeaky mouse',
        'generatedVoiceId' => '37HceQefKmEi3bGovXjL',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceName:** `string` — Name to use for the created voice.
    
</dd>
</dl>

<dl>
<dd>

**$voiceDescription:** `string` — Description to use for the created voice.
    
</dd>
</dl>

<dl>
<dd>

**$generatedVoiceId:** `string` — The generated_voice_id to create; obtain it from POST /v1/text-to-voice/design, POST /v1/text-to-voice/:voice_id/remix, or the response headers when generating previews.
    
</dd>
</dl>

<dl>
<dd>

**$labels:** `?array` — Optional, metadata to add to the created voice. Defaults to None.
    
</dd>
</dl>

<dl>
<dd>

**$playedNotSelectedVoiceIds:** `?array` — List of voice ids that the user has played but not selected. Used for RLHF.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToVoice-&gt;design($request) -> ?VoiceDesignPreviewResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Design a voice via a prompt. This method returns a list of voice previews. Each preview has a generated_voice_id and a sample of the voice as base64 encoded mp3 audio. To create a voice use the generated_voice_id of the preferred preview with the /v1/text-to-voice endpoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToVoice->design(
    new VoiceDesignRequestModel([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'voiceDescription' => 'A sassy squeaky mouse',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$voiceDescription:** `string` — Description to use for the created voice.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?VoiceDesignRequestModelModelId` — Model to use for the voice generation. Possible values: eleven_multilingual_ttv_v2, eleven_ttv_v3.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `?string` — Text to generate, text length has to be between 100 and 1000.
    
</dd>
</dl>

<dl>
<dd>

**$autoGenerateText:** `?bool` — Whether to automatically generate a text suitable for the voice description.
    
</dd>
</dl>

<dl>
<dd>

**$loudness:** `?float` — Controls the volume level of the generated voice. -1 is quietest, 1 is loudest, 0 corresponds to roughly -24 LUFS.
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random number that controls the voice generation. Same seed with same inputs produces same voice.
    
</dd>
</dl>

<dl>
<dd>

**$guidanceScale:** `?float` — Controls how closely the AI follows the prompt. Lower numbers give the AI more freedom to be creative, while higher numbers force it to stick more to the prompt. High numbers can cause voice to sound artificial or robotic. We recommend to use longer, more detailed prompts at lower Guidance Scale.
    
</dd>
</dl>

<dl>
<dd>

**$streamPreviews:** `?bool` — Determines whether the Text to Voice previews should be included in the response. If true, only the generated IDs will be returned which can then be streamed via the /v1/text-to-voice/:generated_voice_id/stream endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$shouldEnhance:** `?bool` — Whether to enhance the voice description using AI to add more detail and improve voice generation quality. When enabled, the system will automatically expand simple prompts into more detailed voice descriptions. Defaults to False
    
</dd>
</dl>

<dl>
<dd>

**$remixingSessionId:** `?string` — The remixing session id.
    
</dd>
</dl>

<dl>
<dd>

**$remixingSessionIterationId:** `?string` — The id of the remixing session iteration where these generations should be attached to. If not provided, a new iteration will be created.
    
</dd>
</dl>

<dl>
<dd>

**$quality:** `?float` — Higher quality results in better voice output but less variety.
    
</dd>
</dl>

<dl>
<dd>

**$referenceAudioBase64:** `?string` — Reference audio to use for the voice generation. The audio should be base64 encoded. Only supported when using the  eleven_ttv_v3 model.
    
</dd>
</dl>

<dl>
<dd>

**$promptStrength:** `?float` — Controls the balance of prompt versus reference audio when generating voice samples. 0 means almost no prompt influence, 1 means almost no reference audio influence. Only supported when using the eleven_ttv_v3 model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;textToVoice-&gt;remix($voiceId, $request) -> ?VoiceDesignPreviewResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remix an existing voice via a prompt. This method returns a list of voice previews. Each preview has a generated_voice_id and a sample of the voice as base64 encoded mp3 audio. To create a voice use the generated_voice_id of the preferred preview with the /v1/text-to-voice endpoint.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->textToVoice->remix(
    '21m00Tcm4TlvDq8ikWAM',
    new VoiceRemixRequestModel([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'voiceDescription' => 'Make the voice have a higher pitch.',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$voiceId:** `string` — Voice ID to be used, you can use https://api.elevenlabs.io/v1/voices to list all the available voices.
    
</dd>
</dl>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$voiceDescription:** `string` — Description of the changes to make to the voice.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `?string` — Text to generate, text length has to be between 100 and 1000.
    
</dd>
</dl>

<dl>
<dd>

**$autoGenerateText:** `?bool` — Whether to automatically generate a text suitable for the voice description.
    
</dd>
</dl>

<dl>
<dd>

**$loudness:** `?float` — Controls the volume level of the generated voice. -1 is quietest, 1 is loudest, 0 corresponds to roughly -24 LUFS.
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random number that controls the voice generation. Same seed with same inputs produces same voice.
    
</dd>
</dl>

<dl>
<dd>

**$guidanceScale:** `?float` — Controls how closely the AI follows the prompt. Lower numbers give the AI more freedom to be creative, while higher numbers force it to stick more to the prompt. High numbers can cause voice to sound artificial or robotic. We recommend to use longer, more detailed prompts at lower Guidance Scale.
    
</dd>
</dl>

<dl>
<dd>

**$streamPreviews:** `?bool` — Determines whether the Text to Voice previews should be included in the response. If true, only the generated IDs will be returned which can then be streamed via the /v1/text-to-voice/:generated_voice_id/stream endpoint.
    
</dd>
</dl>

<dl>
<dd>

**$remixingSessionId:** `?string` — The remixing session id.
    
</dd>
</dl>

<dl>
<dd>

**$remixingSessionIterationId:** `?string` — The id of the remixing session iteration where these generations should be attached to. If not provided, a new iteration will be created.
    
</dd>
</dl>

<dl>
<dd>

**$promptStrength:** `?float` — Controls the balance of prompt versus reference audio when generating voice samples. 0 means almost no prompt influence, 1 means almost no reference audio influence. Only supported when using the eleven_ttv_v3 model.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Preview
<details><summary><code>$client-&gt;textToVoice-&gt;preview-&gt;stream($generatedVoiceId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream a voice preview that was created via the /v1/text-to-voice/design endpoint.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->textToVoice->preview->stream(
    '37HceQefKmEi3bGovXjL',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$generatedVoiceId:** `string` — The generated_voice_id to stream.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## User
<details><summary><code>$client-&gt;user-&gt;get() -> ?User</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets information about the user
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Subscription
<details><summary><code>$client-&gt;user-&gt;subscription-&gt;get() -> ?Subscription</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets extended information about the users subscription
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->user->subscription->get();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Studio
<details><summary><code>$client-&gt;studio-&gt;createPodcast($request) -> ?PodcastProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create and auto-convert a podcast project. Currently, the LLM cost is covered by us but you will still be charged for the audio generation. In the future, you will be charged for both the LLM and audio generation costs.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->createPodcast(
    new BodyCreatePodcastV1StudioPodcastsPost([
        'modelId' => 'eleven_multilingual_v2',
        'mode' => BodyCreatePodcastV1StudioPodcastsPostMode::conversation(new PodcastConversationMode([
            'type' => PodcastConversationModeType::Conversation->value,
            'conversation' => new PodcastConversationModeData([
                'hostVoiceId' => 'aw1NgEzBg83R7vgmiJt6',
                'guestVoiceId' => 'aw1NgEzBg83R7vgmiJt7',
            ]),
        ])),
        'source' => new PodcastTextSource([
            'type' => PodcastTextSourceType::Text->value,
            'text' => 'text',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$safetyIdentifier:** `?string` — Used for moderation. Your workspace must be allowlisted to use this feature.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `string` — The ID of the model to be used for this Studio project, you can query GET /v1/models to list all available models.
    
</dd>
</dl>

<dl>
<dd>

**$mode:** `BodyCreatePodcastV1StudioPodcastsPostMode` — The type of podcast to generate. Can be 'conversation', an interaction between two voices, or 'bulletin', a monologue.
    
</dd>
</dl>

<dl>
<dd>

**$source:** `BodyCreatePodcastV1StudioPodcastsPostSource` — The source content for the Podcast.
    
</dd>
</dl>

<dl>
<dd>

**$qualityPreset:** `?QualityPresetType` 

Output quality of the generated audio. Must be one of:
'standard' - standard output format, 128kbps with 44.1kHz sample rate.
'high' - high quality output format, 192kbps with 44.1kHz sample rate and major improvements on our side.
'ultra' - ultra quality output format, 192kbps with 44.1kHz sample rate and highest improvements on our side.
'ultra_lossless' - ultra quality output format, 705.6kbps with 44.1kHz sample rate and highest improvements on our side in a fully lossless format.
If not provided, defaults to the highest quality preset available on your subscription tier.
    
</dd>
</dl>

<dl>
<dd>

**$durationScale:** `?BodyCreatePodcastV1StudioPodcastsPostDurationScale` 

Duration of the generated podcast. Must be one of:
short - produces podcasts shorter than 3 minutes.
default - produces podcasts roughly between 3-7 minutes.
long - produces podcasts longer than 7 minutes.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` — An optional language of the Studio project. Two-letter language code (ISO 639-1).
    
</dd>
</dl>

<dl>
<dd>

**$intro:** `?string` — The intro text that will always be added to the beginning of the podcast.
    
</dd>
</dl>

<dl>
<dd>

**$outro:** `?string` — The outro text that will always be added to the end of the podcast.
    
</dd>
</dl>

<dl>
<dd>

**$instructionsPrompt:** `?string` — Additional instructions prompt for the podcast generation used to adjust the podcast's style and tone.
    
</dd>
</dl>

<dl>
<dd>

**$highlights:** `?array` — A brief summary or highlights of the Studio project's content, providing key points or themes. This should be between 10 and 70 characters.
    
</dd>
</dl>

<dl>
<dd>

**$callbackUrl:** `?string` 

A url that will be called by our service when the Studio project is converted. Request will contain a json blob containing the status of the conversion
    Messages:
    1. When project was converted successfully:
    {
      type: "project_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        conversion_status: "success",
        project_snapshot_id: "22m00Tcm4TlvDq8ikMAT",
        error_details: None,
      }
    }
    2. When project conversion failed:
    {
      type: "project_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        conversion_status: "error",
        project_snapshot_id: None,
        error_details: "Error details if conversion failed"
      }
    }

    3. When chapter was converted successfully:
    {
      type: "chapter_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        chapter_id: "22m00Tcm4TlvDq8ikMAT",
        conversion_status: "success",
        chapter_snapshot_id: "23m00Tcm4TlvDq8ikMAV",
        error_details: None,
      }
    }
    4. When chapter conversion failed:
    {
      type: "chapter_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        chapter_id: "22m00Tcm4TlvDq8ikMAT",
        conversion_status: "error",
        chapter_snapshot_id: None,
        error_details: "Error details if conversion failed"
      }
    }
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?BodyCreatePodcastV1StudioPodcastsPostApplyTextNormalization` 

This parameter controls text normalization with four modes: 'auto', 'on', 'apply_english' and 'off'.
    When set to 'auto', the system will automatically decide whether to apply text normalization
    (e.g., spelling out numbers). With 'on', text normalization will always be applied, while
    with 'off', it will be skipped. 'apply_english' is the same as 'on' but will assume that text is in English.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Projects
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;list() -> ?GetProjectsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of your Studio projects with metadata.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;create($request) -> ?AddProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new Studio project, it can be either initialized as blank, from a document or from a URL.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->create(
    new BodyCreateStudioProjectV1StudioProjectsPost([
        'name' => 'Project 1',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the Studio project, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$defaultTitleVoiceId:** `?string` — The voice_id that corresponds to the default voice used for new titles.
    
</dd>
</dl>

<dl>
<dd>

**$defaultParagraphVoiceId:** `?string` — The voice_id that corresponds to the default voice used for new paragraphs.
    
</dd>
</dl>

<dl>
<dd>

**$defaultModelId:** `?string` — The ID of the model to be used for this Studio project, you can query GET /v1/models to list all available models.
    
</dd>
</dl>

<dl>
<dd>

**$fromUrl:** `?string` — An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
    
</dd>
</dl>

<dl>
<dd>

**$fromDocument:** `mixed` — An optional .epub, .pdf, .txt or similar file can be provided. If provided, we will initialize the Studio project with its content. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
    
</dd>
</dl>

<dl>
<dd>

**$fromContentJson:** `?string` 

An optional content to initialize the Studio project with. If this is set, 'from_url' and 'from_document' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.

    Example:
    [{"name": "Chapter A", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "A", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "B", "type": "tts_node"}]}, {"sub_type": "h1", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "C", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "D", "type": "tts_node"}]}]}, {"name": "Chapter B", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "E", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "F", "type": "tts_node"}]}, {"sub_type": "h2", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "G", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "H", "type": "tts_node"}]}]}]
    
</dd>
</dl>

<dl>
<dd>

**$qualityPreset:** `?QualityPresetType` 

Output quality of the generated audio. Must be one of:
'standard' - standard output format, 128kbps with 44.1kHz sample rate.
'high' - high quality output format, 192kbps with 44.1kHz sample rate and major improvements on our side.
'ultra' - ultra quality output format, 192kbps with 44.1kHz sample rate and highest improvements on our side.
'ultra_lossless' - ultra quality output format, 705.6kbps with 44.1kHz sample rate and highest improvements on our side in a fully lossless format.
If not provided, defaults to the highest quality preset available on your subscription tier.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$author:** `?string` — An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — An optional description of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$genres:** `?array` — An optional list of genres associated with the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$targetAudience:** `?CreateProjectsRequestTargetAudience` — An optional target audience of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` — An optional language of the Studio project. Two-letter language code (ISO 639-1).
    
</dd>
</dl>

<dl>
<dd>

**$contentType:** `?string` — An optional content type of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$originalPublicationDate:** `?string` — An optional original publication date of the Studio project, in the format YYYY-MM-DD or YYYY.
    
</dd>
</dl>

<dl>
<dd>

**$matureContent:** `?bool` — An optional specification of whether this Studio project contains mature content.
    
</dd>
</dl>

<dl>
<dd>

**$isbnNumber:** `?string` — An optional ISBN number of the Studio project you want to create, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$acxVolumeNormalization:** `?bool` — [Deprecated] When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
    
</dd>
</dl>

<dl>
<dd>

**$volumeNormalization:** `?bool` — When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
    
</dd>
</dl>

<dl>
<dd>

**$callbackUrl:** `?string` 

A url that will be called by our service when the Studio project is converted. Request will contain a json blob containing the status of the conversion
    Messages:
    1. When project was converted successfully:
    {
      type: "project_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        conversion_status: "success",
        project_snapshot_id: "22m00Tcm4TlvDq8ikMAT",
        error_details: None,
      }
    }
    2. When project conversion failed:
    {
      type: "project_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        conversion_status: "error",
        project_snapshot_id: None,
        error_details: "Error details if conversion failed"
      }
    }

    3. When chapter was converted successfully:
    {
      type: "chapter_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        chapter_id: "22m00Tcm4TlvDq8ikMAT",
        conversion_status: "success",
        chapter_snapshot_id: "23m00Tcm4TlvDq8ikMAV",
        error_details: None,
      }
    }
    4. When chapter conversion failed:
    {
      type: "chapter_conversion_status",
      event_timestamp: 1234567890,
      data: {
        request_id: "1234567890",
        project_id: "21m00Tcm4TlvDq8ikWAM",
        chapter_id: "22m00Tcm4TlvDq8ikMAT",
        conversion_status: "error",
        chapter_snapshot_id: None,
        error_details: "Error details if conversion failed"
      }
    }
    
</dd>
</dl>

<dl>
<dd>

**$fiction:** `?CreateProjectsRequestFiction` — An optional specification of whether the content of this Studio project is fiction.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?CreateProjectsRequestApplyTextNormalization` 

This parameter controls text normalization with four modes: 'auto', 'on', 'apply_english' and 'off'.
    When set to 'auto', the system will automatically decide whether to apply text normalization
    (e.g., spelling out numbers). With 'on', text normalization will always be applied, while
    with 'off', it will be skipped. 'apply_english' is the same as 'on' but will assume that text is in English.
    
</dd>
</dl>

<dl>
<dd>

**$autoConvert:** `?bool` — Whether to auto convert the Studio project to audio or not.
    
</dd>
</dl>

<dl>
<dd>

**$autoAssignVoices:** `?bool` — [Alpha Feature] Whether automatically assign voices to phrases in the create Project.
    
</dd>
</dl>

<dl>
<dd>

**$sourceType:** `?CreateProjectsRequestSourceType` — The type of Studio project to create.
    
</dd>
</dl>

<dl>
<dd>

**$voiceSettings:** `?array` 

Optional voice settings overrides for the project, encoded as a list of JSON strings.

    Example:
    ["{\"voice_id\": \"21m00Tcm4TlvDq8ikWAM\", \"stability\": 0.7, \"similarity_boost\": 0.8, \"style\": 0.5, \"speed\": 1.0, \"use_speaker_boost\": true}"]
    
</dd>
</dl>

<dl>
<dd>

**$createPublishingRead:** `?bool` — If true, creates a corresponding read for direct publishing in draft state
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;get($projectId, $request) -> ?ProjectExtendedResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns information about a specific Studio project. This endpoint returns more detailed information about a project than `GET /v1/studio`.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->get(
    '21m00Tcm4TlvDq8ikWAM',
    new GetProjectsRequest([
        'shareId' => 'share_id',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$shareId:** `?string` — The share ID of the project
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;update($projectId, $request) -> ?EditProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates the specified Studio project by setting the values of the parameters passed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateStudioProjectV1StudioProjectsProjectIdPost([
        'name' => 'Project 1',
        'defaultTitleVoiceId' => '21m00Tcm4TlvDq8ikWAM',
        'defaultParagraphVoiceId' => '21m00Tcm4TlvDq8ikWAM',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The name of the Studio project, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$defaultTitleVoiceId:** `string` — The voice_id that corresponds to the default voice used for new titles.
    
</dd>
</dl>

<dl>
<dd>

**$defaultParagraphVoiceId:** `string` — The voice_id that corresponds to the default voice used for new paragraphs.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$author:** `?string` — An optional name of the author of the Studio project, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$isbnNumber:** `?string` — An optional ISBN number of the Studio project you want to create, this will be added as metadata to the mp3 file on Studio project or chapter download.
    
</dd>
</dl>

<dl>
<dd>

**$volumeNormalization:** `?bool` — When the Studio project is downloaded, should the returned audio have postprocessing in order to make it compliant with audiobook normalized volume requirements
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;delete($projectId) -> ?DeleteProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a Studio project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->delete(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;convert($projectId) -> ?ConvertProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Starts conversion of a Studio project and all of its chapters.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->convert(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;getMutedTracks($projectId) -> ?ProjectMutedTracksResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of chapter IDs that have muted tracks in a project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->getMutedTracks(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## PronunciationDictionaries
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;pronunciationDictionaries-&gt;create($projectId, $request) -> ?CreatePronunciationDictionaryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a set of pronunciation dictionaries acting on a project. This will automatically mark text within this project as requiring reconverting where the new dictionary would apply or the old one no longer does.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->pronunciationDictionaries->create(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyCreatePronunciationDictionariesV1StudioProjectsProjectIdPronunciationDictionariesPost([
        'pronunciationDictionaryLocators' => [
            new PronunciationDictionaryVersionLocator([
                'pronunciationDictionaryId' => 'pronunciation_dictionary_id',
            ]),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `array` — A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
    
</dd>
</dl>

<dl>
<dd>

**$invalidateAffectedText:** `?bool` — This will automatically mark text in this project for reconversion when the new dictionary applies or the old one no longer does.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Content
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;content-&gt;update($projectId, $request) -> ?EditProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates Studio project content.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->content->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateStudioProjectContentV1StudioProjectsProjectIdContentPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$fromUrl:** `?string` — An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
    
</dd>
</dl>

<dl>
<dd>

**$fromDocument:** `mixed` — An optional .epub, .pdf, .txt or similar file can be provided. If provided, we will initialize the Studio project with its content. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
    
</dd>
</dl>

<dl>
<dd>

**$fromContentJson:** `?string` 

An optional content to initialize the Studio project with. If this is set, 'from_url' and 'from_document' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.

    Example:
    [{"name": "Chapter A", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "A", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "B", "type": "tts_node"}]}, {"sub_type": "h1", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "C", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "D", "type": "tts_node"}]}]}, {"name": "Chapter B", "blocks": [{"sub_type": "p", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "E", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "F", "type": "tts_node"}]}, {"sub_type": "h2", "nodes": [{"voice_id": "6lCwbsX1yVjD49QmpkT0", "text": "G", "type": "tts_node"}, {"voice_id": "6lCwbsX1yVjD49QmpkT1", "text": "H", "type": "tts_node"}]}]}]
    
</dd>
</dl>

<dl>
<dd>

**$autoConvert:** `?bool` — Whether to auto convert the Studio project to audio or not.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Snapshots
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;snapshots-&gt;list($projectId) -> ?ProjectSnapshotsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves a list of snapshots for a Studio project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->snapshots->list(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;snapshots-&gt;get($projectId, $projectSnapshotId) -> ?ProjectSnapshotExtendedResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the project snapshot.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->snapshots->get(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$projectSnapshotId:** `string` — The ID of the Studio project snapshot.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;snapshots-&gt;stream($projectId, $projectSnapshotId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream the audio from a Studio project snapshot.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->studio->projects->snapshots->stream(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
    new BodyStreamStudioProjectAudioV1StudioProjectsProjectIdSnapshotsProjectSnapshotIdStreamPost([]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$projectSnapshotId:** `string` — The ID of the Studio project snapshot.
    
</dd>
</dl>

<dl>
<dd>

**$convertToMpeg:** `?bool` — Whether to convert the audio to mpeg format.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;snapshots-&gt;streamArchive($projectId, $projectSnapshotId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a compressed archive of the Studio project's audio.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->studio->projects->snapshots->streamArchive(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$projectSnapshotId:** `string` — The ID of the Studio project snapshot.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Chapters
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;list($projectId) -> ?GetChaptersResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of a Studio project's chapters.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->list(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;create($projectId, $request) -> ?AddChapterResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new chapter either as blank or from a URL.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->create(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyCreateChapterV1StudioProjectsProjectIdChaptersPost([
        'name' => 'Chapter 1',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The name of the chapter, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$fromUrl:** `?string` — An optional URL from which we will extract content to initialize the Studio project. If this is set, 'from_url' and 'from_content' must be null. If neither 'from_url', 'from_document', 'from_content' are provided we will initialize the Studio project as blank.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;get($projectId, $chapterId) -> ?ChapterWithContentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns information about a specific chapter.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->get(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;update($projectId, $chapterId, $request) -> ?EditChapterResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates a chapter.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->update(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateChapterV1StudioProjectsProjectIdChaptersChapterIdPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of the chapter, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$content:** `?ChapterContentInputModel` — The chapter content to use.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;delete($projectId, $chapterId) -> ?DeleteChapterResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Deletes a chapter.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->delete(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;convert($projectId, $chapterId) -> ?ConvertChapterResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Starts conversion of a specific chapter.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->convert(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Snapshots
<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;snapshots-&gt;list($projectId, $chapterId) -> ?ChapterSnapshotsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets information about all the snapshots of a chapter. Each snapshot can be downloaded as audio. Whenever a chapter is converted a snapshot will automatically be created.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->snapshots->list(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;snapshots-&gt;get($projectId, $chapterId, $chapterSnapshotId) -> ?ChapterSnapshotExtendedResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the chapter snapshot.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->studio->projects->chapters->snapshots->get(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter.
    
</dd>
</dl>

<dl>
<dd>

**$chapterSnapshotId:** `string` — The ID of the chapter snapshot.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;studio-&gt;projects-&gt;chapters-&gt;snapshots-&gt;stream($projectId, $chapterId, $chapterSnapshotId, $request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream the audio from a chapter snapshot. Use `GET /v1/studio/projects/{project_id}/chapters/{chapter_id}/snapshots` to return the snapshots of a chapter.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->studio->projects->chapters->snapshots->stream(
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
    '21m00Tcm4TlvDq8ikWAM',
    new BodyStreamChapterAudioV1StudioProjectsProjectIdChaptersChapterIdSnapshotsChapterSnapshotIdStreamPost([]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$chapterId:** `string` — The ID of the chapter to be used. You can use the [List project chapters](/docs/api-reference/studio/get-chapters) endpoint to list all the available chapters.
    
</dd>
</dl>

<dl>
<dd>

**$chapterSnapshotId:** `string` — The ID of the chapter snapshot to be used. You can use the [List project chapter snapshots](/docs/api-reference/studio/get-snapshots) endpoint to list all the available snapshots.
    
</dd>
</dl>

<dl>
<dd>

**$convertToMpeg:** `?bool` — Whether to convert the audio to mpeg format.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## PronunciationDictionaries
<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;createFromFile($request) -> ?AddPronunciationDictionaryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new pronunciation dictionary from a lexicon .PLS file
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->createFromFile(
    new BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromFilePost([
        'name' => 'My Dictionary',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — The name of the pronunciation dictionary, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — A lexicon .pls file which we will use to initialize the project with.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A description of the pronunciation dictionary, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceAccess:** `?AddPronunciationDictionaryRequestWorkspaceAccess` — Should be one of 'admin', 'editor' or 'viewer'. If not provided, defaults to no access.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;createFromRules($request) -> ?AddPronunciationDictionaryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new pronunciation dictionary from provided rules.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->createFromRules(
    new BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPost([
        'rules' => [
            BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostRulesItem::alias(new PronunciationDictionaryAliasRuleRequestModel([
                'stringToReplace' => 'Thailand',
                'caseSensitive' => true,
                'wordBoundaries' => true,
                'type' => PronunciationDictionaryAliasRuleRequestModelType::Alias->value,
                'alias' => 'tie-land',
            ])),
        ],
        'name' => 'My Dictionary',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$rules:** `array` 

List of pronunciation rules. Rule can be either:
    an alias rule: {'string_to_replace': 'a', 'type': 'alias', 'alias': 'b', }
    or a phoneme rule: {'string_to_replace': 'a', 'type': 'phoneme', 'phoneme': 'b', 'alphabet': 'ipa' }
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The name of the pronunciation dictionary, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — A description of the pronunciation dictionary, used for identification only.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceAccess:** `?BodyAddAPronunciationDictionaryV1PronunciationDictionariesAddFromRulesPostWorkspaceAccess` — Should be one of 'admin', 'editor' or 'viewer'. If not provided, defaults to no access.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;get($pronunciationDictionaryId) -> ?GetPronunciationDictionaryWithRulesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get metadata for a pronunciation dictionary
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->get(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pronunciationDictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;update($pronunciationDictionaryId, $request) -> ?GetPronunciationDictionaryMetadataResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Partially update the pronunciation dictionary without changing the version
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdatePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pronunciationDictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>

<dl>
<dd>

**$archived:** `?bool` — Whether to archive the pronunciation dictionary.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of the pronunciation dictionary, used for identification only.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;download($dictionaryId, $versionId) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a PLS file with a pronunciation dictionary version rules
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->pronunciationDictionaries->download(
    '21m00Tcm4TlvDq8ikWAM',
    'BdF0s0aZ3oFoKnDYdTox',
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$dictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>

<dl>
<dd>

**$versionId:** `string` — The id of the pronunciation dictionary version
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;list($request) -> ?GetPronunciationDictionariesMetadataResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a list of the pronunciation dictionaries you have access to and their metadata
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->list(
    new ListPronunciationDictionariesRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'sort' => ListPronunciationDictionariesRequestSort::CreationTimeUnix->value,
        'sortDirection' => 'descending',
        'includeArchived' => false,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many pronunciation dictionaries to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?ListPronunciationDictionariesRequestSort` — Which field to sort by, one of 'created_at_unix' or 'name'.
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?string` — Which direction to sort the voices in. 'ascending' or 'descending'.
    
</dd>
</dl>

<dl>
<dd>

**$includeArchived:** `?bool` — Whether to include archived pronunciation dictionaries in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Rules
<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;rules-&gt;set($pronunciationDictionaryId, $request) -> ?PronunciationDictionaryRulesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Replaces all existing rules on the pronunciation dictionary with the provided ones.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->rules->set(
    '21m00Tcm4TlvDq8ikWAM',
    new BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPost([
        'rules' => [
            BodySetRulesOnThePronunciationDictionaryV1PronunciationDictionariesPronunciationDictionaryIdSetRulesPostRulesItem::alias(new PronunciationDictionaryAliasRuleRequestModel([
                'stringToReplace' => 'Thailand',
                'caseSensitive' => true,
                'wordBoundaries' => true,
                'type' => PronunciationDictionaryAliasRuleRequestModelType::Alias->value,
                'alias' => 'tie-land',
            ])),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pronunciationDictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>

<dl>
<dd>

**$rules:** `array` 

List of pronunciation rules. Rule can be either:
    an alias rule: {'string_to_replace': 'a', 'type': 'alias', 'alias': 'b', }
    or a phoneme rule: {'string_to_replace': 'a', 'type': 'phoneme', 'phoneme': 'b', 'alphabet': 'ipa' }
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;rules-&gt;add($pronunciationDictionaryId, $request) -> ?PronunciationDictionaryRulesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Add rules to the pronunciation dictionary. If a rule with the same string_to_replace already exists, it will be replaced.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->rules->add(
    '21m00Tcm4TlvDq8ikWAM',
    new PronunciationDictionary([
        'rules' => [
            PronunciationDictionaryRule::alias(new PronunciationDictionaryAliasRuleRequestModel([
                'stringToReplace' => 'Thailand',
                'caseSensitive' => true,
                'wordBoundaries' => true,
                'type' => PronunciationDictionaryAliasRuleRequestModelType::Alias->value,
                'alias' => 'tie-land',
            ])),
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pronunciationDictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>

<dl>
<dd>

**$rules:** `array` 

List of pronunciation rules. Rule can be either:
    an alias rule: {'string_to_replace': 'a', 'type': 'alias', 'alias': 'b', }
    or a phoneme rule: {'string_to_replace': 'a', 'type': 'phoneme', 'phoneme': 'b', 'alphabet': 'ipa' }
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;pronunciationDictionaries-&gt;rules-&gt;remove($pronunciationDictionaryId, $request) -> ?PronunciationDictionaryRulesResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Remove rules from the pronunciation dictionary
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->pronunciationDictionaries->rules->remove(
    '21m00Tcm4TlvDq8ikWAM',
    new RemovePronunciationDictionaryRulesRequest([
        'ruleStrings' => [
            'rule_strings',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pronunciationDictionaryId:** `string` — The id of the pronunciation dictionary
    
</dd>
</dl>

<dl>
<dd>

**$ruleStrings:** `array` — List of strings to remove from the pronunciation dictionary.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SpeechToText
<details><summary><code>$client-&gt;speechToText-&gt;convert($request) -> SpeechToTextChunkResponseModel|MultichannelSpeechToTextResponseModel|SpeechToTextWebhookResponseModel|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Transcribe an audio or video file. If webhook is set to true, the request will be processed asynchronously and results sent to configured webhooks. When use_multi_channel is true and the provided audio has multiple channels, a 'transcripts' object with separate transcripts for each channel is returned; set multichannel_output_style='combined' to instead receive a single transcript with all channels merged and sorted by time. Otherwise, returns a single transcript. The optional webhook_metadata parameter allows you to attach custom data that will be included in webhook responses for request correlation and tracking.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechToText->convert(
    new BodySpeechToTextV1SpeechToTextPost([
        'token' => 'token',
        'enableLogging' => true,
        'modelId' => 'scribe_v2',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$token:** `?string` — A single-use authentication token created via POST /v1/single-use-token/batch_scribe. This token can only be used once and expires after 15 minutes. Alternative to API key or bearer token authentication for frontend clients.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. This will mean log and transcript storage features are unavailable for this request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `string` — The ID of the model to use for transcription.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — The file to transcribe (100ms minimum audio length). All major audio and video formats are supported. Exactly one of the file or cloud_storage_url parameters must be provided. The file size must be less than 5.0GB.
    
</dd>
</dl>

<dl>
<dd>

**$languageCode:** `?string` — An ISO-639-1 or ISO-639-3 language_code corresponding to the language of the audio file. Can sometimes improve transcription performance if known beforehand. Defaults to null, in this case the language is predicted automatically.
    
</dd>
</dl>

<dl>
<dd>

**$secondaryLanguageCodes:** `?array` — Additional ISO-639-1 or ISO-639-3 language codes that may be present in the audio, alongside language_code. Improves transcription accuracy for multilingual audio. Supported by scribe_v3.
    
</dd>
</dl>

<dl>
<dd>

**$numbersFormat:** `?ConvertSpeechToTextRequestNumbersFormat` — How numbers are formatted in the transcript: 'digits' (e.g. '42') or 'words' (e.g. 'forty-two'). Supported by scribe_v3.
    
</dd>
</dl>

<dl>
<dd>

**$transcriptEdit:** `?string` — Natural-language instruction applied to the final transcript (max 2000 characters). The edited text is returned in 'edited_transcript' alongside the original transcript. Cannot be combined with entity_detection, entity_redaction or use_multi_channel. Usage of this parameter will incur an additional 30% surcharge on the base transcription cost, billed for at least 10 seconds of audio.
    
</dd>
</dl>

<dl>
<dd>

**$tagAudioEvents:** `?bool` — Whether to tag audio events like (laughter), (footsteps), etc. in the transcription.
    
</dd>
</dl>

<dl>
<dd>

**$numSpeakers:** `?int` — The maximum amount of speakers talking in the uploaded file. Can help with predicting who speaks when. The maximum amount of speakers that can be predicted is 32. Defaults to null, in this case the amount of speakers is set to the maximum value the model supports.
    
</dd>
</dl>

<dl>
<dd>

**$timestampsGranularity:** `?ConvertSpeechToTextRequestTimestampsGranularity` — The granularity of the timestamps in the transcription. 'word' provides word-level timestamps and 'character' provides character-level timestamps per word.
    
</dd>
</dl>

<dl>
<dd>

**$diarize:** `?bool` — Whether to annotate which speaker is currently talking in the uploaded file.
    
</dd>
</dl>

<dl>
<dd>

**$diarizationThreshold:** `?float` — Diarization threshold to apply during speaker diarization. A higher value means there will be a lower chance of one speaker being diarized as two different speakers but also a higher chance of two different speakers being diarized as one speaker (less total speakers predicted). A low value means there will be a higher chance of one speaker being diarized as two different speakers but also a lower chance of two different speakers being diarized as one speaker (more total speakers predicted). Can only be set when diarize=True and num_speakers=None. Defaults to None, in which case we will choose a threshold based on the model_id (0.22 usually).
    
</dd>
</dl>

<dl>
<dd>

**$additionalFormats:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$fileFormat:** `?ConvertSpeechToTextRequestFileFormat` — The format of input audio. Options are 'pcm_s16le_16' or 'other' For `pcm_s16le_16`, the input audio must be 16-bit PCM at a 16kHz sample rate, single channel (mono), and little-endian byte order. Latency will be lower than with passing an encoded waveform.
    
</dd>
</dl>

<dl>
<dd>

**$sourceUrl:** `?string` — The URL of an audio or video file to transcribe. Supports hosted video or audio files, YouTube video URLs, TikTok video URLs, and other video hosting services.
    
</dd>
</dl>

<dl>
<dd>

**$webhook:** `?bool` — Whether to send the transcription result to configured speech-to-text webhooks.  If set the request will return early without the transcription, which will be delivered later via webhook.
    
</dd>
</dl>

<dl>
<dd>

**$webhookId:** `?string` — Optional specific webhook ID to send the transcription result to. Only valid when webhook is set to true. If not provided, transcription will be sent to all configured speech-to-text webhooks.
    
</dd>
</dl>

<dl>
<dd>

**$temperature:** `?float` — Controls the randomness of the transcription output. Accepts values between 0.0 and 2.0, where higher values result in more diverse and less deterministic results. If omitted, we will use a temperature based on the model you selected which is usually 0.
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — If specified, our system will make a best effort to sample deterministically, such that repeated requests with the same seed and parameters should return the same result. Determinism is not guaranteed. Must be an integer between 0 and 2147483647.
    
</dd>
</dl>

<dl>
<dd>

**$useMultiChannel:** `?bool` — Whether the audio file contains multiple channels where each channel contains a single speaker. When enabled, each channel is transcribed independently. By default a separate transcript is returned per channel; set multichannel_output_style='combined' to instead receive a single transcript with all channels merged and sorted by time. Each word in the response includes a 'channel_index' field indicating which channel it was spoken on. A maximum of 5 channels is supported. Each channel is billed independently at the full audio duration, so cost scales linearly with the number of channels.
    
</dd>
</dl>

<dl>
<dd>

**$multichannelOutputStyle:** `?ConvertSpeechToTextRequestMultichannelOutputStyle` — Controls the response shape when use_multi_channel is enabled. 'separate' (default) returns one transcript per channel under 'transcripts'. 'combined' merges all channels into a single transcript whose words are sorted by start time, each carrying a 'channel_index' - matching the single-channel response shape. 'combined' requires timestamps (timestamps_granularity must not be 'none') and does not support entity detection or redaction.
    
</dd>
</dl>

<dl>
<dd>

**$webhookMetadata:** `?string|array` — Optional metadata to be included in the webhook response. This should be a JSON string representing an object with a maximum depth of 2 levels and maximum size of 16KB. Useful for tracking internal IDs, job references, or other contextual information.
    
</dd>
</dl>

<dl>
<dd>

**$entityDetection:** `?string|array` — Detect entities in the transcript. Can be 'all' to detect all entities, a single entity type or category string, or a list of entity types/categories. Categories include 'pii', 'phi', 'pci', 'other', 'offensive_language'. When enabled, detected entities will be returned in the 'entities' field with their text, type, and character positions.
    
</dd>
</dl>

<dl>
<dd>

**$noVerbatim:** `?bool` — If true, the transcription will not have any filler words, false starts and non-speech sounds. Supported by scribe_v2, scribe_v2_medical and scribe_v3.
    
</dd>
</dl>

<dl>
<dd>

**$useSpeakerLibrary:** `?bool` — Whether to use the speaker library for identifying known speakers during diarization. When enabled and diarize is true, detected speakers will be matched against registered speakers in the workspace's speaker library.
    
</dd>
</dl>

<dl>
<dd>

**$detectSpeakerRoles:** `?bool` — Whether to detect speaker roles (agent vs customer). Requires diarize=true. Cannot be used with use_multi_channel=true. When enabled, speaker_id values will be 'agent' and 'customer' instead of 'speaker_0', 'speaker_1', etc. Usage incurs an additional 10% surcharge on base transcription cost.
    
</dd>
</dl>

<dl>
<dd>

**$entityRedaction:** `?string|array` — Redact entities from the transcript text. Accepts the same format as entity_detection: 'all', a category ('pii', 'phi'), or specific entity types. Must be a subset of entity_detection. When redaction is enabled, the entities field will not be returned.
    
</dd>
</dl>

<dl>
<dd>

**$entityRedactionMode:** `?string` — How to format redacted entities. 'redacted' replaces with {REDACTED}, 'entity_type' replaces with {ENTITY_TYPE}, 'enumerated_entity_type' replaces with {ENTITY_TYPE_N} where N enumerates each occurrence. Only used when entity_redaction is set.
    
</dd>
</dl>

<dl>
<dd>

**$keyterms:** `?array` — A list of keyterms to bias the transcription towards.           The keyterms are words or phrases you want the model to recognise more accurately.           The number of keyterms cannot exceed 1000.           The length of each keyterm must be at most 50 characters.           Keyterms can contain at most 5 words (after normalisation).           For example ["hello", "world", "technical term"].           The following characters are not supported: `<`, `>`, `{`, `}`, `[`, `]`, `\`.           Usage of this parameter will incur an additional 20% surcharge on the base transcription cost.           When more than 100 keyterms are provided, a minimum billable duration of 20 seconds applies per request.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Transcripts
<details><summary><code>$client-&gt;speechToText-&gt;transcripts-&gt;get($transcriptionId) -> SpeechToTextChunkResponseModel|MultichannelSpeechToTextResponseModel|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a previously generated transcript by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechToText->transcripts->get(
    'transcription_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transcriptionId:** `string` — The unique ID of the transcript to retrieve
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechToText-&gt;transcripts-&gt;delete($transcriptionId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a previously generated transcript by its ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechToText->transcripts->delete(
    'transcription_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$transcriptionId:** `string` — The unique ID of the transcript to delete
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Models
<details><summary><code>$client-&gt;models-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a list of available models.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->models->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AudioNative
<details><summary><code>$client-&gt;audioNative-&gt;create($request) -> ?AudioNativeCreateProjectResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates Audio Native enabled project, optionally starts conversion and returns project ID and embeddable HTML snippet.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioNative->create(
    new BodyCreatesAudioNativeEnabledProjectV1AudioNativePost([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Project name.
    
</dd>
</dl>

<dl>
<dd>

**$image:** `?string` — (Deprecated) Image URL used in the player. If not provided, default image set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$author:** `?string` — Author used in the player and inserted at the start of the uploaded article. If not provided, the default author set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — Title used in the player and inserted at the top of the uploaded article. If not provided, the default title set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$small:** `?bool` — (Deprecated) Whether to use small player or not. If not provided, default value set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$textColor:** `?string` — Text color used in the player. If not provided, default text color set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$backgroundColor:** `?string` — Background color used in the player. If not provided, default background color set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$sessionization:** `?int` — (Deprecated) Specifies for how many minutes to persist the session across page reloads. If not provided, default sessionization set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$voiceId:** `?string` — Voice ID used to voice the content. If not provided, default voice ID set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?string` — TTS Model ID used in the player. If not provided, default model ID set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — Either txt or HTML input file containing the article content. HTML should be formatted as follows '&lt;html&gt;&lt;body&gt;&lt;div&gt;&lt;p&gt;Your content&lt;/p&gt;&lt;h3&gt;More of your content&lt;/h3&gt;&lt;p&gt;Some more of your content&lt;/p&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;'
    
</dd>
</dl>

<dl>
<dd>

**$autoConvert:** `?bool` — Whether to auto convert the project to audio or not.
    
</dd>
</dl>

<dl>
<dd>

**$applyTextNormalization:** `?CreateAudioNativeRequestApplyTextNormalization` 

This parameter controls text normalization with four modes: 'auto', 'on', 'apply_english' and 'off'.
    When set to 'auto', the system will automatically decide whether to apply text normalization
    (e.g., spelling out numbers). With 'on', text normalization will always be applied, while
    with 'off', it will be skipped. 'apply_english' is the same as 'on' but will assume that text is in English.
    
</dd>
</dl>

<dl>
<dd>

**$pronunciationDictionaryLocators:** `?array` — A list of pronunciation dictionary locators (pronunciation_dictionary_id, version_id) encoded as a list of JSON strings for pronunciation dictionaries to be applied to the text. A list of json encoded strings is required as adding projects may occur through formData as opposed to jsonBody. To specify multiple dictionaries use multiple --form lines in your curl, such as --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"Vmd4Zor6fplcA7WrINey\",\"version_id\":\"hRPaxjlTdR7wFMhV4w0b\"}"' --form 'pronunciation_dictionary_locators="{\"pronunciation_dictionary_id\":\"JzWtcGQMJ6bnlWwyMo7e\",\"version_id\":\"lbmwxiLu4q6txYxgdZqn\"}"'.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioNative-&gt;getSettings($projectId) -> ?GetAudioNativeProjectSettingsResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get player settings for the specific project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioNative->getSettings(
    '21m00Tcm4TlvDq8ikWAM',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the Studio project.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioNative-&gt;update($projectId, $request) -> ?AudioNativeEditContentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates content for the specific AudioNative Project.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioNative->update(
    '21m00Tcm4TlvDq8ikWAM',
    new BodyUpdateAudioNativeProjectContentV1AudioNativeProjectIdContentPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$projectId:** `string` — The ID of the project to be used. You can use the [List projects](/docs/api-reference/studio/get-projects) endpoint to list all the available projects.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — Either txt or HTML input file containing the article content. HTML should be formatted as follows '&lt;html&gt;&lt;body&gt;&lt;div&gt;&lt;p&gt;Your content&lt;/p&gt;&lt;h5&gt;More of your content&lt;/h5&gt;&lt;p&gt;Some more of your content&lt;/p&gt;&lt;/div&gt;&lt;/body&gt;&lt;/html&gt;'
    
</dd>
</dl>

<dl>
<dd>

**$autoConvert:** `?bool` — Whether to auto convert the project to audio or not.
    
</dd>
</dl>

<dl>
<dd>

**$autoPublish:** `?bool` — Whether to auto publish the new project snapshot after it's converted.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;audioNative-&gt;updateContentFromUrl($request) -> ?AudioNativeEditContentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Finds an AudioNative project matching the provided URL, extracts content from the URL, updates the project content, and queues it for conversion and auto-publishing.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->audioNative->updateContentFromUrl(
    new BodyUpdateAudioNativeContentFromUrlV1AudioNativeContentPost([
        'url' => 'https://elevenlabs.io/blog/the_first_ai_that_can_laugh/',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$url:** `string` — URL of the page to extract content from.
    
</dd>
</dl>

<dl>
<dd>

**$author:** `?string` — Author used in the player and inserted at the start of the uploaded article. If not provided, the default author set in the Player settings is used.
    
</dd>
</dl>

<dl>
<dd>

**$title:** `?string` — Title used in the player and inserted at the top of the uploaded article. If not provided, the default title set in the Player settings is used.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ApiKeys
<details><summary><code>$client-&gt;workspaces-&gt;apiKeys-&gt;disable($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Disable the API key used to authenticate this request. Requires the query parameter `api_key_name=self` as an explicit confirmation.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspaces->apiKeys->disable(
    new DisableApiKeysRequest([
        'apiKeyName' => 'self',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$apiKeyName:** `string` — Must be set to `self` to disable the API key used to authenticate this request. Required as an explicit confirmation to avoid accidentally disabling the wrong key.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ServiceAccounts
<details><summary><code>$client-&gt;serviceAccounts-&gt;list() -> ?WorkspaceServiceAccountListResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all service accounts in the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;serviceAccounts-&gt;create($request) -> ?WorkspaceCreateServiceAccountResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new service account in the workspace. By default, a workspace can have up to 20 service accounts. Enterprise customers may request an increase to this limit.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->create(
    new BodyCreateServiceAccountV1ServiceAccountsPost([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$defaultSharingGroups:** `?array` — List of groups with their permission levels to share with by default. Each entry should specify a group_id and a permission_level (admin, editor, or viewer).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ApiKeys
<details><summary><code>$client-&gt;serviceAccounts-&gt;apiKeys-&gt;list($serviceAccountUserId) -> ?WorkspaceApiKeyListResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all API keys for a service account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->apiKeys->list(
    'service_account_user_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serviceAccountUserId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;serviceAccounts-&gt;apiKeys-&gt;create($serviceAccountUserId, $request) -> ?WorkspaceCreateApiKeyResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new API key for a service account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->apiKeys->create(
    'service_account_user_id',
    new BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPost([
        'name' => 'name',
        'permissions' => Permissions21::All->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serviceAccountUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `BodyCreateServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysPostPermissions` — The permissions of the XI API.
    
</dd>
</dl>

<dl>
<dd>

**$characterLimit:** `?int` — The character limit of the XI API key. If provided this will limit the usage of this api key to n characters per month where n is the chosen value. Requests that incur charges will fail after reaching this monthly limit.
    
</dd>
</dl>

<dl>
<dd>

**$allowedIps:** `?array` — List of IP addresses or CIDR ranges allowed to use this API key. Each entry may be a CIDR range (e.g. '10.0.0.0/24') or a bare IP address (normalized to /32 or /128). On create, omit or pass null to allow all IPs. On update, omit to leave the allowlist unchanged, or pass "clear" to remove it.
    
</dd>
</dl>

<dl>
<dd>

**$thirdPartyDisableAllowed:** `?bool` — Whether the holder of this key may disable it via the self-disable endpoint. On create, omit or pass null to use the workspace's default (enabled for non-Enterprise plans, disabled for Enterprise plans). On update, omit to leave it unchanged, or pass "clear" to reset it to the workspace default. Only honored for workspaces with self-disable access enabled.
    
</dd>
</dl>

<dl>
<dd>

**$ttsConcurrencyLimit:** `?int` — Maximum concurrent text-to-speech/speech-to-speech requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$dubbingConcurrencyLimit:** `?int` — Maximum concurrent dubbing requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$musicConcurrencyLimit:** `?int` — Maximum concurrent music generation requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$expiresAtUnix:** `?int` — Unix timestamp (in seconds) after which this API key stops working. When set, it must be at least 15 minutes and at most 90 days in the future. On create, omit or pass null for a key that never expires. On update, omit to leave it unchanged, or pass "clear" to remove the expiry (never expires). A workspace may disallow never-expiring keys, or allow them only on service account API keys; creating one or clearing an expiry then fails.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;serviceAccounts-&gt;apiKeys-&gt;update($serviceAccountUserId, $apiKeyId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an existing API key for a service account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->apiKeys->update(
    'service_account_user_id',
    'api_key_id',
    new BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatch([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serviceAccountUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$apiKeyId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$isEnabled:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchIsEnabled` — Whether to enable or disable the API key.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — The name of the XI API key to use (used for identification purposes only).
    
</dd>
</dl>

<dl>
<dd>

**$permissions:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchPermissions` — The permissions of the XI API.
    
</dd>
</dl>

<dl>
<dd>

**$characterLimit:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchCharacterLimit` — The character limit of the XI API key. If provided this will limit the usage of this api key to n characters per month where n is the chosen value. Requests that incur charges will fail after reaching this monthly limit.
    
</dd>
</dl>

<dl>
<dd>

**$allowedIps:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchAllowedIps` — List of IP addresses or CIDR ranges allowed to use this API key. Each entry may be a CIDR range (e.g. '10.0.0.0/24') or a bare IP address (normalized to /32 or /128). On create, omit or pass null to allow all IPs. On update, omit to leave the allowlist unchanged, or pass "clear" to remove it.
    
</dd>
</dl>

<dl>
<dd>

**$thirdPartyDisableAllowed:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchThirdPartyDisableAllowed` — Whether the holder of this key may disable it via the self-disable endpoint. On create, omit or pass null to use the workspace's default (enabled for non-Enterprise plans, disabled for Enterprise plans). On update, omit to leave it unchanged, or pass "clear" to reset it to the workspace default. Only honored for workspaces with self-disable access enabled.
    
</dd>
</dl>

<dl>
<dd>

**$ttsConcurrencyLimit:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchTtsConcurrencyLimit` — Maximum concurrent text-to-speech/speech-to-speech requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$dubbingConcurrencyLimit:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchDubbingConcurrencyLimit` — Maximum concurrent dubbing requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$musicConcurrencyLimit:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchMusicConcurrencyLimit` — Maximum concurrent music generation requests for this API key. Only available for enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$expiresAtUnix:** `?BodyEditServiceAccountApiKeyV1ServiceAccountsServiceAccountUserIdApiKeysApiKeyIdPatchExpiresAtUnix` — Unix timestamp (in seconds) after which this API key stops working. When set, it must be at least 15 minutes and at most 90 days in the future. On create, omit or pass null for a key that never expires. On update, omit to leave it unchanged, or pass "clear" to remove the expiry (never expires). A workspace may disallow never-expiring keys, or allow them only on service account API keys; creating one or clearing an expiry then fails.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;serviceAccounts-&gt;apiKeys-&gt;delete($serviceAccountUserId, $apiKeyId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an existing API key for a service account
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->apiKeys->delete(
    'service_account_user_id',
    'api_key_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serviceAccountUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$apiKeyId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;serviceAccounts-&gt;apiKeys-&gt;disable($serviceAccountUserId, $apiKeyId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Disable an existing API key for a service account without changing its other settings. This stays available after a workspace downgrades off a plan that includes service accounts. Turning the key back on still requires that plan.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->serviceAccounts->apiKeys->disable(
    'service_account_user_id',
    'api_key_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$serviceAccountUserId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$apiKeyId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Workspace
<details><summary><code>$client-&gt;workspace-&gt;setThirdPartyDisablingPolicy($request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Set the workspace-wide Third-Party Disabling policy. When set, it forces, for every API key in the workspace, whether the holder of a key (potentially a third party who found it) may disable it via the self-disable endpoint or when it leaks publicly — overriding each key's own setting. Pass `true` to allow it for all keys, `false` to forbid it for all keys, or `null` to clear the override so per-key values and the plan default apply again. Workspace admins only.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->setThirdPartyDisablingPolicy(
    new BodySetWorkspaceThirdPartyDisablingPolicyV1WorkspacesApiKeysThirdPartyDisablingPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$thirdPartyDisableAllowed:** `?bool` — `true` forces every key in the workspace to be disable-able by its holder; `false` forbids it for every key; `null` clears the override (per-key values and the plan default apply).
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AuditLogs
<details><summary><code>$client-&gt;workspace-&gt;auditLogs-&gt;list($request) -> ?WorkspaceAuditLogsPageResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the audit log for the workspace. Requires enterprise tier and the audit_log_read permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->auditLogs->list(
    new ListAuditLogsRequest([
        'limit' => 1,
        'cursor' => 'cursor',
        'timeFromUnixMs' => 1,
        'timeToUnixMs' => 1,
        'actorUid' => 'actor_uid',
        'className' => AuditClassName::AccountChange->value,
        'activityName' => AuditActivityName::AccountSecurityChange->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$limit:** `?int` — Maximum number of entries per page
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Cursor for the next page (from previous response)
    
</dd>
</dl>

<dl>
<dd>

**$timeFromUnixMs:** `?int` — Only include entries at or after this time (ms since epoch)
    
</dd>
</dl>

<dl>
<dd>

**$timeToUnixMs:** `?int` — Only include entries at or before this time (ms since epoch)
    
</dd>
</dl>

<dl>
<dd>

**$actorUid:** `?string` — Filter by actor user ID
    
</dd>
</dl>

<dl>
<dd>

**$className:** `?AuditClassName` — Filter by OCSF event class name
    
</dd>
</dl>

<dl>
<dd>

**$activityName:** `?AuditActivityName` — Filter by audit activity name
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## AuthConnections
<details><summary><code>$client-&gt;workspace-&gt;authConnections-&gt;list() -> ?ListAuthConnectionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all auth connections for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->authConnections->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;authConnections-&gt;create($request) -> ?CreateAuthConnectionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new OAuth2 auth connection for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->authConnections->create(
    new CreateOAuth2ClientCredsRequest([
        'name' => 'name',
        'provider' => 'provider',
        'clientId' => 'client_id',
        'tokenUrl' => 'token_url',
        'clientSecret' => 'client_secret',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateAuthConnectionsRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;authConnections-&gt;update($authConnectionId, $request) -> ?UpdateAuthConnectionsResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update an auth connection
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->authConnections->update(
    'auth_connection_id',
    new UpdateOAuth2ClientCredsRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$authConnectionId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UpdateAuthConnectionsRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;authConnections-&gt;delete($authConnectionId) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an auth connection
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->authConnections->delete(
    'auth_connection_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$authConnectionId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Groups
<details><summary><code>$client-&gt;workspace-&gt;groups-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get all groups in the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->groups->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;groups-&gt;search($request) -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Searches for user groups in the workspace. Multiple or no groups may be returned.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->groups->search(
    new SearchGroupsRequest([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name of the target group.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Members
<details><summary><code>$client-&gt;workspace-&gt;groups-&gt;members-&gt;remove($groupId, $request) -> ?DeleteWorkspaceGroupMemberResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes a member from the specified group. Requires `group_members_manage` permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->groups->members->remove(
    'group_id',
    new BodyDeleteMemberFromUserGroupV1WorkspaceGroupsGroupIdMembersRemovePost([
        'email' => 'email',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$groupId:** `string` — The ID of the target group.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `string` — The email of the target workspace member.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;groups-&gt;members-&gt;add($groupId, $request) -> ?AddWorkspaceGroupMemberResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds a member of your workspace to the specified group. Requires `group_members_manage` permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->groups->members->add(
    'group_id',
    new AddMemberToGroupRequest([
        'email' => 'email',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$groupId:** `string` — The ID of the target group.
    
</dd>
</dl>

<dl>
<dd>

**$email:** `string` — The email of the target workspace member.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Members
<details><summary><code>$client-&gt;workspace-&gt;members-&gt;list() -> ?array</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets a list of all members of the workspace, including locked members. Service accounts are excluded. Requires the workspace_members_read permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->members->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;members-&gt;update($request) -> ?UpdateWorkspaceMemberResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates attributes of a workspace member. Apart from the email identifier, all parameters will remain unchanged unless specified. This endpoint may only be called by workspace administrators.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->members->update(
    new UpdateMemberRequest([
        'email' => 'email',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$email:** `string` — Email of the target user.
    
</dd>
</dl>

<dl>
<dd>

**$isLocked:** `?bool` — Whether to lock or unlock the user account.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceRole:** `?SeatType` — The workspace role of the user. This is deprecated, use `workspace_seat_type` instead.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceSeatType:** `?SeatType` — The workspace seat type
    
</dd>
</dl>

<dl>
<dd>

**$allowDowngradeToBasicSeat:** `?bool` — When unlocking a user whose original seat type has no seats available but a basic seat is available, downgrade the user to a basic seat instead of failing.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;members-&gt;updateUsageLimit($userId, $request) -> ?UpdateMemberUsageLimitResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sets or clears the monthly credit usage limit of a workspace member or service account. This endpoint may only be called by workspace administrators.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->members->updateUsageLimit(
    'user_id',
    new UpdateMemberUsageLimitRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$userId:** `string` — User ID of the target user.
    
</dd>
</dl>

<dl>
<dd>

**$usageLimit:** `int` — Monthly credit usage limit for the member. Set to null to remove the limit.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Invites
<details><summary><code>$client-&gt;workspace-&gt;invites-&gt;create($request) -> ?AddWorkspaceInviteResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends an email invitation to join your workspace to the provided email. If the user doesn't have an account they will be prompted to create one. If the user accepts this invite they will be added as a user to your workspace and your subscription using one of your seats. This endpoint may only be called by workspace members with the WORKSPACE_MEMBERS_INVITE permission. If the user is already in the workspace a 400 error will be returned.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->invites->create(
    new InviteUserRequest([
        'email' => 'john.doe@testmail.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$email:** `string` — The email of the customer
    
</dd>
</dl>

<dl>
<dd>

**$workspacePermission:** `?string` — The workspace permission of the user. This is deprecated, use `seat_type` instead.
    
</dd>
</dl>

<dl>
<dd>

**$seatType:** `?SeatType` — The seat type of the user
    
</dd>
</dl>

<dl>
<dd>

**$groupIds:** `?array` — The group ids of the user
    
</dd>
</dl>

<dl>
<dd>

**$usageLimit:** `?int` — Monthly credit usage limit for the invitee. Omit or set to null for no custom cap.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;invites-&gt;createBatch($request) -> ?AddWorkspaceInviteResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Sends email invitations to join your workspace to the provided emails. Requires all email addresses to be part of a verified domain. If the users don't have an account they will be prompted to create one. If the users accept these invites they will be added as users to your workspace and your subscription using one of your seats. This endpoint may only be called by workspace members with the WORKSPACE_MEMBERS_INVITE permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->invites->createBatch(
    new BodyInviteMultipleUsersV1WorkspaceInvitesAddBulkPost([
        'emails' => [
            'emails',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$emails:** `array` — The email of the customer
    
</dd>
</dl>

<dl>
<dd>

**$seatType:** `?SeatType` — The seat type of the user
    
</dd>
</dl>

<dl>
<dd>

**$groupIds:** `?array` — The group ids of the user
    
</dd>
</dl>

<dl>
<dd>

**$usageLimit:** `?int` — Monthly credit usage limit for the invitee. Omit or set to null for no custom cap.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;invites-&gt;delete($request) -> ?DeleteWorkspaceInviteResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Invalidates an existing email invitation. The invitation will still show up in the inbox it has been delivered to, but activating it to join the workspace won't work. This endpoint may only be called by workspace members with the WORKSPACE_MEMBERS_INVITE permission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->invites->delete(
    new BodyDeleteExistingInvitationV1WorkspaceInvitesDelete([
        'email' => 'john.doe@testmail.com',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$email:** `string` — The email of the customer
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Resources
<details><summary><code>$client-&gt;workspace-&gt;resources-&gt;get($resourceId, $request) -> ?ResourceMetadataResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Gets the metadata of a resource by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->resources->get(
    'resource_id',
    new GetResourcesRequest([
        'resourceType' => WorkspaceResourceType::Voice->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resourceId:** `string` — The ID of the target resource.
    
</dd>
</dl>

<dl>
<dd>

**$resourceType:** `WorkspaceResourceType` — Resource type of the target resource.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;resources-&gt;share($resourceId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Grants a role (one of 'admin', 'editor', 'commenter', or 'viewer') on a workspace resource to a user, group, or workspace (service account) API key. This overrides any existing role the target has on the resource. To target a user or service account, pass only the user email; the user must be in your workspace. To target a group, pass only the group id. To target a workspace (service account) API key, pass the api key id; the resource will be shared with the service account associated with that key. You must have admin access to the resource to share it.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->resources->share(
    'resource_id',
    new BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePost([
        'role' => BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole::Admin->value,
        'resourceType' => WorkspaceResourceType::Voice->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resourceId:** `string` — The ID of the target resource.
    
</dd>
</dl>

<dl>
<dd>

**$role:** `BodyShareWorkspaceResourceV1WorkspaceResourcesResourceIdSharePostRole` — Role to grant to the target: one of 'admin', 'editor', 'commenter', or 'viewer'.
    
</dd>
</dl>

<dl>
<dd>

**$resourceType:** `WorkspaceResourceType` — Resource types that can be shared in the workspace. The name always need to match the collection names
    
</dd>
</dl>

<dl>
<dd>

**$userEmail:** `?string` — The email of the user or service account.
    
</dd>
</dl>

<dl>
<dd>

**$groupId:** `?string` — The ID of the target group. Use 'default' to set the resource's baseline role — every workspace member receives this role unless they hold a higher one through a direct user grant, group membership, or workspace (service account) API key.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceApiKeyId:** `?string` — The ID of the target workspace (service account) API key. This is not the API key string itself that you pass in the header for authentication — it is the key's ID, which workspace admins can find under Developers → Service Accounts.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;resources-&gt;unshare($resourceId, $request) -> mixed</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes any existing role on a workspace resource from a user, group, or workspace (service account) API key. To target a user or service account, pass only the user email; the user must be in your workspace. To target a group, pass only the group id. To target a workspace (service account) API key, pass the api key id; the resource will be unshared from the service account associated with that key. You must have admin access to the resource to unshare it. You cannot remove permissions from the user who created the resource.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->resources->unshare(
    'resource_id',
    new BodyUnshareWorkspaceResourceV1WorkspaceResourcesResourceIdUnsharePost([
        'resourceType' => WorkspaceResourceType::Voice->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$resourceId:** `string` — The ID of the target resource.
    
</dd>
</dl>

<dl>
<dd>

**$resourceType:** `WorkspaceResourceType` — Resource types that can be shared in the workspace. The name always need to match the collection names
    
</dd>
</dl>

<dl>
<dd>

**$userEmail:** `?string` — The email of the user or service account.
    
</dd>
</dl>

<dl>
<dd>

**$groupId:** `?string` — The ID of the target group. Use 'default' to set the resource's baseline role — every workspace member receives this role unless they hold a higher one through a direct user grant, group membership, or workspace (service account) API key.
    
</dd>
</dl>

<dl>
<dd>

**$workspaceApiKeyId:** `?string` — The ID of the target workspace (service account) API key. This is not the API key string itself that you pass in the header for authentication — it is the key's ID, which workspace admins can find under Developers → Service Accounts.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Usage
<details><summary><code>$client-&gt;workspace-&gt;usage-&gt;getUsageByProductOverTime($request) -> ?WorkspaceAnalyticsQueryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns credit usage broken down by product type over time, for workspaces billed in credits. The response is a tabular structure with columns, column_types, column_units, and rows. Some id columns also get a display-name column, such as user_label or voice_name, appended after the existing columns. For workspaces billed by cost, ranges that reach the date the workspace moved to cost billing return an error; use /v1/workspace/analytics/usage instead.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->usage->getUsageByProductOverTime(
    new BodyGetWorkspaceUsageV1WorkspaceAnalyticsQueryUsageByProductOverTimePost([
        'startTime' => 1,
        'endTime' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$startTime:** `int` — Start of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `int` — End of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
    
</dd>
</dl>

<dl>
<dd>

**$intervalSeconds:** `?int` — Bucket size in seconds. Each row in the response covers this many seconds of the selected time range. For example, pass 3600 for hourly buckets, 86400 for daily buckets, or 604800 for weekly buckets. Whether `time_zone` shifts bucket boundaries depends on this value: week multiples (e.g. 604800) are calendar weeks that start Monday at local midnight; whole-day multiples that are not whole weeks (e.g. 86400) align to local midnight; whole-hour multiples up to 24 hours (e.g. 3600, 14400) align to local hour boundaries from midnight; sub-hour values and other sizes remain UTC-anchored regardless of `time_zone`.
    
</dd>
</dl>

<dl>
<dd>

**$groupBy:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$filters:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$timeZone:** `?string` — IANA time zone identifier (e.g. 'America/New_York', 'Europe/London', 'UTC') used to align bucket boundaries for eligible `interval_seconds` values. Week multiples (e.g. 604800) are calendar weeks that start Monday at local midnight. Whole-day multiples that are not whole weeks start at local midnight; whole-hour multiples up to 24 hours align to local hour boundaries from midnight. Sub-hour intervals and other bucket sizes remain UTC-anchored regardless of this setting. Defaults to UTC.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;workspace-&gt;usage-&gt;getUsage($request) -> ?WorkspaceAnalyticsQueryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the cost of the workspace's usage over time, for workspaces billed by cost. Usage is bucketed by UTC day. The response is a tabular structure with columns, column_types, column_units, and rows, with one row per group and bucket. `total_cost` is the cost in the workspace's currency and `total_charge_count` the billed quantity. Usage can be grouped or filtered by at most two of `user_id`, `hashed_xi_api_key`, `region`, `reporting_workspace_id`, `billing_group_id`, `product_type`, `surface` and `actor`, and grouping by two of them requires an `eq` or `in` filter on one. `model`, `request_source`, `fiat_charge_type` and `fiat_currency` can always be added. Some id columns also get a display-name column, such as user_label, appended after the existing columns. Workspaces billed in credits should use /v1/workspace/analytics/query/usage-by-product-over-time.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->usage->getUsage(
    new BodyGetWorkspaceCostUsageV1WorkspaceAnalyticsUsagePost([
        'startTime' => 1,
        'endTime' => 1,
        'intervalSeconds' => 1,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$startTime:** `int` — Start of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `int` — End of the time range as a Unix timestamp in milliseconds. Must be at least 2020-01-01.
    
</dd>
</dl>

<dl>
<dd>

**$intervalSeconds:** `int` — Bucket size in seconds, in whole UTC days. Pass 86400 for daily buckets or 604800 for weekly buckets, which start on Monday.
    
</dd>
</dl>

<dl>
<dd>

**$groupBy:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$filters:** `?array` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Requests
<details><summary><code>$client-&gt;workspace-&gt;analytics-&gt;requests-&gt;get($request) -> ?WorkspaceAnalyticsQueryResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a list of API requests. Supports filtering by time range, column filters, and search terms. At least one of start_time or end_time must be provided. An optional sort parameter controls timestamp ordering. Results are ordered by timestamp. Descending if end_time is used, ascending if start_time is used. The response is a tabular structure with columns, column_types, column_units, and rows.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->workspace->analytics->requests->get(
    new BodyListApiRequestsV1WorkspaceAnalyticsRequestsPost([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$startTime:** `?int` — Start of the time range as a Unix timestamp in milliseconds.
    
</dd>
</dl>

<dl>
<dd>

**$endTime:** `?int` — End of the time range as a Unix timestamp in milliseconds.
    
</dd>
</dl>

<dl>
<dd>

**$limit:** `?int` 
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?BodyListApiRequestsV1WorkspaceAnalyticsRequestsPostSort` — Optional timestamp sort direction. If omitted, defaults to desc when end_time is provided, otherwise asc.
    
</dd>
</dl>

<dl>
<dd>

**$filters:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Webhooks
<details><summary><code>$client-&gt;webhooks-&gt;list($request) -> ?WorkspaceWebhookListResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all webhooks for a workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->webhooks->list(
    new ListWebhooksRequest([
        'includeUsages' => false,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$includeUsages:** `?bool` — Whether to include active usages of the webhook, only usable by admins
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;webhooks-&gt;create($request) -> ?WorkspaceCreateWebhookResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new webhook for the workspace with the specified authentication type.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->webhooks->create(
    new BodyCreateWorkspaceWebhookV1WorkspaceWebhooksPost([
        'settings' => new WebhookHmacSettings([
            'authType' => WebhookHmacSettingsAuthType::Hmac->value,
            'name' => 'name',
            'webhookUrl' => 'webhook_url',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$settings:** `WebhookHmacSettings` — Settings for creating an HMAC-authenticated webhook
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;webhooks-&gt;update($webhookId, $request) -> ?PatchWorkspaceWebhookResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update the specified workspace webhook
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->webhooks->update(
    'G007vmtq9uWYl7SUW9zGS8GZZa1K',
    new BodyUpdateWorkspaceWebhookV1WorkspaceWebhooksWebhookIdPatch([
        'isDisabled' => true,
        'name' => 'My Callback Webhook',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$webhookId:** `string` — The unique ID for the webhook
    
</dd>
</dl>

<dl>
<dd>

**$isDisabled:** `bool` — Whether to disable or enable the webhook
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — The display name of the webhook (used for display purposes only).
    
</dd>
</dl>

<dl>
<dd>

**$retryEnabled:** `?bool` — Whether to enable automatic retries for transient failures (5xx, 429, timeout)
    
</dd>
</dl>

<dl>
<dd>

**$requestHeaders:** `?array` — A list of request headers to include with the webhook delivery (optional)
    
</dd>
</dl>

<dl>
<dd>

**$events:** `?array` — The complete set of workspace-level events this webhook should be subscribed to. The webhook is added to the events in the list and removed from any not in the list. Omit to leave the current event subscriptions unchanged.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;webhooks-&gt;delete($webhookId) -> ?DeleteWorkspaceWebhookResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete the specified workspace webhook
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->webhooks->delete(
    'G007vmtq9uWYl7SUW9zGS8GZZa1K',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$webhookId:** `string` — The unique ID for the webhook
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Music
<details><summary><code>$client-&gt;music-&gt;videoToMusic($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generate background music from one or more video files. Videos are combined in order. Optional description and style tags influence the generated music.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->music->videoToMusic(
    new BodyVideoToMusicV1MusicVideoToMusicPost([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'enableLogging' => true,
        'videos' => [
            File::createFromString("example_videos", "example_videos"),
        ],
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$videos:** `array` 

One or more video files sent via FormData array (multipart/form-data). They will be combined into one codec in order.
            A maximum of 10 videos is allowed, where the total size of the combined video is limited to 200MB.
            In total, the video can be up to 600 seconds long. Note that combining multiple videos may increase the request duration significantly. If possible, combine the videos beforehand.
    
</dd>
</dl>

<dl>
<dd>

**$description:** `?string` — Optional text description of the music you want. A maximum of 4100 characters is allowed.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Optional list of style tags (e.g. ['upbeat', 'cinematic']). A maximum of 10 tags is allowed.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>

<dl>
<dd>

**$addSfx:** `?bool` — When true, incorporate SFX cues from the video.
    
</dd>
</dl>

<dl>
<dd>

**$separateTracks:** `?bool` — When true, return a ZIP with separate music and SFX audio tracks instead of a single mixed file. Use this for more flexibility to layer the tracks.
    
</dd>
</dl>

<dl>
<dd>

**$useAudioAsReference:** `?bool` — When true, analyze the video's audio track and use its genres, BPM, instrumentation, mood, and arc as reference characteristics for music generation.
    
</dd>
</dl>

<dl>
<dd>

**$signWithC2Pa:** `?bool` — Whether to sign the generated song with C2PA. Applicable only for mp3 files.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;compose($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Compose a song from a prompt or a composition plan.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->music->compose(
    new BodyComposeMusicV1MusicPost([
        'outputFormat' => ComposeMusicRequestOutputFormat::Auto->value,
        'enableLogging' => true,
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ComposeMusicRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. Use "auto" (the default) to let the API pick the best format for the selected model: mp3_44100_128 for v1 models and mp3_48000_192 for v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `?string` — A simple text prompt to generate a song from. Cannot be used in conjunction with `composition_plan`.
    
</dd>
</dl>

<dl>
<dd>

**$compositionPlan:** `?BodyComposeMusicV1MusicPostCompositionPlan` — A detailed composition plan to guide music generation. Cannot be used in conjunction with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$musicLengthMs:** `?int` — The length of the song to generate in milliseconds. Used only in conjunction with `prompt`. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random seed to initialize the music generation process. Providing the same seed with the same parameters can help achieve more consistent results, but exact reproducibility is not guaranteed and outputs may change across system updates. Cannot be used in conjunction with prompt.
    
</dd>
</dl>

<dl>
<dd>

**$forceInstrumental:** `?bool` — If true, guarantees that the generated song will be instrumental. If false, the song may or may not be instrumental depending on the `prompt`. Can only be used with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$finetuneId:** `?string` — The ID of the finetune to use for the generation
    
</dd>
</dl>

<dl>
<dd>

**$respectSectionsDurations:** `?bool` — Controls how strictly section durations in the `composition_plan` are enforced. Only used with `composition_plan` and only applies to `music_v1`; for `music_v2` and `music_v2_5` section durations are always enforced and this is ignored. When false for `music_v1`, the model may adjust individual section durations for better quality and latency, while preserving the total song duration from the plan.
    
</dd>
</dl>

<dl>
<dd>

**$storeForInpainting:** `?bool` — Whether to store the generated song for inpainting.
    
</dd>
</dl>

<dl>
<dd>

**$signWithC2Pa:** `?bool` — Whether to sign the generated song with C2PA. Applicable only for mp3 files.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;composeDetailed($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Compose a song from a prompt or a composition plan.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->music->composeDetailed(
    new BodyComposeMusicWithADetailedResponseV1MusicDetailedPost([
        'outputFormat' => ComposeDetailedMusicRequestOutputFormat::Auto->value,
        'enableLogging' => true,
        'prompt' => 'A prompt for music generation',
        'musicLengthMs' => 10000,
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ComposeDetailedMusicRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. Use "auto" (the default) to let the API pick the best format for the selected model: mp3_44100_128 for v1 models and mp3_48000_192 for v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `?string` — A simple text prompt to generate a song from. Cannot be used in conjunction with `composition_plan`.
    
</dd>
</dl>

<dl>
<dd>

**$compositionPlan:** `?BodyComposeMusicWithADetailedResponseV1MusicDetailedPostCompositionPlan` — A detailed composition plan to guide music generation. Cannot be used in conjunction with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$musicLengthMs:** `?int` — The length of the song to generate in milliseconds. Used only in conjunction with `prompt`. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random seed to initialize the music generation process. Providing the same seed with the same parameters can help achieve more consistent results, but exact reproducibility is not guaranteed and outputs may change across system updates. Cannot be used in conjunction with prompt.
    
</dd>
</dl>

<dl>
<dd>

**$forceInstrumental:** `?bool` — If true, guarantees that the generated song will be instrumental. If false, the song may or may not be instrumental depending on the `prompt`. Can only be used with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$finetuneId:** `?string` — The ID of the finetune to use for the generation
    
</dd>
</dl>

<dl>
<dd>

**$respectSectionsDurations:** `?bool` — Controls how strictly section durations in the `composition_plan` are enforced. Only used with `composition_plan` and only applies to `music_v1`; for `music_v2` and `music_v2_5` section durations are always enforced and this is ignored. When false for `music_v1`, the model may adjust individual section durations for better quality and latency, while preserving the total song duration from the plan.
    
</dd>
</dl>

<dl>
<dd>

**$storeForInpainting:** `?bool` — Whether to store the generated song for inpainting.
    
</dd>
</dl>

<dl>
<dd>

**$withTimestamps:** `?bool` — Whether to return the timestamps of the words in the generated song.
    
</dd>
</dl>

<dl>
<dd>

**$withWaveformVisual:** `?bool` — Whether to return the visual waveform of the generated song.
    
</dd>
</dl>

<dl>
<dd>

**$signWithC2Pa:** `?bool` — Whether to sign the generated song with C2PA. Applicable only for mp3 files.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;composeDetailedStream($request) -> string</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream a song and its detailed metadata using Server-Sent Events (SSE).
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->composeDetailedStream(
    new BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPost([
        'outputFormat' => ComposeDetailedStreamMusicRequestOutputFormat::Auto->value,
        'enableLogging' => true,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?ComposeDetailedStreamMusicRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. Use "auto" (the default) to let the API pick the best format for the selected model: mp3_44100_128 for v1 models and mp3_48000_192 for v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `?string` — A simple text prompt to generate a song from. Cannot be used in conjunction with `composition_plan`.
    
</dd>
</dl>

<dl>
<dd>

**$compositionPlan:** `?BodyStreamComposedMusicWithADetailedResponseV1MusicDetailedStreamPostCompositionPlan` — A detailed composition plan to guide music generation. Cannot be used in conjunction with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$musicLengthMs:** `?int` — The length of the song to generate in milliseconds. Used only in conjunction with `prompt`. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random seed to initialize the music generation process. Providing the same seed with the same parameters can help achieve more consistent results, but exact reproducibility is not guaranteed and outputs may change across system updates. Cannot be used in conjunction with prompt.
    
</dd>
</dl>

<dl>
<dd>

**$forceInstrumental:** `?bool` — If true, guarantees that the generated song will be instrumental. If false, the song may or may not be instrumental depending on the `prompt`. Can only be used with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$finetuneId:** `?string` — The ID of the finetune to use for the generation
    
</dd>
</dl>

<dl>
<dd>

**$storeForInpainting:** `?bool` — Whether to store the generated song for inpainting.
    
</dd>
</dl>

<dl>
<dd>

**$withTimestamps:** `?bool` — Whether to return the timestamps of the words in the generated song.
    
</dd>
</dl>

<dl>
<dd>

**$withWaveformVisual:** `?bool` — Whether to return the visual waveform of the generated song.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;stream($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Stream a composed song from a prompt or a composition plan.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->music->stream(
    new BodyStreamComposedMusicV1MusicStreamPost([
        'outputFormat' => StreamMusicRequestOutputFormat::Auto->value,
        'enableLogging' => true,
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?StreamMusicRequestOutputFormat` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. Use "auto" (the default) to let the API pick the best format for the selected model: mp3_44100_128 for v1 models and mp3_48000_192 for v2 models.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `?string` — A simple text prompt to generate a song from. Cannot be used in conjunction with `composition_plan`.
    
</dd>
</dl>

<dl>
<dd>

**$compositionPlan:** `?BodyStreamComposedMusicV1MusicStreamPostCompositionPlan` — A detailed composition plan to guide music generation. Cannot be used in conjunction with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$musicLengthMs:** `?int` — The length of the song to generate in milliseconds. Used only in conjunction with `prompt`. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>

<dl>
<dd>

**$seed:** `?int` — Random seed to initialize the music generation process. Providing the same seed with the same parameters can help achieve more consistent results, but exact reproducibility is not guaranteed and outputs may change across system updates. Cannot be used in conjunction with prompt.
    
</dd>
</dl>

<dl>
<dd>

**$forceInstrumental:** `?bool` — If true, guarantees that the generated song will be instrumental. If false, the song may or may not be instrumental depending on the `prompt`. Can only be used with `prompt`.
    
</dd>
</dl>

<dl>
<dd>

**$finetuneId:** `?string` — The ID of the finetune to use for the generation
    
</dd>
</dl>

<dl>
<dd>

**$storeForInpainting:** `?bool` — Whether to store the generated song for inpainting.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;upload($request) -> ?MusicUploadResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Upload a music file to be later used for inpainting. Price for uploading is the same as the one for song generation. All uploaded content gets inspected for copyright infringement. If copyrighted content is detected, half of the request cost is still charged.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->upload(
    new BodyUploadMusicV1MusicUploadPost([
        'file' => File::createFromString("example_file", "example_file"),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$file:** `mixed` — The audio file to upload.
    
</dd>
</dl>

<dl>
<dd>

**$extractCompositionPlan:** `?UploadMusicRequestExtractCompositionPlan` — Whether to generate and return the composition plan for the uploaded song. Pass a model id (`music_v1`, `music_v2` or `music_v2_5`) to control which composition plan format is returned. Passing `true`/`false` is deprecated; `true` defaults to the `music_v1` plan format. Enabling this will increase the latency.
    
</dd>
</dl>

<dl>
<dd>

**$withTimestamps:** `?bool` — Whether to transcribe the uploaded song and return word-level timestamps. If True, the response will include words_timestamps but will increase the latency.
    
</dd>
</dl>

<dl>
<dd>

**$withWaveformVisual:** `?bool` — Whether to return the visual waveform of the uploaded song.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;separateStems($request) -> StreamInterface</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Separate an audio file into individual stems. This endpoint might have high latency, depending on the length of the audio file.
</dd>
</dl>
</dd>
</dl>

#### 📤 Returns

<dl>
<dd>

<dl>
<dd>

A `Psr\Http\Message\StreamInterface` over the response body, read as it arrives: call `read()` until `eof()`. `getContents()` or `(string) $stream` returns the whole body in one call. Call `close()` if you stop reading early.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$response = $client->music->separateStems(
    new BodyStemSeparationV1MusicStemSeparationPost([
        'outputFormat' => AllowedOutputFormats::Mp32205032->value,
        'enableLogging' => true,
        'file' => File::createFromString("example_file", "example_file"),
    ]),
);
while (!$response->eof()) {
    echo $response->read(8192);
}
// $response->getContents() returns the whole body in one call.
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$outputFormat:** `?AllowedOutputFormats` — Output format of the generated audio. Formatted as codec_sample_rate_bitrate. So an mp3 with 22.05kHz sample rate at 32kbs is represented as mp3_22050_32. MP3 with 192kbps bitrate requires you to be subscribed to Creator tier or above. PCM with 44.1kHz sample rate requires you to be subscribed to Pro tier or above. Note that the μ-law format (sometimes written mu-law, often approximated as u-law) is commonly used for Twilio audio inputs.
    
</dd>
</dl>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$file:** `mixed` — The audio file to separate into stems.
    
</dd>
</dl>

<dl>
<dd>

**$stemVariationId:** `?SeparateStemsMusicRequestStemVariationId` — The id of the stem variation to use.
    
</dd>
</dl>

<dl>
<dd>

**$signWithC2Pa:** `?bool` — Whether to sign the generated song with C2PA. Applicable only for mp3 files.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## CompositionPlan
<details><summary><code>$client-&gt;music-&gt;compositionPlan-&gt;create($request) -> MusicPrompt|CompositionPlan|null</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a composition plan for music generation. Usage of this endpoint does not cost any credits but is subject to rate limiting depending on your tier.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->compositionPlan->create(
    new BodyGenerateCompositionPlanV1MusicPlanPost([
        'enableLogging' => true,
        'prompt' => 'prompt',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$enableLogging:** `?bool` — When enable_logging is set to false zero retention mode will be used for the request. Zero retention mode may only be used by enterprise customers.
    
</dd>
</dl>

<dl>
<dd>

**$prompt:** `string` — A simple text prompt to compose a plan from.
    
</dd>
</dl>

<dl>
<dd>

**$musicLengthMs:** `?int` — The length of the composition plan to generate in milliseconds. Must be between 3000ms and 600000ms. Optional - if not provided, the model will choose a length based on the prompt.
    
</dd>
</dl>

<dl>
<dd>

**$sourceCompositionPlan:** `?BodyGenerateCompositionPlanV1MusicPlanPostSourceCompositionPlan` — An optional composition plan to use as a source for the new composition plan.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Finetunes
<details><summary><code>$client-&gt;music-&gt;finetunes-&gt;list($request) -> ?MusicFinetunePageResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List music finetunes accessible to you (your own, workspace-shared, and ElevenLabs-curated), with optional filtering, sorting, and cursor pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->finetunes->list(
    new ListFinetunesRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'visibility' => FinetuneVisibility::Private_->value,
        'createdBy' => FinetuneCreatedBy::Self->value,
        'sort' => ListFinetunesRequestSort::CreatedAt->value,
        'sortDirection' => ListFinetunesRequestSortDirection::Asc->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching the next page. Cursor is returned in the response.
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — How many finetunes to return. Max 150, default 50.
    
</dd>
</dl>

<dl>
<dd>

**$visibility:** `?FinetuneVisibility` — Filter by visibility. 'private' returns private finetunes; 'workspace' returns workspace-shared finetunes; 'public' returns public finetunes, which are currently ElevenLabs curated finetunes. Omit to return all accessible finetunes.
    
</dd>
</dl>

<dl>
<dd>

**$createdBy:** `?FinetuneCreatedBy` — Filter by creator. 'self' returns finetunes you created; 'workspace' returns finetunes created by workspace teammates; 'elevenlabs' returns ElevenLabs curated finetunes. Omit to return finetunes from all creators.
    
</dd>
</dl>

<dl>
<dd>

**$sort:** `?ListFinetunesRequestSort` — Sort by field (created_at or name)
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?ListFinetunesRequestSortDirection` — Sort direction (asc or desc)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;finetunes-&gt;create($request) -> ?MusicFinetuneResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new music finetune
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->finetunes->create(
    new BodyCreateMusicFinetuneV1MusicFinetunesPost([
        'name' => 'name',
        'primaryGenre' => 'primary_genre',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Name for the finetune (5-200 characters).
    
</dd>
</dl>

<dl>
<dd>

**$primaryGenre:** `string` — Primary musical genre of the finetune.
    
</dd>
</dl>

<dl>
<dd>

**$files:** `?array` — Audio files to train on.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Tags to associate with the finetune.
    
</dd>
</dl>

<dl>
<dd>

**$visibility:** `?CreateFinetunesRequestVisibility` — Finetune visibility. Only 'private' and 'workspace' can be set.
    
</dd>
</dl>

<dl>
<dd>

**$modelId:** `?MusicModelId` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;finetunes-&gt;get($finetuneId) -> ?MusicFinetuneResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a music finetune.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->finetunes->get(
    'finetune_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$finetuneId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;finetunes-&gt;update($finetuneId, $request) -> ?MusicFinetuneResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a music finetune.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->finetunes->update(
    'finetune_id',
    new UpdateMusicFinetuneRequestModel([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$finetuneId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Updated name for the finetune.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Replacement set of tags.
    
</dd>
</dl>

<dl>
<dd>

**$primaryGenre:** `?string` — Updated primary musical genre.
    
</dd>
</dl>

<dl>
<dd>

**$visibility:** `?UpdateMusicFinetuneRequestModelVisibility` — Finetune visibility. Only 'private' and 'workspace' can be set.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;music-&gt;finetunes-&gt;delete($finetuneId) -> ?MusicFinetuneResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a music finetune
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->music->finetunes->delete(
    'finetune_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$finetuneId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SingleUse
<details><summary><code>$client-&gt;tokens-&gt;singleUse-&gt;create($tokenType) -> ?SingleUseTokenResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Generate a time limited single-use token with embedded authentication for frontend clients.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->tokens->singleUse->create(
    SingleUseTokenType::RealtimeScribe->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$tokenType:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## ForcedAlignment
<details><summary><code>$client-&gt;forcedAlignment-&gt;create($request) -> ?ForcedAlignmentResponseModel</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Force align an audio file to text. Use this endpoint to get the timing information for each character and word in an audio file based on a provided text transcript.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->forcedAlignment->create(
    new BodyCreateForcedAlignmentV1ForcedAlignmentPost([
        'file' => File::createFromString("example_file", "example_file"),
        'text' => 'text',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$file:** `mixed` — The file to align. All major audio formats are supported. The file size must be less than 1GB.
    
</dd>
</dl>

<dl>
<dd>

**$text:** `string` — The text to align with the audio. The input text can be in any format, however diarization is not supported at this time.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## SpeechEngine
<details><summary><code>$client-&gt;speechEngine-&gt;list($request) -> ?ListSpeechEnginesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns a paginated list of Speech Engine resources.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->list(
    new ListSpeechEngineRequest([
        'pageSize' => 1,
        'search' => 'search',
        'sortDirection' => SortDirection::Asc->value,
        'sortBy' => AgentSortBy::Name->value,
        'cursor' => 'cursor',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — How many Speech Engines to return at maximum. Can not exceed 100, defaults to 30.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Search term to filter Speech Engines by name
    
</dd>
</dl>

<dl>
<dd>

**$sortDirection:** `?SortDirection` — The direction to sort the results
    
</dd>
</dl>

<dl>
<dd>

**$sortBy:** `?AgentSortBy` — The field to sort the results by
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Used for fetching next page. Cursor is returned in the response.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechEngine-&gt;create($request) -> ?SpeechEngineResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new Speech Engine resource
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->create(
    new CreateSpeechEngineRequest([
        'speechEngine' => new SpeechEngineConfig([
            'wsUrl' => 'ws_url',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `?string` — Name of the speech engine
    
</dd>
</dl>

<dl>
<dd>

**$speechEngine:** `SpeechEngineConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$asr:** `?AsrConversationalConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$tts:** `?TtsConversationalConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$turn:** `?BaseTurnConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$vad:** `?VadConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$conversation:** `?ConversationConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$privacy:** `?PrivacyConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$callLimits:** `?AgentCallLimits` 
    
</dd>
</dl>

<dl>
<dd>

**$auth:** `?SpeechEngineAuthConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` — Language for the speech engine
    
</dd>
</dl>

<dl>
<dd>

**$cascadeTimeoutSeconds:** `?float` — Time in seconds to wait for the upstream speech engine endpoint to respond before the attempt is abandoned and retried. Must be between 2 and 15 seconds.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` — Tags for categorization
    
</dd>
</dl>

<dl>
<dd>

**$overrides:** `?SpeechEngineConversationInitiationClientDataConfig` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechEngine-&gt;get($speechEngineId) -> ?SpeechEngineResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a Speech Engine resource
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->get(
    'seng_3701k3ttaq12ewp8b7qv5rfyszkz',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$speechEngineId:** `string` — The speech engine ID (accepts seng_ or agent_ prefix)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechEngine-&gt;update($speechEngineId, $request) -> ?SpeechEngineResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Update a Speech Engine resource (partial update)
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->update(
    'seng_3701k3ttaq12ewp8b7qv5rfyszkz',
    new UpdateSpeechEngineRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$speechEngineId:** `string` — The speech engine ID (accepts seng_ or agent_ prefix)
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$speechEngine:** `?SpeechEngineConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$asr:** `?AsrConversationalConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$tts:** `?TtsConversationalConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$turn:** `?BaseTurnConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$vad:** `?VadConfig` 
    
</dd>
</dl>

<dl>
<dd>

**$conversation:** `?ConversationConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$privacy:** `?PrivacyConfigInput` 
    
</dd>
</dl>

<dl>
<dd>

**$callLimits:** `?AgentCallLimits` 
    
</dd>
</dl>

<dl>
<dd>

**$auth:** `?SpeechEngineAuthConfig` — Who may start a conversation with this speech engine
    
</dd>
</dl>

<dl>
<dd>

**$language:** `?string` 
    
</dd>
</dl>

<dl>
<dd>

**$cascadeTimeoutSeconds:** `?float` — Time in seconds to wait for the upstream speech engine endpoint to respond before the attempt is abandoned and retried. Must be between 2 and 15 seconds.
    
</dd>
</dl>

<dl>
<dd>

**$tags:** `?array` 
    
</dd>
</dl>

<dl>
<dd>

**$overrides:** `?SpeechEngineConversationInitiationClientDataConfig` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechEngine-&gt;delete($speechEngineId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a Speech Engine resource
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->delete(
    'seng_3701k3ttaq12ewp8b7qv5rfyszkz',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$speechEngineId:** `string` — The speech engine ID (accepts seng_ or agent_ prefix)
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;speechEngine-&gt;duplicate($speechEngineId, $request) -> ?SpeechEngineResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new Speech Engine resource by duplicating an existing one
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->speechEngine->duplicate(
    'seng_3701k3ttaq12ewp8b7qv5rfyszkz',
    new DuplicateSpeechEngineRequest([]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$speechEngineId:** `string` — The speech engine ID (accepts seng_ or agent_ prefix)
    
</dd>
</dl>

<dl>
<dd>

**$name:** `?string` — Name for the duplicated speech engine. Defaults to the source name.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## EnvironmentVariables
<details><summary><code>$client-&gt;environmentVariables-&gt;list($request) -> ?EnvironmentVariablesListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List all environment variables for the workspace with optional filtering
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environmentVariables->list(
    new ListEnvironmentVariablesRequest([
        'cursor' => 'cursor',
        'pageSize' => 1,
        'label' => 'label',
        'environment' => 'environment',
        'type' => ListEnvironmentVariablesRequestType::String->value,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$cursor:** `?string` — Pagination cursor from previous response
    
</dd>
</dl>

<dl>
<dd>

**$pageSize:** `?int` — Number of items to return (1-100)
    
</dd>
</dl>

<dl>
<dd>

**$label:** `?string` — Filter by exact label match
    
</dd>
</dl>

<dl>
<dd>

**$environment:** `?string` — Filter to only return variables that have this environment. When specified, the values dict in the response will only contain this environment.
    
</dd>
</dl>

<dl>
<dd>

**$type:** `?ListEnvironmentVariablesRequestType` — Filter by variable type
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environmentVariables-&gt;create($request) -> ?EnvironmentVariableResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a new environment variable for the workspace
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environmentVariables->create(
    new CreateStringEnvironmentVariableRequest([
        'type' => CreateStringEnvironmentVariableRequestType::String->value,
        'label' => 'label',
        'values' => [
            'key' => 'value',
        ],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$request:** `CreateEnvironmentVariablesRequestBody` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environmentVariables-&gt;get($envVarId) -> ?EnvironmentVariableResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Get a specific environment variable by ID
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environmentVariables->get(
    'env_var_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$envVarId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environmentVariables-&gt;update($envVarId, $request) -> ?EnvironmentVariableResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Replace an environment variable's values. Use null to remove its value for an environment (except production); delete an environment with DELETE /v1/convai/environments/{environment}.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environmentVariables->update(
    'env_var_id',
    new UpdateEnvironmentVariableRequest([
        'values' => [],
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$envVarId:** `string` 
    
</dd>
</dl>

<dl>
<dd>

**$values:** `array` — Values to replace. Set to null to remove the value for an environment (except 'production').
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environmentVariables-&gt;delete($envVarId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an environment variable and its values in all environments. WARNING: Agents are not checked. A variable that an agent still uses (custom LLM, webhooks or cloud storage export, on any branch or version) is deleted anyway, and that agent's conversations then fail. The delete is only rejected while tools, MCP servers or the workspace conversation initiation webhook use the variable.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environmentVariables->delete(
    'env_var_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$envVarId:** `string` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Environments
<details><summary><code>$client-&gt;environments-&gt;list() -> ?EnvironmentsListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List the workspace environments, including 'production'.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environments->list();
```
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environments-&gt;create($request) -> ?EnvironmentResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Create a workspace environment. Variables without a value for it fall back to their production value.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environments->create(
    new CreateEnvironmentRequest([
        'name' => 'name',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$name:** `string` — Unique name of the environment, e.g. 'staging'.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;environments-&gt;delete($environment)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete a workspace environment and remove its values from all environment variables. 'production' cannot be deleted.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->environments->delete(
    'environment',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$environment:** `string` — Name of the environment to delete, e.g. 'staging'.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Orders
<details><summary><code>$client-&gt;productions-&gt;orders-&gt;list($request) -> ?ListOrdersResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Lists Productions orders in the workspace. Supports filtering by status and date range, with pagination.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->list(
    new ListOrdersRequest([
        'pageSize' => 1,
        'offset' => 1,
        'status' => [
            OrderState::Open->value,
        ],
        'startDate' => new DateTime('2024-01-15T09:30:00Z'),
        'endDate' => new DateTime('2024-01-15T09:30:00Z'),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — Maximum number of orders to return per page.
    
</dd>
</dl>

<dl>
<dd>

**$offset:** `?int` — Number of orders to skip for pagination.
    
</dd>
</dl>

<dl>
<dd>

**$status:** `?array` — Filter orders by one or more statuses.
    
</dd>
</dl>

<dl>
<dd>

**$startDate:** `?string` — Filter orders created on or after this date.
    
</dd>
</dl>

<dl>
<dd>

**$endDate:** `?string` — Filter orders created on or before this date.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;create($request) -> ?CreateOrderResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Creates a new Productions order in the workspace. The order starts in the open state and can be configured with items before submission.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->create(
    new CreateOrderRequest([
        'sandbox' => false,
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$sandbox:** `?bool` — When true, creates a sandbox order that auto-progresses without producer intervention.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;get($orderId) -> ?OrderResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves full details for a Productions order.

Quote and pricing information may not be available immediately; if you wish to see the quote before submission, you may need to poll the order details until it is ready.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->get(
    'order_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;update($orderId, $request) -> ?UpdateOrderResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Updates an open order.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->update(
    'order_id',
    new BodyUpdateOrderV1ProductionsOrdersOrderIdPatch([
        'request' => new UpdateOrderRequest([
            'name' => 'Spanish Dubs',
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UpdateOrderRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;submit($orderId) -> ?SubmitOrderResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Submits an open order for processing. The order must have at least one item. Once submitted, items can no longer be modified.

Upon submission, the workspace will be charged for the order. The quote is based on information extracted from the uploaded media, such as its duration. The quote may not be available immediately; if you wish to see the quote before submission, you may need to poll the order details until the quote is ready.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->submit(
    'order_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Media
<details><summary><code>$client-&gt;productions-&gt;orders-&gt;media-&gt;register($orderId, $request) -> ?RegisterMediaResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Registers a media file with an order, either by uploading it directly or by providing a URL to fetch it from. Exactly one of `media` or `media_url` must be provided. The registered media can then be referenced when adding order items.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->media->register(
    'order_id',
    new BodyRegisterMediaV1ProductionsOrdersOrderIdMediaPost([
        'declaredLanguage' => 'declared_language',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order to which this media will be attached.
    
</dd>
</dl>

<dl>
<dd>

**$declaredLanguage:** `string` — The language code of the media content (e.g. 'en', 'es-ES'). Must be a supported source language for some order item kind.
    
</dd>
</dl>

<dl>
<dd>

**$media:** `mixed` — The media file to upload. Mutually exclusive with media_url.
    
</dd>
</dl>

<dl>
<dd>

**$mediaUrl:** `?string` — A URL to fetch the media file from. Mutually exclusive with media.
    
</dd>
</dl>

<dl>
<dd>

**$mediaUrlFilename:** `?string` — The filename for URL-sourced media (e.g. 'example.mp4'). Required when using media_url.
    
</dd>
</dl>

<dl>
<dd>

**$mediaUrlContentType:** `?string` — The MIME type for URL-sourced media (e.g. 'video/mp4'). Required when using media_url.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;media-&gt;get($orderId, $mediaId) -> ?OrderMediaResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves metadata and a time-limited download URL for a previously uploaded media file.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->media->get(
    'order_id',
    'media_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>

<dl>
<dd>

**$mediaId:** `string` — The ID of the media file.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Items
<details><summary><code>$client-&gt;productions-&gt;orders-&gt;items-&gt;upsert($orderId, $request) -> ?UpsertOrderItemResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Adds or updates an order item on an open order. Returns the item ID and the quoted price.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->items->upsert(
    'order_id',
    new BodyUpsertOrderItemV1ProductionsOrdersOrderIdItemsPost([
        'request' => new UpsertOrderItemRequest([
            'item' => OrderItemRequestInput::dub(new DubOrderItemRequest([
                'kind' => DubOrderItemRequestKind::Dub->value,
                'mediaId' => 'prodmedia_01jgatk6h0fwxrtbjade61yqhx',
                'sourceLanguage' => 'en',
                'destinationLanguages' => [
                    'hi',
                    'fr-FR',
                    'de',
                ],
                'includeCaptions' => true,
                'includeSourceCaptions' => false,
                'instructions' => "Voices don't need to match the originals, prioritize native-sounding voices",
                'captionsSdh' => false,
            ])),
        ]),
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>

<dl>
<dd>

**$request:** `UpsertOrderItemRequest` 
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;productions-&gt;orders-&gt;items-&gt;remove($orderId, $itemId) -> ?RemoveOrderItemResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Removes an order item from an open order.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->items->remove(
    'order_id',
    'item_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>

<dl>
<dd>

**$itemId:** `string` — The ID of the order item.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Deliverables
<details><summary><code>$client-&gt;productions-&gt;orders-&gt;deliverables-&gt;list($orderId) -> ?OrderDeliverablesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieves the delivered files for a completed order. Returns an empty list if the order is not yet completed.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->deliverables->list(
    'order_id',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderId:** `string` — The ID of the order.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Languages
<details><summary><code>$client-&gt;productions-&gt;orders-&gt;languages-&gt;list($orderItemKind) -> ?LanguagesResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Returns the available languages for a given order item kind.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->productions->orders->languages->list(
    OrderItemKind::Dub->value,
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$orderItemKind:** `string` — The kind of order item.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

## Assets
<details><summary><code>$client-&gt;assets-&gt;list($request) -> ?AssetListResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

List assets in the workspace, most recently created first.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->assets->list(
    new ListAssetsRequest([
        'pageSize' => 1,
        'cursor' => 'cursor',
        'search' => 'search',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$pageSize:** `?int` — Number of assets to return.
    
</dd>
</dl>

<dl>
<dd>

**$cursor:** `?string` — Token from a previous response's `next_cursor`. Omit to fetch the first page.
    
</dd>
</dl>

<dl>
<dd>

**$search:** `?string` — Optional free-text search filter over asset names.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;assets-&gt;create($request) -> ?AssetResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Upload a new asset.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->assets->create(
    new BodyUploadAssetV1AssetsPost([
        'asset' => File::createFromString("example_asset", "example_asset"),
        'name' => 'podcast-intro.mp3',
    ]),
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$asset:** `mixed` — The file to upload.
    
</dd>
</dl>

<dl>
<dd>

**$name:** `string` — Display name for the asset.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;assets-&gt;get($assetId) -> ?AssetResponse</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Retrieve a single asset by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->assets->get(
    '5xM2KqOnZyce22SPZ9d4',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$assetId:** `string` — ID of the asset.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

<details><summary><code>$client-&gt;assets-&gt;delete($assetId)</code></summary>
<dl>
<dd>

#### 📝 Description

<dl>
<dd>

<dl>
<dd>

Delete an asset by ID.
</dd>
</dl>
</dd>
</dl>

#### 🔌 Usage

<dl>
<dd>

<dl>
<dd>

```php
$client->assets->delete(
    '5xM2KqOnZyce22SPZ9d4',
);
```
</dd>
</dl>
</dd>
</dl>

#### ⚙️ Parameters

<dl>
<dd>

<dl>
<dd>

**$assetId:** `string` — ID of the asset.
    
</dd>
</dl>
</dd>
</dl>


</dd>
</dl>
</details>

