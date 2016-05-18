<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Folders
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Get Folder Tree
     *
     * Returns list of entries required to build a folder tree for all accounts.
     * This list contains the virtual root and recycle bin folders for each account,
     * which can be used as root nodes for trees. The IDs of the virtual folder
     * could be obtained from the '/accounts' method response. Note: when any
     * of query filter parameters are present (e.g. descendants=false, metadata)
     * response is switched to Folder model.
     *
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/get-folder-tree
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/folders",
                "params" => $params,
            ]
        );
    }



    /**
     * Get Folder Tree
     *
     * Returns a list of tree entries for the account.
     *
     * @param  string  $accountId
     * @param  array   $params    @see https://developers.wrike.com/documentation/api/methods/get-folder-tree
     * @return array
     */
    public function getInAccount($accountId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/accounts/{$accountId}/folders",
                "params" => $params,
            ]
        );
    }



    /**
     * Get Folder Tree
     *
     * Returns a list of tree entries for subtree of this folder.
     * For root and recycle bin folders, returns folder subtrees
     * of root and recycle bin respectively.
     *
     * @param  string  $folderId
     * @param  array   $params      @see https://developers.wrike.com/documentation/api/methods/get-folder-tree
     * @return array
     */
    public function getInFolder($folderId, $params = [])
    {
        return $this->owner->requestFactory(
            [
                "method" => "GET",
                "action" => "/folders/{$folderId}/folders",
                "params" => $params,
            ]
        );
    }

    

    /**
     * Get Folder
     *
     * Returns complete information about specified folders.
     *
     * @param  string|array $folderId
     * @param  array   $params      @see https://developers.wrike.com/documentation/api/methods/get-folder
     * @return mixed
     */
    public function get($folderId, $params = [])
    {
        if (is_array($folderId)) {
            if (count($folderId) < 1) {
                throw new \Exception('Must supply at least 1 ID');
            }
            if (count($folderId) > 100) {
                throw new \Exception('Maximum number of IDs is 100');
            }
            $folderIdString = implode(',', $folderId);
        } else {
            $folderIdString = $folderId;
        }
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/folders/{$folderIdString}",
            "params" => $params,
        ]);
    }



    /**
     * Create Folder
     *
     * Create a folder within a folder. Specify virtual rootFolderId in order to create a folder in the account root.
     *
     * @param  string $folderId
     * @param  array  $params   @see https://developers.wrike.com/documentation/api/methods/create-folder
     * @return mixed
     */
    public function create($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/folders/{$folderId}/folders",
            "params" => $params,
        ]);
    }



    /**
     * Modify Folder
     *
     * Update folder.
     *
     * @param  string  $folderId
     * @param  array  $params    @see https://developers.wrike.com/documentation/api/methods/modify-folder
     * @return mixed
     */
    public function modify($folderId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "PUT",
            "action" => "/folders/{$folderId}",
            "params" => $params,
        ]);
    }



    /**
     * Delete Folder
     *
     * Move folder and all descendant folders and tasks to Recycle Bin
     * unless they have parents outside of deletion scope.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-folder
     *
     * @param  string $folderId
     * @return mixed
     */
    public function delete($folderId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/folders/{$folderId}",
        ]);
    }
}
