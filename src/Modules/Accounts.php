<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Accounts
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Query Accounts
     *
     * Returns all accounts to which user has access.
     *
     * @param  array  $params @see https://developers.wrike.com/documentation/api/methods/query-accounts
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts",
                "params" => $params,
            ]
        );
    }



    /**
     * Query Contacts
     *
     * Returns specified account.
     *
     * @param  string $accountId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/query-accounts
     * @return mixed
     */
    public function get($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}",
                "params" => $params,
            ]
        );
    }
}
