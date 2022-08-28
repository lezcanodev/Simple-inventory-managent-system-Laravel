<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Symfony\Component\Process\Process;

use App\Policies\Policy;

class ProductPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sectionId = Section::getId('App\Models\Product');
    }


}
