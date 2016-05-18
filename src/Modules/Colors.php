<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Colors
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Query Colors
     *
     * Get color name - code mapping.
     *
     * @see https://developers.wrike.com/documentation/api/methods/query-colors
     *
     * @return mixed
     */
    public function get()
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/colors",
            ]
        );
    }
}
