<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Tasks
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Query Tasks
     *
     * Search among all tasks in all accounts.
     *
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-tasks
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/tasks/",
            "params" => $params,
        ]);
    }



    /**
     * Query Tasks
     *
     * Search among all tasks in the account.
     *
     * @param string $accountId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-tasks
     * @return mixed
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/accounts/{$accountId}/tasks",
            "params" => $params,
        ]);
    }



    /**
     * Query Tasks
     *
     * Search among tasks in the folder.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-tasks
     * @return mixed
     */
    public function getInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/folders/{$folderId}/tasks",
            "params" => $params,
        ]);
    }



    /**
     * Create Task
     *
     * Create task in folder. You can specify rootFolderId to create task in user's account root
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-task
     * @return mixed
     */
    public function create($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/folders/{$folderId}/tasks",
            "params" => $params,
        ]);
    }



    /**
     * Modify Tasks
     *
     * Update task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/modify-tasks
     * @return mixed
     */
    public function modify($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "PUT",
            "action" => "/tasks/{$taskId}",
            "params" => $params,
        ]);
    }



    /**
     * Delete Tasks
     *
     * Delete task by Id.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-tasks
     *
     * @param string $taskId
     * @return mixed
     */
    public function delete($taskId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/tasks/{$taskId}",
        ]);
    }
}
