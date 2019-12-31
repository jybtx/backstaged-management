<?php

namespace Jybtx\Backstaged\Repositories\Eloquent;

use Jybtx\Backstaged\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot(){}
}