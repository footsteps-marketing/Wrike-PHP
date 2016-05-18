<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Contacts
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Query Contacts
     *
     * List contacts of all users and user groups in all accessible accounts.
     *
     * @param  array  $params @see https://developers.wrike.com/documentation/api/methods/query-contacts
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/contacts",
                "params" => $params,
            ]
        );
    }



    /**
     * Query Contacts
     *
     * List contacts of all users and user groups in account.
     *
     * @param  string $accountId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/query-contacts
     * @return mixed
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}/contacts",
                "params" => $params,
            ]
        );
    }



    /**
     * Query Contacts
     *
     * List contacts of specified users and user groups.
     *
     * @param  string|array $contactId
     * @param  array        $params     @see https://developers.wrike.com/documentation/api/methods/query-contacts
     * @return mixed
     */
    public function get($contactId, $params = [])
    {
        if (is_array($contactId)) {
            if (count($contactId) < 1) {
                throw new \Exception('Must supply at least 1 ID');
            }
            if (count($contactId) > 100) {
                throw new \Exception('Maximum number of IDs is 100');
            }
            $contactIdString = implode(',', $contactId);
        } else {
            $contactIdString = $contactId;
        }
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/contacts/{$contactIdString}",
                "params" => $params,
            ]
        );
    }



    /**
     * Modify Contact
     *
     * Update contacts by Id.
     *
     * @param  string $contactId
     * @param  array  $params   @see https://developers.wrike.com/documentation/api/methods/modify-contact
     * @return mixed
     */
    public function modify($contactId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "PUT",
                "action" => "/contacts/{$contactId}",
                "params" => $params,
            ]
        );
    }
}
