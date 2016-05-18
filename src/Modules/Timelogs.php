<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Timelogs
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Query Timelogs
     *
     * Get all timelog records in all accounts.
     *
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/timelogs/",
            "params" => $params,
        ]);
    }



    /**
     * Query Timelogs
     *
     * Get all timelog records that were created by the user.
     *
     * @param string $contactId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function getInContact($contactId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/contacts/{$contactId}/timelogs",
            "params" => $params,
        ]);
    }



    /**
     * Query Timelogs
     *
     * Get all timelog records in the account.
     *
     * @param string $accountId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/accounts/{$accountId}/timelogs",
            "params" => $params,
        ]);
    }



    /**
     * Query Timelogs
     *
     * Get all timelog records for a folder.
     *
     * @param string $folderId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function getInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/folders/{$folderId}/timelogs",
            "params" => $params,
        ]);
    }



    /**
     * Query Timelogs
     *
     * Get all timelog records for a task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function getInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/tasks/{$taskId}/timelogs",
            "params" => $params,
        ]);
    }



    /**
     * Query Timelogs
     *
     * Get timelog record by ID.
     *
     * @param  string $timelogId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/query-timelogs
     * @return mixed
     */
    public function get($timelogId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/timelogs/{$timelogId}",
            "params" => $params,
        ]);
    }



    /**
     * Create Timelog
     *
     * Create timelog record for task.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-timelog
     * @return mixed
     */
    public function createInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/tasks/{$taskId}/timelogs",
            "params" => $params,
        ]);
    }



    /**
     * Modify Timelog
     *
     * Update timelog by Id.
     *
     * @param string $timelogId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/modify-timelog
     * @return mixed
     */
    public function modify($timelogId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "PUT",
            "action" => "/timelogs/{$timelogId}",
            "params" => $params,
        ]);
    }



    /**
     * Delete Timelog
     *
     * Delete Timelog record by ID.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-timelog
     *
     * @param string $timelogId
     * @return mixed
     */
    public function delete($timelogId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/timelogs/{$timelogId}",
        ]);
    }
}
