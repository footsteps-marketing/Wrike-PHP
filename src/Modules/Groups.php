<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Groups
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Query Group
     *
     * Returns complete information about single group.
     *
     * @param string $groupId
     * @param array  $params  @see https://developers.wrike.com/documentation/api/methods/query-groups
     */
    public function get($groupId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/groups/{$groupId}",
                "params" => $params,
            ]
        );
    }



    /**
     * Query Groups
     *
     * Returns all groups in the account.
     *
     * @param string $accountId
     * @param array  $params  @see https://developers.wrike.com/documentation/api/methods/query-groups
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}/groups",
                "params" => $params,
            ]
        );
    }



    /**
     * Create Groups
     *
     * Create group in account.
     *
     * @param string $accountId
     * @param array  $params  @see https://developers.wrike.com/documentation/api/methods/create-groups
     */
    public function create($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "POST",
                "action" => "/accounts/{$accountId}/groups",
                "params" => $params,
            ]
        );
    }



    /**
     * Modify Groups
     *
     * Update group by id.
     *
     * @param string $groupId
     * @param array  $params  @see https://developers.wrike.com/documentation/api/methods/modify-groups
     */
    public function modify($groupId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "PUT",
                "action" => "/groups/{$groupId}",
                "params" => $params,
            ]
        );
    }



    /**
     * Delete Groups
     *
     * Delete group by Id.
     *
     * @param string $groupId
     * @param array  $params  @see https://developers.wrike.com/documentation/api/methods/delete-groups
     */
    public function delete($groupId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "DELETE",
                "action" => "/groups/{$groupId}",
                "params" => $params,
            ]
        );
    }
}
