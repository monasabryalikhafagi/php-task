<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Task;
class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Task $task)
    {
        return $user->id === $task->manger_id || $user->id === $task->user_id ;
    }
    
    public function show(User $user, Task $task)
    {
        return $user->id === $task->manger_id || $user->id === $task->user_id ;
    }
    public function delete(User $user, Task $task)
    {
        return $user->id === $task->manger_id;
    }
  
    public function store(User $user, Task $task)
    {
        return $user->id === $task->manger_id;
    }
  
  
}
