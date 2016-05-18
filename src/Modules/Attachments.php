<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Attachments
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Get Attachments
     *
     * Return all Attachments of account tasks and folders.
     *
     * @param string $accountId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-attachments
     * @return mixed
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/accounts/{$accountId}/attachments",
            "params" => $params,
        ]);
    }



    /**
     * Get Attachments
     *
     * Returns all Attachments of a folder.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-attachments
     * @return mixed
     */
    public function getInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/folders/{$folderId}/attachments",
            "params" => $params,
        ]);
    }



    /**
     * Get Attachments
     *
     * Returns all Attachments of a task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-attachments
     * @return mixed
     */
    public function getInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/tasks/{$taskId}/attachments",
            "params" => $params,
        ]);
    }



    /**
     * Get Attachments
     *
     * Returns complete information about an Attachment.
     *
     * @param  string $attachmentId
     * @param  array  $params        @see https://developers.wrike.com/documentation/api/methods/get-attachments
     * @return mixed
     */
    public function get($attachmentId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/attachments/{$attachmentId}",
            "params" => $params,
        ]);
    }



    /**
     * Download Wrike Attachment
     *
     * Returns attachment content. It can be accessed via /attachments/id/download/name.ext URL.
     * In this case, 'name.ext' will be returned as the file name.
     *
     * @see https://developers.wrike.com/documentation/api/methods/download-wrike-attachment
     *
     * @param  string $attachmentId
     * @return mixed
     */
    public function download($attachmentId)
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/attachments/{$attachmentId}/download",
        ]);
    }



    /**
     * Download Attachment Preview
     *
     * Returns Preview for the attachment. The preview can be accessed via
     * /attachments/id/preview/name.ext URL. In this case, 'name.ext' will be returned as the file name.
     *
     * @param  string $attachmentId
     * @param  array  $params           @see https://developers.wrike.com/documentation/api/methods/download-attachment-preview
     * @return mixed
     */
    public function downloadPreview($attachmentId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/attachments/{$attachmentId}/preview",
            "params" => $params,
        ]);
    }



    /**
     * Get Access URL for Attachment
     *
     * Public URL to attachment from Wrike or external service.
     *
     * @param  string $attachmentId
     * @return mixed
     */
    public function getUrl($attachmentId)
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/attachments/{$attachmentId}/url",
        ]);
    }



    /**
     * Create Wrike Attachment
     *
     * Add an attachment to a folder.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-wrike-attachment
     * @return mixed
     */
    public function createInFolder($folderId, $filePath)
    {
        if (!is_readable($filePath)) {
            throw new \Exception("File {$filepath} not readable.");
        }
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/folders/{$folderId}/attachments",
            "body"   => file_get_contents($filePath),
            "headers" => [
                'X-File-Name' => basename($filePath),
            ],
        ]);
    }



    /**
     * Create Wrike Attachment
     *
     * Add an attachment to a task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-wrike-attachment
     * @return mixed
     */
    public function createInTask($taskId, $filePath)
    {
        if (!is_readable($filePath)) {
            throw new \Exception("File {$filepath} not readable.");
        }
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/tasks/{$taskId}/attachments",
            "body"   => file_get_contents($filePath),
            "headers" => [
                'X-File-Name' => basename($filePath),
            ],
        ]);
    }



    /**
     * Update Attachment
     *
     * Update previously uploaded Attachment with new version.
     *
     * @param string $attachmentId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/update-attachment
     * @return mixed
     */
    public function modify($attachmentId, $filePath = null, $params = [])
    {
        $options = [
            "method" => "PUT",
            "action" => "/attachments/{$attachmentId}",
        ];

        if (!is_null($filePath)) {
            $options["headers"] = [
                'X-File-Name' => basename($filePath),
            ];
            $options["body"] = file_get_contents($filePath);
        }

        if (!empty($params)) {
            $options['params'] = $params;
        }

        return $this->owner->requestFactory($options);
    }



    /**
     * Delete Attachment
     *
     * Delete Attachment by Id.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-attachment
     *
     * @param string $attachmentId
     * @return mixed
     */
    public function delete($attachmentId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/attachments/{$attachmentId}",
        ]);
    }
}
