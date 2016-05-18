<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Version
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * API Version
     *
     * Returns current API version info.
     *
     * @see https://developers.wrike.com/documentation/api/methods/api-version
     *
     * @return mixed
     */
    public function get()
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/version",
            ]
        );
    }
}
