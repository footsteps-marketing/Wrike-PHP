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
     * Legacy API v2 IDs converter
     *
     * Convert APIv2 legacy IDs to APIv3 format for specific entity type.
     *
     * @see https://developers.wrike.com/documentation/api/methods/legacy-api-v2-ids-converter
     *
     * @return mixed
     */
    public function convert($params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/ids",
                "params" => $params,
            ]
        );
    }
}
