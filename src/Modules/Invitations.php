<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Invitations
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Query Invitations
     *
     * Get all invitations for current account.
     *
     * @see https://developers.wrike.com/documentation/api/methods/query-invitations
     *
     * @param  string $accountId
     * @return mixed
     */
    public function getInAccount($accountId)
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}/invitations",
            ]
        );
    }



    /**
     * Create Invitation
     *
     * Create an invitation into the current account.
     *
     * @param  string $accountId
     * @param  array  $params @see https://developers.wrike.com/documentation/api/methods/create-invitation
     * @return mixed
     */
    public function createInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "POST",
                "action" => "/accounts/{$accountId}/invitations",
                "params" => $params,
            ]
        );
    }



    /**
     * Update Invitation
     *
     * Update invitation by ID and/or resend invitation.
     *
     * @param  string $invitationId
     * @param  array  $params @see https://developers.wrike.com/documentation/api/methods/update-invitation
     * @return mixed
     */
    public function update($invitationId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "POST",
                "action" => "/invitations/{$invitationId}",
                "params" => $params,
            ]
        );
    }



    /**
     * Delete Invitation
     *
     * Delete invitation by ID.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-invitation
     *
     * @param  string $invitationId
     * @return mixed
     */
    public function delete($invitationId)
    {
        return $this->owner->requestFactory(
            [
                "method" => "DELETE",
                "action" => "/invitations/{$invitationId}",
            ]
        );
    }
}
