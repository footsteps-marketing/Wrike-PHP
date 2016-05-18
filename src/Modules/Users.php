<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Users
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }
    


    /**
     * Query User
     *
     * Returns information about single user.
     *
     * @see https://developers.wrike.com/documentation/api/methods/query-user
     *
     * @param  string $userId
     * @return mixed
     */
    public function get($userId)
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/users/{$userId}",
            ]
        );
    }



    /**
     * Modify User
     *
     * Update users by Id.
     *
     * @param  string $userId
     * @param  array  $params @see https://developers.wrike.com/documentation/api/methods/modify-user
     * @return mixed
     */
    public function modify($userId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "PUT",
                "action" => "/users/{$userId}",
                "params" => $params,
            ]
        );
    }
}
