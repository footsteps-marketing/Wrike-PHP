<?php namespace FSM\Wrike\Modules;

use FSM\Wrike\Wrike;

class Dependencies
{
    private $owner;

    public function __construct(Wrike $owner)
    {
        $this->owner = $owner;
    }



    /**
     * Query Dependencies
     *
     * Get task dependencies.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/query-dependencies
     * @return mixed
     */
    public function getInTask($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/tasks/{$taskId}/dependencies",
            "params" => $params,
        ]);
    }



    /**
     * Query Dependencies
     *
     * Returns complete information about single or multiple dependencies.
     *
     * @param  string|array $dependencyId
     * @param  array   $params           @see https://developers.wrike.com/documentation/api/methods/query-dependencies
     * @return mixed
     */
    public function get($dependencyId, $params = [])
    {
        if (is_array($dependencyId)) {
            if (count($dependencyId) < 1) {
                throw new \Exception('Must supply at least 1 ID');
            }
            if (count($dependencyId) > 100) {
                throw new \Exception('Maximum number of IDs is 100');
            }
            $dependencyIdString = implode(',', $dependencyId);
        } else {
            $dependencyIdString = $dependencyId;
        }
        return $this->owner->requestFactory([
            "method" => "GET",
            "action" => "/dependencies/{$dependencyIdString}",
            "params" => $params,
        ]);
    }



    /**
     * Create Dependency
     *
     * Add dependency between tasks.
     *
     * @param string $taskId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/create-dependency
     * @return mixed
     */
    public function create($taskId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "POST",
            "action" => "/tasks/{$taskId}/dependencies",
            "params" => $params,
        ]);
    }



    /**
     * Modify Dependency
     *
     * Change relationType of task dependency.
     *
     * @param string $dependencyId
     * @param  array $params @see https://developers.wrike.com/documentation/api/methods/modify-dependency
     * @return mixed
     */
    public function modify($dependencyId, $params = [])
    {
        return $this->owner->requestFactory([
            "method" => "PUT",
            "action" => "/dependencies/{$dependencyId}",
            "params" => $params,
        ]);
    }



    /**
     * Delete Dependency
     *
     * Delete dependency between tasks.
     *
     * @see https://developers.wrike.com/documentation/api/methods/delete-dependency
     *
     * @param string $dependencyId
     * @return mixed
     */
    public function delete($dependencyId)
    {
        return $this->owner->requestFactory([
            "method" => "DELETE",
            "action" => "/dependencies/{$dependencyId}",
        ]);
    }
}
