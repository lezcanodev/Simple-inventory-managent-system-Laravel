<?php

namespace App\Policies;

use App\Models\Provider;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use App\Policies\Policy;
use Illuminate\Support\Facades\Auth;

class ProviderPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sectionId = Provider::sectionId();
    }


}
