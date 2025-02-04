<?php

namespace App\Policies;

use App\Models\job;
use App\Models\User;

class jobPolicy
{
   public function edit(User $user, job $job)
   {
       return $job->employer->user->is($user);

   }
}
