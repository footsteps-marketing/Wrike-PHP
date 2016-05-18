<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Workflows
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Query Workflows
     *
     * Returns list of workflows with custom statuses.
     *
     * @see https://developers.wrike.com/documentation/api/methods/query-workflows
     *
     * @param string $accountId
     * @return mixed
     */
    public function getAll($accountId)
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}/workflows",
            ]
        );
    }



    /**
     * Create Workflow
     *
     * Create workflow in account.
     *
     * @param  string $accountId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/create-workflow
     * @return mixed
     */
    public function create($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "POST",
                "action" => "/accounts/{$accountId}/workflows",
                "params" => $params,
            ]
        );
    }



    /**
     * Modify Workflow
     *
     * Update workflow or custom statuses.
     *
     * @param  string $workflowId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/modify-workflow
     * @return mixed
     */
    public function update($workflowId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "PUT",
                "action" => "/workflows/{$workflowId}",
                "params" => $params,
            ]
        );
    }
}
