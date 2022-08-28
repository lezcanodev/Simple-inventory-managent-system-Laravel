<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Rol;

class Policy
{
    use HandlesAuthorization;

    protected $sectionId;
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sectionId = 0;
    }

    public function before(User $user){
        if($user->rol->id === Rol::$ADMIN) return true;
    }

    public function create(User $user){
        return Permission::has($user->rol_id, 'create', $this->sectionId);
    }


    public function destroy(User $user, $model){
        return (Permission::has($user->rol_id, 'delete', $this->sectionId) || 
               (Permission::has($user->rol_id, 'my_delete', $this->sectionId) && $model->user_id === $user->id));
    }

    public function update(User $user, $model){
        return (Permission::has($user->rol_id, 'update', $this->sectionId) || 
               (Permission::has($user->rol_id, 'my_update', $this->sectionId) && $model->user_id === $user->id));
    }

    
    public function view(User $user){
        return Permission::has($user->rol_id, 'read', $this->sectionId);
    }

}
