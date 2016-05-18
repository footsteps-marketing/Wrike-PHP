<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Comments
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get Comments
     *
     * Get all comments in all accounts.
     *
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-comments
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/comments/",
            "params" => $params,
        ]);
    }



    /**
     * Get Comments
     *
     * Get all comments in the account.
     *
     * @param string $accountId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-comments
     * @return mixed
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/accounts/{$accountId}/comments",
            "params" => $params,
        ]);
    }



    /**
     * Get Comments
     *
     * Get folder comments.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-comments
     * @return mixed
     */
    public function getInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/folders/{$folderId}/comments",
            "params" => $params,
        ]);
    }



    /**
     * Get Comments
     *
     * Get task comments.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-comments
     * @return mixed
     */
    public function getInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/tasks/{$taskId}/comments",
            "params" => $params,
        ]);
    }



    /**
     * Get Comments
     *
     * Get single or multiple comments by their IDs.
     *
     * @param  string|array $commentId
     * @param  array   $params           @see https://developers.wrike.com/documentation/api/methods/get-comments
     * @return mixed
     */
    public function get($commentId, $params = [])
    {
        if (is_array($commentId)) {
            if (count($commentId) < 1) {
                throw new \Exception('Must supply at least 1 ID');
            }
            if (count($commentId) > 100) {
                throw new \Exception('Maximum number of IDs is 100');
            }
            $commentIdString = implode(',', $commentId);
        } else {
            $commentIdString = $commentId;
        }
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/comments/{$commentIdString}",
            "params" => $params,
        ]);
    }



    /**
     * Create Comment
     *
     * Create a comment in the folder. The virtual Root and Recycle Bin folders cannot have comments.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-comment
     * @return mixed
     */
    public function createInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/folders/{$folderId}/comments",
            "params" => $params,
        ]);
    }



    /**
     * Create Comment
     *
     * Create comment in task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-comment
     * @return mixed
     */
    public function createInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/tasks/{$taskId}/comments",
            "params" => $params,
        ]);
    }



    /**
     * Update Comment
     *
     * Update Comment by ID. A comment is available for updates only during the 5 minutes after creation.
     *
     * @param string $commentId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/update-comment
     * @return mixed
     */
    public function modify($commentId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "PUT",
            "action" => "/comments/{$commentId}",
            "params" => $params,
        ]);
    }



    /**
     * Delete Comment
     *
     * Delete comment by Id.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-comment
     *
     * @param string $commentId
     * @return mixed
     */
    public function delete($commentId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/comments/{$commentId}",
        ]);
    }
}
